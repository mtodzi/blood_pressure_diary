<?php

namespace App\Repositories;

use App\Models\Measurement;
use App\Models\PressureMeasurement;
use Illuminate\Contracts\Pagination\CursorPaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\Cursor;

class MeasurementRepository
{
    /**
     * Get a cursor-paginated list of measurements for the logged-in user.
     *
     * The result is iterable, so it can be used in a `foreach` loop.
     *
     * @param int $perPage Number of items per page.
     * @return CursorPaginator
     */
    public static function getForCurrentUser(int $perPage = 20, string|null $cursorString = null): array
    {
        $measurements = Measurement::with(['user', 'pressureMeasurements'])
            ->where('user_id', Auth::id())
            ->orderBy('id', 'desc');
        if($cursorString === null){
            $measurements = $measurements->cursorPaginate($perPage);
        }else{
            $cursor = Cursor::fromEncoded($cursorString);
            $measurements = $measurements->cursorPaginate(
                $perPage,           // кол-во на страницу
                ['*'],        // колонки
                'cursor',     // имя параметра
                $cursor
            );
        }
        $next_cursor =$measurements->nextCursor()?->encode();
        $prev_cursor = $measurements->previousCursor()?->encode();
        $result = [];
        foreach ($measurements as $measurement) {
            $pressure_measurements_by_hand = $measurement->pressureMeasurements->groupBy('hand');

            $left_measurements = $pressure_measurements_by_hand->get('left', collect())->map(function ($item) {
                return [
                    'systolic' => $item->systolic,
                    'diastolic' => $item->diastolic,
                    'pulse' => $item->pulse,
                ];
            })->values()->all();

            $right_measurements = $pressure_measurements_by_hand->get('right', collect())->map(function ($item) {
                return [
                    'systolic' => $item->systolic,
                    'diastolic' => $item->diastolic,
                    'pulse' => $item->pulse,
                ];
            })->values()->all();

            $systolic_sum_left = 0;
            $diastolic_sum_left = 0;
            if (count($left_measurements) > 1) {
                $systolic_sum_left = collect($left_measurements)->slice(1)->sum('systolic');
                $diastolic_sum_left = collect($left_measurements)->slice(1)->sum('diastolic');
            }

            $systolic_sum_right = 0;
            $diastolic_sum_right = 0;
            if (count($right_measurements) > 1) {
                $systolic_sum_right = collect($right_measurements)->slice(1)->sum('systolic');
                $diastolic_sum_right = collect($right_measurements)->slice(1)->sum('diastolic');
            }
            $systolic_middle_left = count($left_measurements) > 1 ? ceil($systolic_sum_left / (count($left_measurements) - 1)) : 0;
            $diastolic_middle_left = count($left_measurements) > 1 ? ceil($diastolic_sum_left / (count($left_measurements) - 1)) : 0;
            $pulse_middle_left = $systolic_middle_left - $diastolic_middle_left;
            $systolic_middle_right = count($right_measurements) > 1 ? ceil($systolic_sum_right / (count($right_measurements) - 1)) : 0;
            $diastolic_middle_right = count($right_measurements) > 1 ? ceil($diastolic_sum_right / (count($right_measurements) - 1)) : 0;
            $pulse_middle_right = $systolic_middle_right - $diastolic_middle_right;
            $result['data'][] = [
                'id' => $measurement->id,
                'created_at' => $measurement->created_at->format('d.m.Y H:i'),
                'user_id' => $measurement->user_id,
                'user_name' => $measurement->user->name,
                'left_measurements' => $left_measurements,
                'right_measurements' => $right_measurements,
                'systolic_middle_left' => $systolic_middle_left,
                'diastolic_middle_left' => $diastolic_middle_left,
                'pulse_middle_left' => $pulse_middle_left,
                'systolic_middle_right' => $systolic_middle_right,
                'diastolic_middle_right' => $diastolic_middle_right,
                'pulse_middle_right' =>  $pulse_middle_right,

            ];
        }
        $result['next_cursor'] = $next_cursor;
        $result['prev_cursor'] = $prev_cursor;
        return $result;
    }
}
