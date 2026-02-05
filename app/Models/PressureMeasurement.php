<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PressureMeasurement extends Model
{
    use HasFactory;

    /**
     * Атрибуты, которые можно массово назначать.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'systolic',
        'diastolic',
        'pulse',
        'hand',
        'user_id',
    ];

    /**
     * Получить пользователя, которому принадлежит измерение.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
