<?php

namespace App\Http\Controllers;

use App\Models\WaterQualityMonitoring;
use Illuminate\Http\Request;

class WaterQualityMonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reports = WaterQualityMonitoring::latest()->paginate(10);

        return view('water_quality_monitorings.index', compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('water_quality_monitorings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            // Report Information
            'report_number'          => 'required|string|max:255|unique:water_quality_monitorings,report_number',
            'monitoring_date'        => 'required|date',

            // Location
            'monitoring_station'     => 'required|string|max:255',
            'body_of_water'          => 'required|string|max:255',
            'region'                 => 'required|string|max:255',
            'province'               => 'required|string|max:255',
            'city_municipality'      => 'required|string|max:255',
            'barangay'               => 'nullable|string|max:255',
            'latitude'               => 'nullable|numeric',
            'longitude'              => 'nullable|numeric',

            // Water Quality Parameters
            'temperature'            => 'nullable|numeric',
            'ph_level'               => 'nullable|numeric',
            'dissolved_oxygen'       => 'nullable|numeric',
            'salinity'               => 'nullable|numeric',
            'turbidity'              => 'nullable|numeric',
            'conductivity'           => 'nullable|numeric',
            'ammonia'                => 'nullable|numeric',
            'nitrate'                => 'nullable|numeric',
            'phosphate'              => 'nullable|numeric',

            // Assessment
            'water_quality_status'   => 'required|in:Good,Fair,Poor,Critical',
            'pollution_source'       => 'nullable|string|max:255',
            'observed_condition'     => 'nullable|string',
            'recommendations'        => 'nullable|string',
            'remarks'                => 'nullable|string',

            // Personnel
            'inspector_name'         => 'required|string|max:255',
        ]);

        WaterQualityMonitoring::create($validated);

        return redirect()
            ->route('water-quality-monitorings.index')
            ->with('success', 'Water Quality Monitoring Report created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(WaterQualityMonitoring $waterQualityMonitoring)
    {
        return view(
            'water_quality_monitorings.show',
            compact('waterQualityMonitoring')
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WaterQualityMonitoring $waterQualityMonitoring)
    {
        return view(
            'water_quality_monitorings.edit',
            compact('waterQualityMonitoring')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WaterQualityMonitoring $waterQualityMonitoring)
    {
        $validated = $request->validate([

            // Report Information
            'report_number' => 'required|string|max:255|unique:water_quality_monitorings,report_number,' . $waterQualityMonitoring->id,
            'monitoring_date' => 'required|date',

            // Location
            'monitoring_station' => 'required|string|max:255',
            'body_of_water' => 'required|string|max:255',
            'region' => 'required|string|max:255',
            'province' => 'required|string|max:255',
            'city_municipality' => 'required|string|max:255',
            'barangay' => 'nullable|string|max:255',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',

            // Water Quality Parameters
            'temperature' => 'nullable|numeric',
            'ph_level' => 'nullable|numeric',
            'dissolved_oxygen' => 'nullable|numeric',
            'salinity' => 'nullable|numeric',
            'turbidity' => 'nullable|numeric',
            'conductivity' => 'nullable|numeric',
            'ammonia' => 'nullable|numeric',
            'nitrate' => 'nullable|numeric',
            'phosphate' => 'nullable|numeric',

            // Assessment
            'water_quality_status' => 'required|in:Good,Fair,Poor,Critical',
            'pollution_source' => 'nullable|string|max:255',
            'observed_condition' => 'nullable|string',
            'recommendations' => 'nullable|string',
            'remarks' => 'nullable|string',

            // Personnel
            'inspector_name' => 'required|string|max:255',
        ]);

        $waterQualityMonitoring->update($validated);

        return redirect()
            ->route('water-quality-monitorings.index')
            ->with('success', 'Water Quality Monitoring Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WaterQualityMonitoring $waterQualityMonitoring)
    {
        $waterQualityMonitoring->delete();

        return redirect()
            ->route('water-quality-monitorings.index')
            ->with('success', 'Water Quality Monitoring Report deleted successfully.');
    }
}
