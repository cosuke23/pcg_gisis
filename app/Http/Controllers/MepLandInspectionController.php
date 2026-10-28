<?php

namespace App\Http\Controllers;

use App\Models\MepLandInspection;
use Illuminate\Http\Request;

class MepLandInspectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inspections = MepLandInspection::latest()->get();

        return view(
            'land_inspections.index',
            compact('inspections')
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('land_inspections.create');
    }

    /**
     * Store a newly created resource.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'inspection_number'     => 'required|unique:mep_land_inspections,inspection_number',

            'inspection_date'       => 'required|date',

            'facility_name'         => 'required|string|max:255',

            'facility_type'         => 'nullable|string|max:255',

            'owner'                 => 'nullable|string|max:255',

            'permit_number'         => 'nullable|string|max:255',

            'inspection_location'   => 'required|string|max:255',

            'city_municipality'     => 'nullable|string|max:255',

            'province'              => 'nullable|string|max:255',

            'inspector_name'        => 'required|string|max:255',

            'compliance_status'     => 'required|in:Pending,Compliant,Non-Compliant,For Reinspection',

            'findings'              => 'nullable|string',

            'recommendations'       => 'nullable|string',

            'remarks'               => 'nullable|string',

        ]);

        MepLandInspection::create($validated);

        return redirect()
            ->route('land_inspections.index')
            ->with('success', 'Land-based inspection successfully created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(MepLandInspection $land_inspection)
    {
        return view(
            'land_inspections.show',
            [
                'mepLandInspection' => $land_inspection
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MepLandInspection $land_inspection)
    {
        return view(
            'land_inspections.edit',
            [
                'mepLandInspection' => $land_inspection
            ]
        );
    }

    /**
     * Update the specified resource.
     */
    public function update(Request $request, MepLandInspection $land_inspection)
    {
        $validated = $request->validate([

            'inspection_number'     => 'required|unique:mep_land_inspections,inspection_number,' . $land_inspection->id,

            'inspection_date'       => 'required|date',

            'facility_name'         => 'required|string|max:255',

            'facility_type'         => 'nullable|string|max:255',

            'owner'                 => 'nullable|string|max:255',

            'permit_number'         => 'nullable|string|max:255',

            'inspection_location'   => 'required|string|max:255',

            'city_municipality'     => 'nullable|string|max:255',

            'province'              => 'nullable|string|max:255',

            'inspector_name'        => 'required|string|max:255',

            'compliance_status'     => 'required|in:Pending,Compliant,Non-Compliant,For Reinspection',

            'findings'              => 'nullable|string',

            'recommendations'       => 'nullable|string',

            'remarks'               => 'nullable|string',

        ]);

        $land_inspection->update($validated);

        return redirect()
            ->route('land_inspections.index')
            ->with('success', 'Land-based inspection successfully updated.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(MepLandInspection $land_inspection)
    {
        $land_inspection->delete();

        return redirect()
            ->route('land_inspections.index')
            ->with('success', 'Land-based inspection successfully deleted.');
    }
}
