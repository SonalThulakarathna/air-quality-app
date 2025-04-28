<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = ['sensor_id', 'aqi_value', 'alert_type', 'triggered_at', 'resolved_at', 'status'];

    public function sensor()
    {
        return $this->belongsTo(Sensor::class);
    }
}

