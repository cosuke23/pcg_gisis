<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MepVesselInspection extends Model
{
    use HasFactory;


    protected $fillable = [

        'inspection_number',

        'inspection_date',

        'vessel_name',

        'official_number',

        'imo_number',

        'call_sign',

        'flag',

        'vessel_type',

        'owner',

        'master',

        'inspection_location',

        'inspector_name',

        'inspection_status',

        'remarks'

    ];
}
