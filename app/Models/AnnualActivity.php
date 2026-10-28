<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnualActivity extends Model
{
    protected $fillable = [

        'activity_title',

        'activity_date',

        'location',

        'latitude',

        'longitude',

        'description',

        'conducted_by',

        'activity_type',

        'participants',

        'is_active'

    ];
}
