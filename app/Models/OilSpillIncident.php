<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OilSpillIncident extends Model
{
    protected $fillable = [

        'incident_number',
        'incident_date',
        'incident_time',
        'spill_type',
        'spill_source',
        'estimated_volume',
        'volume_unit',
        'severity_level',
        'affected_area',
        'latitude',
        'longitude',
        'description',
        'response_status',
        'contact_point_id',
        'dump_site_id'

    ];
}
