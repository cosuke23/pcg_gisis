<?php

namespace App\Http\Controllers;

use App\Models\DumpSite;
use Illuminate\Http\Request;


class DumpSiteController extends Controller
{


    public function index()
    {

        $dumpSites = DumpSite::latest()->get();


        return view(
            'dump_sites.index',
            compact('dumpSites')
        );
    }





    public function create()
    {

        return view('dump_sites.create');
    }





    public function store(Request $request)
    {


        $request->validate([

            'site_name' => 'required',
            'location' => 'required',

        ]);



        DumpSite::create([

            'country' => $request->country ?? 'Philippines',

            'site_name' => $request->site_name,

            'location' => $request->location,

            'latitude' => $request->latitude,

            'longitude' => $request->longitude,

            'description' => $request->description,

            'is_active' => 1

        ]);



        return redirect()

            ->route('dump_sites.index')

            ->with(
                'success',
                'Dump Site added successfully.'
            );
    }





    public function edit(DumpSite $dumpSite)
    {

        return view(
            'dump_sites.edit',
            compact('dumpSite')
        );
    }





    public function update(Request $request, DumpSite $dumpSite)
    {


        $request->validate([

            'site_name' => 'required',
            'location' => 'required',

        ]);



        $dumpSite->update([

            'country' => $request->country ?? 'Philippines',

            'site_name' => $request->site_name,

            'location' => $request->location,

            'latitude' => $request->latitude,

            'longitude' => $request->longitude,

            'description' => $request->description,

        ]);



        return redirect()

            ->route('dump_sites.index')

            ->with(
                'success',
                'Dump Site updated successfully.'
            );
    }





    public function destroy(DumpSite $dumpSite)
    {


        $dumpSite->delete();



        return redirect()

            ->route('dump_sites.index')

            ->with(
                'success',
                'Dump Site deleted successfully.'
            );
    }
}
