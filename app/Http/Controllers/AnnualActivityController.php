<?php

namespace App\Http\Controllers;

use App\Models\AnnualActivity;
use Illuminate\Http\Request;

class AnnualActivityController extends Controller
{
    public function index()
    {
        $annualActivities = AnnualActivity::latest()->get();

        return view('annual_activities.index', compact('annualActivities'));
    }

    public function create()
    {
        return view('annual_activities.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_title' => 'required|max:255',
            'activity_date' => 'required|date',
            'location' => 'required|max:255',
            'activity_type' => 'required|max:255',
        ]);

        AnnualActivity::create([
            'activity_title' => $request->activity_title,
            'activity_date' => $request->activity_date,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'conducted_by' => $request->conducted_by,
            'activity_type' => $request->activity_type,
            'participants' => $request->participants ?? 0,
            'is_active' => 1,
        ]);

        return redirect()
            ->route('annual_activities.index')
            ->with('success', 'Annual Activity added successfully.');
    }

    public function edit(AnnualActivity $annualActivity)
    {
        return view('annual_activities.edit', compact('annualActivity'));
    }

    public function update(Request $request, AnnualActivity $annualActivity)
    {
        $request->validate([
            'activity_title' => 'required|max:255',
            'activity_date' => 'required|date',
            'location' => 'required|max:255',
            'activity_type' => 'required|max:255',
        ]);

        $annualActivity->update([
            'activity_title' => $request->activity_title,
            'activity_date' => $request->activity_date,
            'location' => $request->location,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'description' => $request->description,
            'conducted_by' => $request->conducted_by,
            'activity_type' => $request->activity_type,
            'participants' => $request->participants ?? 0,
            'is_active' => $annualActivity->is_active,
        ]);

        return redirect()
            ->route('annual_activities.index')
            ->with('success', 'Annual Activity updated successfully.');
    }

    public function destroy(AnnualActivity $annualActivity)
    {
        $annualActivity->delete();

        return redirect()
            ->route('annual_activities.index')
            ->with('success', 'Annual Activity deleted successfully.');
    }
}