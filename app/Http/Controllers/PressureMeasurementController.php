<?php

namespace App\Http\Controllers;

use App\Models\Measurement;
use App\Models\PressureMeasurement;
use App\Repositories\MeasurementRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PressureMeasurementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Показать форму для создания нового измерения.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('pressure_measurements.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'left_measurements' => 'present|array',
            'right_measurements' => 'present|array',
            'is_left_hend' => 'boolean',
            'is_right_hend' => 'boolean',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $measurement = new Measurement();
                $measurement->user_id = Auth::id();
                $measurement->save();

                if ($request->is_left_hend) {
                    foreach ($request->left_measurements as $m) {
                        if(isset($m['systolic']) && isset($m['diastolic']) && isset($m['pulse'])) {
                            PressureMeasurement::create([
                                'systolic' => $m['systolic'],
                                'diastolic' => $m['diastolic'],
                                'pulse' => $m['pulse'],
                                'hand' => 'left',
                                'measurement_id' => $measurement->id,
                            ]);
                        }
                    }
                }

                if ($request->is_right_hend) {
                    foreach ($request->right_measurements as $m) {
                        if(isset($m['systolic']) && isset($m['diastolic']) && isset($m['pulse'])) {
                            PressureMeasurement::create([
                                'systolic' => $m['systolic'],
                                'diastolic' => $m['diastolic'],
                                'pulse' => $m['pulse'],
                                'hand' => 'right',
                                'measurement_id' => $measurement->id,
                            ]);
                        }
                    }
                }
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while saving the measurements.'], 500);
        }

        return response()->json(['success' => true]);
    }

    public function dataTable (Request $request){
        $request->validate([
            'per_page' => 'required|numeric',
            'next_page_url' => 'nullable|string',
        ]);
        $measurements = MeasurementRepository::getForCurrentUser($request->per_page, $request->next_page_url);
        return response()->json(['success' => true, 'measurements' => $measurements]);
    }

}
