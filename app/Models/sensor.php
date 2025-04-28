<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\User;
use App\Models\AqiData;
use Carbon\Carbon;

class Sensor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'sensor_id',
        'latitude',
        'longitude',
        'location_description',
        'installed_by',
        'is_active'
    ];

    public function installer()
    {
        return $this->belongsTo(User::class, 'installed_by');
    }

    public function aqiData()
    {
        return $this->hasMany(AqiData::class);
    }

    public function alerts()
    {
        return $this->hasMany(Alert::class);
    }

    protected static function booted()
    {
        static::created(function ($sensor) {
            AqiData::create([
                'sensor_id' => $sensor->id,
                'aqi_value' => rand(0, 300),
                'recorded_at' => Carbon::now(),
            ]);
        });
    }
}

