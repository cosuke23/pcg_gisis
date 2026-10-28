@extends('layouts.app')

@section('title', 'Edit Oil Spill Incident')

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
                    <i class="fas fa-edit"></i>
                    Edit Oil Spill Incident
                </h3>

            </div>

            <div class="card-body">

                <form action="{{ route('oil_spill_incidents.update', $incident->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Incident Date</label>

                            <input type="date" name="incident_date" class="form-control"
                                value="{{ $incident->incident_date }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Incident Time</label>

                            <input type="time" name="incident_time" class="form-control"
                                value="{{ $incident->incident_time }}" required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Oil Spill Type</label>

                            <select name="spill_type" class="form-select">

                                @foreach (['Crude Oil', 'Diesel', 'Fuel Oil', 'Lubricating Oil', 'Chemical', 'Unknown'] as $type)
                                    <option value="{{ $type }}"
                                        {{ $incident->spill_type == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Spill Source</label>

                            <select name="spill_source" class="form-select">

                                @foreach (['Ship', 'Pipeline', 'Terminal', 'Port', 'Unknown'] as $source)
                                    <option value="{{ $source }}"
                                        {{ $incident->spill_source == $source ? 'selected' : '' }}>
                                        {{ $source }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Estimated Volume</label>

                            <input type="number" step="0.01" name="estimated_volume"
                                value="{{ $incident->estimated_volume }}" class="form-control">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Volume Unit</label>

                            <select name="volume_unit" class="form-select">

                                @foreach (['Liters', 'Gallons', 'Barrels'] as $unit)
                                    <option value="{{ $unit }}"
                                        {{ $incident->volume_unit == $unit ? 'selected' : '' }}>
                                        {{ $unit }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Severity</label>

                            <select name="severity_level" class="form-select">

                                @foreach (['Low', 'Moderate', 'High', 'Critical'] as $severity)
                                    <option value="{{ $severity }}"
                                        {{ $incident->severity_level == $severity ? 'selected' : '' }}>
                                        {{ $severity }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Status</label>

                            <select name="response_status" class="form-select">

                                @foreach (['Ongoing', 'Contained', 'Cleaned Up', 'Closed'] as $status)
                                    <option value="{{ $status }}"
                                        {{ $incident->response_status == $status ? 'selected' : '' }}>
                                        {{ $status }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Affected Area</label>

                        <input type="text" id="affected_area" name="affected_area" class="form-control"
                            value="{{ $incident->affected_area }}">

                    </div>

                    <div class="mb-3">

                        <label>Location</label>

                        <div id="map"></div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Latitude</label>

                            <input type="text" id="latitude" name="latitude" value="{{ $incident->latitude }}"
                                class="form-control" readonly>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Longitude</label>

                            <input type="text" id="longitude" name="longitude" value="{{ $incident->longitude }}"
                                class="form-control" readonly>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Contact Point</label>

                            <select name="contact_point_id" class="form-select">

                                <option value="">Select Contact Point</option>

                                @foreach ($contactPoints as $contact)
                                    <option value="{{ $contact->id }}"
                                        {{ $incident->contact_point_id == $contact->id ? 'selected' : '' }}>

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
                                    <option value="{{ $site->id }}"
                                        {{ $incident->dump_site_id == $site->id ? 'selected' : '' }}>

                                        {{ $site->site_name }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Description</label>

                        <textarea name="description" rows="4" class="form-control">{{ $incident->description }}</textarea>

                    </div>

                    <button class="btn btn-primary">
                        <i class="fas fa-save"></i> Update
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

            let lat = parseFloat(document.getElementById('latitude').value) || 12.8797;
            let lng = parseFloat(document.getElementById('longitude').value) || 121.7740;

            let map = L.map('map').setView([lat, lng], 10);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap'
            }).addTo(map);

            let marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

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
