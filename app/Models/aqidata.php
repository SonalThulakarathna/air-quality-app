<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AqiData extends Model
{
    use HasFactory;

    protected $fillable = ['sensor_id', 'aqi_value', 'recorded_at'];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}

