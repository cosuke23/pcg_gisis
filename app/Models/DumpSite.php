<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class DumpSite extends Model
{

    use HasFactory;


    protected $fillable = [

        'country',
        'site_name',
        'location',
        'latitude',
        'longitude',
        'description',
        'is_active'

    ];

}