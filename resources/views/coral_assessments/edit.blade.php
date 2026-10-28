@extends('layouts.app')

@section('title', 'Edit Coral Assessment')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css">

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

        <div class="card shadow">

            <div class="card-header bg-warning text-dark">

                <h3>

                    <i class="fas fa-edit"></i>

                    Edit Coral Assessment & Rehabilitation

                </h3>

            </div>

            <div class="card-body">

                <form action="{{ route('coral-assessments.update', $assessment->id) }}" method="POST">

                    @csrf

                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Assessment Number</label>

                            <input type="text" name="assessment_number" class="form-control"
                                value="{{ old('assessment_number', $assessment->assessment_number) }}" readonly>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Assessment Date</label>

                            <input type="date" name="assessment_date" class="form-control"
                                value="{{ old('assessment_date', $assessment->assessment_date) }}" required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Site Name</label>

                            <input type="text" name="site_name" class="form-control"
                                value="{{ old('site_name', $assessment->site_name) }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Reef Type</label>

                            <select name="reef_type" class="form-select" required>

                                <option value="">Select</option>

                                <option value="Fringing Reef"
                                    {{ old('reef_type', $assessment->reef_type) == 'Fringing Reef' ? 'selected' : '' }}>
                                    Fringing Reef
                                </option>

                                <option value="Barrier Reef"
                                    {{ old('reef_type', $assessment->reef_type) == 'Barrier Reef' ? 'selected' : '' }}>
                                    Barrier Reef
                                </option>

                                <option value="Patch Reef"
                                    {{ old('reef_type', $assessment->reef_type) == 'Patch Reef' ? 'selected' : '' }}>
                                    Patch Reef
                                </option>

                                <option value="Atoll"
                                    {{ old('reef_type', $assessment->reef_type) == 'Atoll' ? 'selected' : '' }}>
                                    Atoll
                                </option>

                                <option value="Artificial Reef"
                                    {{ old('reef_type', $assessment->reef_type) == 'Artificial Reef' ? 'selected' : '' }}>
                                    Artificial Reef
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Assessment Method</label>

                            <select name="assessment_method" class="form-select" required>

                                <option value="">Select</option>

                                <option value="LIT"
                                    {{ old('assessment_method', $assessment->assessment_method) == 'LIT' ? 'selected' : '' }}>
                                    LIT
                                </option>

                                <option value="Photo Transect"
                                    {{ old('assessment_method', $assessment->assessment_method) == 'Photo Transect' ? 'selected' : '' }}>
                                    Photo Transect
                                </option>

                                <option value="Quadrat"
                                    {{ old('assessment_method', $assessment->assessment_method) == 'Quadrat' ? 'selected' : '' }}>
                                    Quadrat
                                </option>

                                <option value="Manta Tow"
                                    {{ old('assessment_method', $assessment->assessment_method) == 'Manta Tow' ? 'selected' : '' }}>
                                    Manta Tow
                                </option>

                                <option value="Visual Survey"
                                    {{ old('assessment_method', $assessment->assessment_method) == 'Visual Survey' ? 'selected' : '' }}>
                                    Visual Survey
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Team Leader</label>

                            <input type="text" name="team_leader" class="form-control"
                                value="{{ old('team_leader', $assessment->team_leader) }}" required>

                        </div>

                    </div>

                    <hr>

                    <h5>

                        Coral Cover Assessment

                    </h5>

                    <div class="row">

                        <div class="col-md-3 mb-3">

                            <label>Live Coral (%)</label>

                            <input type="number" step="0.01" name="live_coral_cover" class="form-control"
                                value="{{ old('live_coral_cover', $assessment->live_coral_cover) }}">

                        </div>

                        <div class="col-md-3 mb-3">

                            <label>Dead Coral (%)</label>

                            <input type="number" step="0.01" name="dead_coral_cover" class="form-control"
                                value="{{ old('dead_coral_cover', $assessment->dead_coral_cover) }}">

                        </div>

                        <div class="col-md-3 mb-3">

                            <label>Algae (%)</label>

                            <input type="number" step="0.01" name="algae_cover" class="form-control"
                                value="{{ old('algae_cover', $assessment->algae_cover) }}">

                        </div>

                        <div class="col-md-3 mb-3">

                            <label>Sand (%)</label>

                            <input type="number" step="0.01" name="sand_cover" class="form-control"
                                value="{{ old('sand_cover', $assessment->sand_cover) }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Reef Condition</label>

                            <select name="reef_condition" class="form-select" required>

                                <option value="Excellent"
                                    {{ old('reef_condition', $assessment->reef_condition) == 'Excellent' ? 'selected' : '' }}>
                                    Excellent
                                </option>

                                <option value="Good"
                                    {{ old('reef_condition', $assessment->reef_condition) == 'Good' ? 'selected' : '' }}>
                                    Good
                                </option>

                                <option value="Fair"
                                    {{ old('reef_condition', $assessment->reef_condition) == 'Fair' ? 'selected' : '' }}>
                                    Fair
                                </option>

                                <option value="Poor"
                                    {{ old('reef_condition', $assessment->reef_condition) == 'Poor' ? 'selected' : '' }}>
                                    Poor
                                </option>

                                <option value="Critical"
                                    {{ old('reef_condition', $assessment->reef_condition) == 'Critical' ? 'selected' : '' }}>
                                    Critical
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Implementing Agency</label>

                            <input type="text" name="implementing_agency" class="form-control"
                                value="{{ old('implementing_agency', $assessment->implementing_agency) }}">

                        </div>

                    </div>
                    <hr>

                    <div class="form-check mb-3">

                        <input type="checkbox" class="form-check-input" id="rehabCheck" name="rehabilitation_required"
                            value="1"
                            {{ old('rehabilitation_required', $assessment->rehabilitation_required) ? 'checked' : '' }}>

                        <label class="form-check-label" for="rehabCheck">

                            Requires Rehabilitation

                        </label>

                    </div>

                    <div id="rehabFields"
                        style="{{ old('rehabilitation_required', $assessment->rehabilitation_required) ? '' : 'display:none;' }}">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label>Rehabilitation Start</label>

                                <input type="date" name="rehabilitation_start" class="form-control"
                                    value="{{ old('rehabilitation_start', $assessment->rehabilitation_start) }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>Rehabilitation End</label>

                                <input type="date" name="rehabilitation_end" class="form-control"
                                    value="{{ old('rehabilitation_end', $assessment->rehabilitation_end) }}">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>Rehabilitation Method</label>

                                <input type="text" name="rehabilitation_method" class="form-control"
                                    value="{{ old('rehabilitation_method', $assessment->rehabilitation_method) }}">

                            </div>

                        </div>

                    </div>

                    <hr>

                    <h5>

                        Assessment Location

                    </h5>

                    <div class="mb-3">

                        <label>Location Name</label>

                        <input type="text" id="location_name" name="location_name" class="form-control"
                            value="{{ old('location_name', $assessment->location_name) }}" required>

                    </div>

                    <div class="mb-3">

                        <div id="map"></div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>Region</label>

                            <input type="text" name="region" class="form-control"
                                value="{{ old('region', $assessment->region) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>Province</label>

                            <input type="text" name="province" class="form-control"
                                value="{{ old('province', $assessment->province) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>Municipality / City</label>

                            <input type="text" name="municipality" class="form-control"
                                value="{{ old('municipality', $assessment->municipality) }}">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Latitude</label>

                            <input type="text" id="latitude" name="latitude" class="form-control"
                                value="{{ old('latitude', $assessment->latitude) }}" readonly required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Longitude</label>

                            <input type="text" id="longitude" name="longitude" class="form-control"
                                value="{{ old('longitude', $assessment->longitude) }}" readonly required>

                        </div>

                    </div>

                    <input type="hidden" id="geojson" name="geojson"
                        value="{{ old('geojson', $assessment->geojson) }}">

                    <div class="mb-3">

                        <label>Remarks</label>

                        <textarea name="remarks" rows="4" class="form-control">{{ old('remarks', $assessment->remarks) }}</textarea>

                    </div>

                    <div class="mb-3">

                        <label>Status</label>

                        <select name="status" class="form-select">

                            <option value="1" {{ old('status', $assessment->status) == 1 ? 'selected' : '' }}>

                                Active

                            </option>

                            <option value="0" {{ old('status', $assessment->status) == 0 ? 'selected' : '' }}>

                                Inactive

                            </option>

                        </select>

                    </div>

                    <button class="btn btn-warning">

                        <i class="fas fa-save"></i>

                        Update Assessment

                    </button>

                    <a href="{{ route('coral-assessments.index') }}" class="btn btn-secondary">

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

    <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ===========================
            // Rehabilitation Toggle
            // ===========================

            const rehabCheck = document.getElementById('rehabCheck');

            const rehabFields = document.getElementById('rehabFields');

            function toggleRehab() {

                rehabFields.style.display = rehabCheck.checked ? 'block' : 'none';

            }

            toggleRehab();

            rehabCheck.addEventListener('change', toggleRehab);

            // ===========================
            // Existing Coordinates
            // ===========================

            let lat = parseFloat("{{ $assessment->latitude }}");

            let lng = parseFloat("{{ $assessment->longitude }}");

            let map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

                attribution: '© OpenStreetMap'

            }).addTo(map);

            // ===========================
            // Marker
            // ===========================

            let marker = L.marker([lat, lng], {

                draggable: true

            }).addTo(map);

            function updateLocation(lat, lng) {

                marker.setLatLng([lat, lng]);

                document.getElementById('latitude').value = lat.toFixed(7);

                document.getElementById('longitude').value = lng.toFixed(7);

            }

            marker.on('dragend', function() {

                let p = marker.getLatLng();

                updateLocation(p.lat, p.lng);

            });

            map.on('click', function(e) {

                updateLocation(e.latlng.lat, e.latlng.lng);

            });

            // ===========================
            // Search Location
            // ===========================

            L.Control.geocoder({

                    defaultMarkGeocode: false

                })

                .on('markgeocode', function(e) {

                    let center = e.geocode.center;

                    map.setView(center, 15);

                    updateLocation(center.lat, center.lng);

                    document.getElementById('location_name').value = e.geocode.name;

                })

                .addTo(map);

            // ===========================
            // Leaflet Draw
            // ===========================

            let drawnItems = new L.FeatureGroup();

            map.addLayer(drawnItems);

            let drawControl = new L.Control.Draw({

                draw: {

                    polygon: true,

                    polyline: true,

                    rectangle: true,

                    marker: true,

                    circle: false,

                    circlemarker: false

                },

                edit: {

                    featureGroup: drawnItems

                }

            });

            map.addControl(drawControl);

            // ===========================
            // Load Existing GeoJSON
            // ===========================

            let existingGeo = @json($assessment->geojson);

            if (existingGeo) {

                try {

                    let geo = JSON.parse(existingGeo);

                    let layer = L.geoJSON(geo);

                    layer.eachLayer(function(l) {

                        drawnItems.addLayer(l);

                    });

                    map.fitBounds(layer.getBounds());

                } catch (err) {

                    console.log(err);

                }

            }

            // ===========================
            // Save New Geometry
            // ===========================

            map.on(L.Draw.Event.CREATED, function(e) {

                drawnItems.clearLayers();

                drawnItems.addLayer(e.layer);

                document.getElementById('geojson').value =

                    JSON.stringify(e.layer.toGeoJSON());

            });

            // ===========================
            // Update Geometry
            // ===========================

            map.on(L.Draw.Event.EDITED, function() {

                let geo = drawnItems.toGeoJSON();

                document.getElementById('geojson').value =

                    JSON.stringify(geo);

            });

            // ===========================
            // Delete Geometry
            // ===========================

            map.on(L.Draw.Event.DELETED, function() {

                document.getElementById('geojson').value = '';

            });

            setTimeout(function() {

                map.invalidateSize();

            }, 300);

        });
    </script>
@endpush
