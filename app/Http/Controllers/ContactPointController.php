<?php

namespace App\Http\Controllers;

use App\Models\ContactPoint;
use Illuminate\Http\Request;


class ContactPointController extends Controller
{

    public function index()
    {
        $contactPoints = ContactPoint::latest()->get();

        return view('contact_points.index', compact('contactPoints'));
    }



    public function create()
    {
        return view('contact_points.create');
    }

    public function store(Request $request)
    {

        $request->validate([

            'name' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'office' => 'required',
            'telephone' => 'required'

        ]);


        ContactPoint::create([

            'country' => $request->country ?? 'Philippines',
            'name' => $request->name,
            'email' => $request->email,
            'telephone' => $request->telephone,
            'position' => $request->position,
            'agency' => $request->office,
            'is_active' => 1

        ]);


        return redirect()
            ->route('contact_points.index')
            ->with('success', 'Contact Point added successfully.');
    }
    
    public function edit(ContactPoint $contactPoint)
    {
        return view('contact_points.edit', compact('contactPoint'));
    }




    public function update(Request $request, ContactPoint $contactPoint)
    {

        $request->validate([

            'id' => 'required|exists:contact_points,id',
            'name' => 'required',
            'email' => 'required|email',
            'position' => 'required',
            'office' => 'required',
            'contact_number' => 'required'

        ]);


        ContactPoint::where('id', $request->id)
            ->update([

                'country' => $request->country ?? 'Philippines',
                'name' => $request->name,
                'email' => $request->email,
                'telephone' => $request->contact_number,
                'position' => $request->position,
                'agency' => $request->office,
                'is_active' => 1

            ]);



        return redirect()
            ->route('contact_points.index')
            ->with('success', 'Contact Point updated successfully.');
    }

    public function destroy(ContactPoint $contactPoint)
    {

        $contactPoint->delete();


        return redirect()
            ->route('contact_points.index')
            ->with('success', 'Contact Point deleted successfully.');
    }
}
