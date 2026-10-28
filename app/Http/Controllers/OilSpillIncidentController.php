<?php

namespace App\Http\Controllers;

use App\Models\OilSpillIncident;
use App\Models\ContactPoint;
use App\Models\DumpSite;
use Illuminate\Http\Request;

    class OilSpillIncidentController extends Controller
    {
        public function index()
        {
            $incidents = OilSpillIncident::latest()->get();

            return view('oil_spill_incidents.index', compact('incidents'));
        }

        public function create()
        {
            $contactPoints = ContactPoint::where('is_active', 1)->get();

            $dumpSites = DumpSite::where('is_active', 1)->get();

            return view(
                'oil_spill_incidents.create',
                compact(
                    'contactPoints',
                    'dumpSites'
                )
            );
        }

        public function store(Request $request)
        {
            $request->validate([

                'incident_date'    => 'required|date',
                'incident_time'    => 'required',
                'spill_type'       => 'required',
                'spill_source'     => 'required',
                'estimated_volume' => 'nullable|numeric',
                'severity_level'   => 'required',
                'affected_area'    => 'required',
                'latitude'         => 'required',
                'longitude'        => 'required',

            ]);

            // Generate Incident Number
            $last = OilSpillIncident::latest('id')->first();

            if ($last) {

                $next = $last->id + 1;
            } else {

                $next = 1;
            }

            $incidentNumber =
                'OSI-' .
                date('Y') .
                '-' .
                str_pad($next, 5, '0', STR_PAD_LEFT);

            OilSpillIncident::create([

                'incident_number'  => $incidentNumber,
                'incident_date'    => $request->incident_date,
                'incident_time'    => $request->incident_time,
                'spill_type'       => $request->spill_type,
                'spill_source'     => $request->spill_source,
                'estimated_volume' => $request->estimated_volume,
                'volume_unit'      => $request->volume_unit,
                'severity_level'   => $request->severity_level,
                'affected_area'    => $request->affected_area,
                'latitude'         => $request->latitude,
                'longitude'        => $request->longitude,
                'description'      => $request->description,
                'response_status'  => $request->response_status,
                'contact_point_id' => $request->contact_point_id,
                'dump_site_id'     => $request->dump_site_id,

            ]);

            return redirect()
                ->route('oil_spill_incidents.index')
                ->with(
                    'success',
                    'Oil Spill Incident added successfully.'
                );
        }

        public function edit(OilSpillIncident $oil_spill_incident)
        {
            $contactPoints = ContactPoint::where('is_active', 1)->get();

            $dumpSites = DumpSite::where('is_active', 1)->get();

            return view(
                'oil_spill_incidents.edit',
                [
                    'incident'      => $oil_spill_incident,
                    'contactPoints' => $contactPoints,
                    'dumpSites'     => $dumpSites,
                ]
            );
        }

        public function update(
            Request $request,
            OilSpillIncident $oil_spill_incident
        ) {

            $request->validate([

                'incident_date'    => 'required|date',
                'incident_time'    => 'required',
                'spill_type'       => 'required',
                'spill_source'     => 'required',
                'estimated_volume' => 'nullable|numeric',
                'severity_level'   => 'required',
                'affected_area'    => 'required',
                'latitude'         => 'required',
                'longitude'        => 'required',

            ]);

            $oil_spill_incident->update([

                'incident_date'    => $request->incident_date,
                'incident_time'    => $request->incident_time,
                'spill_type'       => $request->spill_type,
                'spill_source'     => $request->spill_source,
                'estimated_volume' => $request->estimated_volume,
                'volume_unit'      => $request->volume_unit,
                'severity_level'   => $request->severity_level,
                'affected_area'    => $request->affected_area,
                'latitude'         => $request->latitude,
                'longitude'        => $request->longitude,
                'description'      => $request->description,
                'response_status'  => $request->response_status,
                'contact_point_id' => $request->contact_point_id,
                'dump_site_id'     => $request->dump_site_id,

            ]);

            return redirect()
                ->route('oil_spill_incidents.index')
                ->with(
                    'success',
                    'Oil Spill Incident updated successfully.'
                );
        }

        public function destroy(OilSpillIncident $oil_spill_incident)
        {
            $oil_spill_incident->delete();

            return redirect()
                ->route('oil_spill_incidents.index')
                ->with(
                    'success',
                    'Oil Spill Incident deleted successfully.'
                );
        }
        public function dashboard()
        {
            $incidents = OilSpillIncident::select(
                'id',
                'incident_number',
                'incident_date',
                'spill_type',
                'severity_level',
                'response_status',
                'estimated_volume',
                'affected_area',
                'latitude',
                'longitude'
            )->get();

            return view('oil_spill_incidents.dashboard', compact('incidents'));
        }
    }
