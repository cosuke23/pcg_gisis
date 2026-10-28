<?php

namespace App\Http\Controllers;

use App\Models\ThematicMapping;
use Illuminate\Http\Request;

class ThematicMappingController extends Controller
{

    public function index()
    {
        $maps = ThematicMapping::latest()->get();

        return view('thematic_mapping.index', compact('maps'));
    }

    public function create()
    {
        return view('thematic_mapping.create');
    }

    public function store(Request $request)
    {

        $request->validate([

            'map_title' => 'required',

            'category' => 'required',

            'geometry_type' => 'required',

            'location_name' => 'required',

            'latitude' => 'required',

            'longitude' => 'required'

        ]);

        ThematicMapping::create($request->all());

        return redirect()
            ->route('thematic-mappings.index')
            ->with('success', 'Thematic Mapping added successfully.');
    }

    public function show(ThematicMapping $thematicMapping)
    {
        return view('thematic_mapping.show', compact('thematicMapping'));
    }

    public function edit(ThematicMapping $thematicMapping)
    {
        return view('thematic_mapping.edit', compact('thematicMapping'));
    }

    public function update(Request $request, ThematicMapping $thematicMapping)
    {

        $request->validate([

            'map_title' => 'required',

            'category' => 'required',

            'geometry_type' => 'required',

            'location_name' => 'required',

            'latitude' => 'required',

            'longitude' => 'required'

        ]);

        $thematicMapping->update($request->all());

        return redirect()
            ->route('thematic-mappings.index')
            ->with('success', 'Thematic Mapping updated successfully.');
    }

    public function destroy(ThematicMapping $thematicMapping)
    {

        $thematicMapping->delete();

        return redirect()
            ->route('thematic-mappings.index')
            ->with('success', 'Thematic Mapping deleted successfully.');
    }
}
