<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoralAssessment extends Model
{
    use HasFactory;

    protected $table = 'coral_assessments';

    protected $fillable = [
        'assessment_number',
        'assessment_date',
        'site_name',
        'region',
        'province',
        'municipality',
        'latitude',
        'longitude',
        'geojson',
        'reef_type',
        'assessment_method',
        'live_coral_cover',
        'dead_coral_cover',
        'algae_cover',
        'sand_cover',
        'reef_condition',
        'rehabilitation_required',
        'rehabilitation_start',
        'rehabilitation_end',
        'rehabilitation_method',
        'implementing_agency',
        'team_leader',
        'remarks',
        'status',
    ];

    protected $casts = [
        'assessment_date' => 'date',
        'rehabilitation_start' => 'date',
        'rehabilitation_end' => 'date',
        'rehabilitation_required' => 'boolean',
        'status' => 'boolean',
        'latitude' => 'decimal:7',
        'longitude' => 'decimal:7',
        'live_coral_cover' => 'decimal:2',
        'dead_coral_cover' => 'decimal:2',
        'algae_cover' => 'decimal:2',
        'sand_cover' => 'decimal:2',
    ];
}
