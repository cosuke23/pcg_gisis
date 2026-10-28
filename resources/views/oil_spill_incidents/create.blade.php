@extends('layouts.app')

@section('title', 'Add Oil Spill Incident')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css">

    <style>
        #map {
            height: 500px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid">

        <div class="card">

            <div class="card-header">

                <h3>

                    <i class="fas fa-water"></i>

                    Report Oil Spill Incident

                </h3>

            </div>

            <div class="card-body">

                <form action="{{ route('oil_spill_incidents.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Incident Date</label>

                            <input type="date" name="incident_date" value="{{ date('Y-m-d') }}" class="form-control"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Incident Time</label>

                            <input type="time" name="incident_time" value="{{ date('H:i') }}" class="form-control"
                                required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Oil Spill Type</label>

                            <select name="spill_type" class="form-select" required>

                                <option value="">Select Type</option>
                                <option>Crude Oil</option>
                                <option>Diesel</option>
                                <option>Fuel Oil</option>
                                <option>Lubricating Oil</option>
                                <option>Chemical</option>
                                <option>Unknown</option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Spill Source</label>

                            <select name="spill_source" class="form-select" required>

                                <option value="">Select Source</option>
                                <option>Ship</option>
                                <option>Pipeline</option>
                                <option>Terminal</option>
                                <option>Port</option>
                                <option>Unknown</option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Estimated Volume</label>

                            <input type="number" step="0.01" name="estimated_volume" class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Volume Unit</label>

                            <select name="volume_unit" class="form-select">

                                <option>Liters</option>
                                <option>Gallons</option>
                                <option>Barrels</option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Severity Level</label>

                            <select name="severity_level" class="form-select" required>

                                <option value="">Select</option>
                                <option>Low</option>
                                <option>Moderate</option>
                                <option>High</option>
                                <option>Critical</option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Response Status</label>

                            <select name="response_status" class="form-select">

                                <option>Ongoing</option>
                                <option>Contained</option>
                                <option>Cleaned Up</option>
                                <option>Closed</option>

                            </select>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Affected Area</label>

                        <input type="text" id="affected_area" name="affected_area" class="form-control" required>

                    </div>

                    <div class="mb-3">

                        <label>Select Incident Location</label>

                        <div id="map"></div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Latitude</label>

                            <input type="text" id="latitude" name="latitude" class="form-control" readonly>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Longitude</label>

                            <input type="text" id="longitude" name="longitude" class="form-control" readonly>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Contact Point</label>

                            <select name="contact_point_id" class="form-select">

                                <option value="">Select Contact Point</option>

                                @foreach ($contactPoints as $contact)
                                    <option value="{{ $contact->id }}">
                                        {{ $contact->name }} - {{ $contact->agency }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Dump Site</label>

                            <select name="dump_site_id" class="form-select">

                                <option value="">Select Dump Site</option>

                                @foreach ($dumpSites as $site)
                                    <option value="{{ $site->id }}">
                                        {{ $site->site_name }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Description</label>

                        <textarea name="description" rows="4" class="form-control"></textarea>

                    </div>

                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Save Incident
                    </button>

                    <a href="{{ route('oil_spill_incidents.index') }}" class="btn btn-secondary">
                        Cancel
                    </a>

                </form>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let lat = 12.8797;
            let lng = 121.7740;

            let map = L.map('map').setView([lat, lng], 6);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            let marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

            update(lat, lng);

            function update(lat, lng) {

                marker.setLatLng([lat, lng]);

                document.getElementById('latitude').value = lat.toFixed(7);
                document.getElementById('longitude').value = lng.toFixed(7);

            }

            marker.on('dragend', function() {

                let p = marker.getLatLng();

                update(p.lat, p.lng);

            });

            map.on('click', function(e) {

                update(e.latlng.lat, e.latlng.lng);

            });

            L.Control.geocoder({
                    defaultMarkGeocode: false
                })
                .on('markgeocode', function(e) {

                    let c = e.geocode.center;

                    map.setView(c, 15);

                    update(c.lat, c.lng);

                    document.getElementById('affected_area').value = e.geocode.name;

                })
                .addTo(map);

            setTimeout(function() {

                map.invalidateSize();

            }, 300);

        });
    </script>
@endpush
