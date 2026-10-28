<?php

namespace App\Http\Controllers;

use App\Models\CoralAssessment;
use Illuminate\Http\Request;

class CoralAssessmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $assessments = CoralAssessment::latest()->get();

        return view('coral_assessments.index', compact('assessments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coral_assessments.create');
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $request->validate([
            'assessment_number' => 'required|unique:coral_assessments,assessment_number',
            'assessment_date' => 'required|date',
            'site_name' => 'required|string|max:255',
            'reef_type' => 'required|string|max:255',
            'assessment_method' => 'required|string|max:255',
            'team_leader' => 'required|string|max:255',
            'reef_condition' => 'required|string|max:100',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        CoralAssessment::create([

            'assessment_number' => $request->assessment_number,
            'assessment_date' => $request->assessment_date,
            'site_name' => $request->site_name,
            'reef_type' => $request->reef_type,
            'assessment_method' => $request->assessment_method,
            'team_leader' => $request->team_leader,

            'live_coral_cover' => $request->live_coral_cover,
            'dead_coral_cover' => $request->dead_coral_cover,
            'algae_cover' => $request->algae_cover,
            'sand_cover' => $request->sand_cover,

            'reef_condition' => $request->reef_condition,
            'implementing_agency' => $request->implementing_agency,

            'rehabilitation_required' => $request->has('rehabilitation_required'),

            'rehabilitation_start' => $request->rehabilitation_start,
            'rehabilitation_end' => $request->rehabilitation_end,
            'rehabilitation_method' => $request->rehabilitation_method,

            'location_name' => $request->location_name,
            'region' => $request->region,
            'province' => $request->province,
            'municipality' => $request->municipality,

            'latitude' => $request->latitude,
            'longitude' => $request->longitude,

            'geojson' => $request->geojson,

            'remarks' => $request->remarks,

            'status' => $request->status,

        ]);

        return redirect()
            ->route('coral-assessments.index')
            ->with('success', 'Coral Assessment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(CoralAssessment $coralAssessment)
    {
        return view('coral_assessments.show', [
            'assessment' => $coralAssessment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CoralAssessment $coralAssessment)
    {
        return view('coral_assessments.edit', [
            'assessment' => $coralAssessment
        ]);
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, CoralAssessment $coralAssessment)
    {
        $request->validate([
            'assessment_number' => 'required|unique:coral_assessments,assessment_number,' . $coralAssessment->id,
            'assessment_date' => 'required|date',
            'site_name' => 'required|string|max:255',
            'reef_type' => 'required|string|max:255',
            'assessment_method' => 'required|string|max:255',
            'team_leader' => 'required|string|max:255',
            'reef_condition' => 'required|string|max:100',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $coralAssessment->update([

            'assessment_number' => $request->assessment_number,
            'assessment_date' => $request->assessment_date,
            'site_name' => $request->site_name,
            'reef_type' => $request->reef_type,
            'assessment_method' => $request->assessment_method,
            'team_leader' => $request->team_leader,

            'live_coral_cover' => $request->live_coral_cover,
            'dead_coral_cover' => $request->dead_coral_cover,
            'algae_cover' => $request->algae_cover,
            'sand_cover' => $request->sand_cover,

            'reef_condition' => $request->reef_condition,
            'implementing_agency' => $request->implementing_agency,

            'rehabilitation_required' => $request->has('rehabilitation_required'),

            'rehabilitation_start' => $request->rehabilitation_start,
            'rehabilitation_end' => $request->rehabilitation_end,
            'rehabilitation_method' => $request->rehabilitation_method,

            'location_name' => $request->location_name,
            'region' => $request->region,
            'province' => $request->province,
            'municipality' => $request->municipality,

            'latitude' => $request->latitude,
            'longitude' => $request->longitude,

            'geojson' => $request->geojson,

            'remarks' => $request->remarks,

            'status' => $request->status,

        ]);

        return redirect()
            ->route('coral-assessments.index')
            ->with('success', 'Coral Assessment updated successfully.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(CoralAssessment $coralAssessment)
    {
        $coralAssessment->delete();

        return redirect()
            ->route('coral-assessments.index')
            ->with('success', 'Coral Assessment deleted successfully.');
    }
}
