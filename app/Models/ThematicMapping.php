<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ThematicMapping extends Model
{
    protected $fillable = [

        'map_title',

        'category',

        'geometry_type',

        'location_name',

        'region',

        'province',

        'municipality',

        'latitude',

        'longitude',

        'geojson',

        'description',

        'status'

    ];
}
