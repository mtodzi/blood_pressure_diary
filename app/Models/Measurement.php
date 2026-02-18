<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'systolic',
        'diastolic',
        'pulse',
        'hand',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function pressureMeasurements(): HasMany
    {
        return $this->hasMany(PressureMeasurement::class);
    }
}
