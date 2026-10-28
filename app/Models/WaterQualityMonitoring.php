<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WaterQualityMonitoring extends Model
{
    //
    protected $fillable = [

        'report_number',
        'monitoring_date',

        'monitoring_station',
        'body_of_water',

        'region',
        'province',
        'city_municipality',
        'barangay',

        'latitude',
        'longitude',

        'temperature',
        'ph_level',
        'dissolved_oxygen',
        'salinity',
        'turbidity',
        'conductivity',
        'ammonia',
        'nitrate',
        'phosphate',

        'water_quality_status',
        'pollution_source',

        'observed_condition',
        'recommendations',
        'remarks',

        'inspector_name'
    ];
}
