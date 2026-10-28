<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactPointController;
use App\Http\Controllers\DumpSiteController;
use App\Http\Controllers\AnnualActivityController;
use App\Http\Controllers\OilSpillIncidentController;
use App\Http\Controllers\GISDashboardController;
use App\Http\Controllers\MepVesselInspectionController;
use App\Http\Controllers\MepLandInspectionController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\EnvironmentalReportController;
use App\Http\Controllers\WaterQualityMonitoringController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\ThematicMappingController;
use App\Http\Controllers\CoralAssessmentController;
use App\Http\Controllers\ChatbotController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    Route::resource(
        'contact_points',
        ContactPointController::class
    );
    Route::resource(
        'dump_sites',
        DumpSiteController::class
    );
    Route::resource(
        'annual_activities',
        AnnualActivityController::class
    );
    Route::resource(
        'oil_spill_incidents',
        OilSpillIncidentController::class
    );
    Route::get('/gis-dashboard', [GISDashboardController::class, 'index'])
        ->name('gis.dashboard');
    Route::get(
        '/oil-spill-dashboard',
        [OilSpillIncidentController::class, 'dashboard']
    )->name('oil_spill_incidents.dashboard');
    Route::resource(
        'mep/vessel-inspections',
        MepVesselInspectionController::class
    )
        ->names('mep.vessel-inspections');
    Route::resource(
        'land_inspections',
        MepLandInspectionController::class
    );
    Route::get('/reports', [ReportsController::class, 'index'])
        ->name('reports.index');
    Route::get(
        '/environmental-report/pdf',
        [EnvironmentalReportController::class, 'pdf']
    )->name('environmental.report.pdf');
    Route::resource(
        'water-quality-monitorings',
        WaterQualityMonitoringController::class
    )->names('water-quality-monitorings');
    Route::resource('users', UserManagementController::class);
    Route::resource('thematic-mappings', ThematicMappingController::class);
    Route::resource('coral-assessments', CoralAssessmentController::class);
    Route::post('/chatbot', [ChatbotController::class, 'chat']);
});

require __DIR__ . '/auth.php';
