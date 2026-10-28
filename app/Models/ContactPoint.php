<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPoint extends Model
{
    use HasFactory;


    protected $fillable = [

        'name',
        'position',
        'agency',
        'telephone',
        'email',
        'address'

    ];
}