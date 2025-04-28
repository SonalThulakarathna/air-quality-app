<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Sensor;
use App\Models\AqiData;
use App\Models\Alert;
use Carbon\Carbon;

class GenerateAqiData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-aqi-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate random AQI data for each sensor and send alerts if needed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $sensors = Sensor::all();
        foreach ($sensors as $sensor) {
            $aqi = rand(0, 300); // Random AQI value
            $aqiData = AqiData::create([
                'sensor_id' => $sensor->id,
                'aqi_value' => $aqi,
                'recorded_at' => Carbon::now(),
            ]);

            // Check for alert condition (example: AQI > 100)
            if ($aqi > 100) {
                Alert::create([
                    'sensor_id' => $sensor->id,
                    'aqi_value' => $aqi,
                    'alert_type' => $aqi > 200 ? 'danger' : 'warning',
                    'triggered_at' => Carbon::now(),
                    'status' => 'active',
                ]);
            }
        }
        $this->info('AQI data generated and alerts checked.');
    }
}
