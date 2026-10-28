<?php

namespace App\Http\Controllers;

use App\Models\OilSpillIncident;

class GISDashboardController extends Controller
{
    public function index()
    {
        $incidents = OilSpillIncident::latest()->get();

        return view('gis.dashboard', compact('incidents'));
    }
}
