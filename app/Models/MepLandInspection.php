<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MepLandInspection extends Model
{
    protected $table = 'mep_land_inspections';

    protected $fillable = [

        'inspection_number',

        'inspection_date',

        'facility_name',

        'facility_type',

        'owner',

        'permit_number',

        'inspection_location',

        'city_municipality',

        'province',

        'inspector_name',

        'compliance_status',

        'findings',

        'recommendations',

        'remarks',

    ];
}