<?php

namespace App\Http\Controllers;

use App\Models\MepVesselInspection;
use Illuminate\Http\Request;

class MepVesselInspectionController extends Controller
{
    public function index()
    {
        $inspections = MepVesselInspection::latest()->get();

        return view('vessel_inspections.index', compact('inspections'));
    }

    public function create()
    {
        return view('vessel_inspections.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([

            'inspection_number'   => 'required|unique:mep_vessel_inspections,inspection_number',
            'inspection_date'     => 'required|date',
            'vessel_name'         => 'required|string|max:255',
            'official_number'     => 'nullable|string|max:255',
            'imo_number'          => 'nullable|string|max:255',
            'call_sign'           => 'nullable|string|max:255',
            'flag'                => 'nullable|string|max:255',
            'vessel_type'         => 'nullable|string|max:255',
            'owner'               => 'nullable|string|max:255',
            'master'              => 'nullable|string|max:255',
            'inspection_location' => 'required|string|max:255',
            'inspector_name'      => 'required|string|max:255',
            'inspection_status'   => 'required|in:Pending,Passed,Failed,For Correction',
            'remarks'             => 'nullable|string',

        ]);

        MepVesselInspection::create($validated);

        return redirect()
            ->route('mep.vessel-inspections.index')
            ->with('success', 'Inspection record successfully created.');
    }

    public function show(MepVesselInspection $vessel_inspection)
    {
        return view('vessel_inspections.show', [
            'mepVesselInspection' => $vessel_inspection
        ]);
    }

    public function edit(MepVesselInspection $vessel_inspection)
    {
        return view('vessel_inspections.edit', [
            'mepVesselInspection' => $vessel_inspection
        ]);
    }

    public function update(Request $request, MepVesselInspection $vessel_inspection)
    {
        $validated = $request->validate([

            'inspection_number'   => 'required|unique:mep_vessel_inspections,inspection_number,' . $vessel_inspection->id,
            'inspection_date'     => 'required|date',
            'vessel_name'         => 'required|string|max:255',
            'official_number'     => 'nullable|string|max:255',
            'imo_number'          => 'nullable|string|max:255',
            'call_sign'           => 'nullable|string|max:255',
            'flag'                => 'nullable|string|max:255',
            'vessel_type'         => 'nullable|string|max:255',
            'owner'               => 'nullable|string|max:255',
            'master'              => 'nullable|string|max:255',
            'inspection_location' => 'required|string|max:255',
            'inspector_name'      => 'required|string|max:255',
            'inspection_status'   => 'required|in:Pending,Passed,Failed,For Correction',
            'remarks'             => 'nullable|string',

        ]);

        $vessel_inspection->update($validated);

        return redirect()
            ->route('mep.vessel-inspections.index')
            ->with('success', 'Inspection record successfully updated.');
    }

    public function destroy(MepVesselInspection $vessel_inspection)
    {
        $vessel_inspection->delete();

        return redirect()
            ->route('mep.vessel-inspections.index')
            ->with('success', 'Inspection record successfully deleted.');
    }
}
