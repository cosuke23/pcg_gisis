@extends('layouts.app')

@section('title', 'Add Coral Assessment')

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

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                <h3>

                    <i class="fas fa-leaf"></i>

                    Coral Assessment & Rehabilitation

                </h3>

            </div>

            <div class="card-body">

                <form action="{{ route('coral-assessments.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Assessment Number</label>

                            <input type="text" name="assessment_number" class="form-control"
                                value="CAR-{{ date('Y') }}-{{ str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT) }}" readonly>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Assessment Date</label>

                            <input type="date" name="assessment_date" class="form-control" value="{{ date('Y-m-d') }}"
                                required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Site Name</label>

                            <input type="text" name="site_name" class="form-control" required>

                        </div>
                        <div class="col-md-6 mb-3">

                            <label>Reef Type</label>

                            <select name="reef_type" class="form-select" required>

                                <option value="">Select Reef Type</option>

                                <option value="Fringing Reef">
                                    Fringing Reef – Coral reef directly attached to the shoreline or bordering an island.
                                </option>

                                <option value="Barrier Reef">
                                    Barrier Reef – Large reef separated from the coast by a lagoon or deep channel.
                                </option>

                                <option value="Patch Reef">
                                    Patch Reef – Small, isolated reef commonly found within lagoons or between larger reefs.
                                </option>

                                <option value="Atoll">
                                    Atoll – Ring-shaped coral reef surrounding a central lagoon, usually formed around a
                                    submerged volcanic island.
                                </option>

                                <option value="Artificial Reef">
                                    Artificial Reef – Human-made underwater structure designed to promote coral growth and
                                    marine biodiversity.
                                </option>

                            </select>

                            <small class="text-muted">
                                Select the type of coral reef being assessed or rehabilitated.
                            </small>

                        </div>

                    </div>

                    <div class="row">

                        <div class="mb-3">
                            <label>Assessment Method</label>

                            <select name="assessment_method" class="form-select" required>

                                <option value="">Select Assessment Method</option>

                                <option value="LIT">
                                    LIT (Line Intercept Transect) – Measures coral cover along a fixed transect line.
                                </option>

                                <option value="Photo Transect">
                                    Photo Transect – Uses underwater photographs to assess reef condition and coral
                                    coverage.
                                </option>

                                <option value="Quadrat">
                                    Quadrat – Examines a fixed square sampling area to estimate coral composition and
                                    abundance.
                                </option>

                                <option value="Manta Tow">
                                    Manta Tow – Rapid reef survey conducted by towing an observer behind a boat.
                                </option>

                                <option value="Visual Survey">
                                    Visual Survey – Direct underwater observation to evaluate reef health and marine life.
                                </option>

                            </select>

                            <small class="text-muted">
                                Select the survey method used during the coral reef assessment.
                            </small>
                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Team Leader</label>

                            <input type="text" name="team_leader" class="form-control" required>

                        </div>

                    </div>

                    <hr>

                    <h5>

                        Coral Cover Assessment

                    </h5>

                    <div class="row">

                        <div class="col-md-3 mb-3">

                            <label>Live Coral (%)</label>

                            <input type="number" step="0.01" name="live_coral_cover" class="form-control">

                        </div>

                        <div class="col-md-3 mb-3">

                            <label>Dead Coral (%)</label>

                            <input type="number" step="0.01" name="dead_coral_cover" class="form-control">

                        </div>

                        <div class="col-md-3 mb-3">

                            <label>Algae (%)</label>

                            <input type="number" step="0.01" name="algae_cover" class="form-control">

                        </div>

                        <div class="col-md-3 mb-3">

                            <label>Sand (%)</label>

                            <input type="number" step="0.01" name="sand_cover" class="form-control">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Reef Condition</label>

                            <select name="reef_condition" class="form-select" required>

                                <option value="">Select</option>

                                <option>Excellent</option>

                                <option>Good</option>

                                <option>Fair</option>

                                <option>Poor</option>

                                <option>Critical</option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Implementing Agency</label>

                            <input type="text" name="implementing_agency" class="form-control">

                        </div>

                    </div>

                    <hr>

                    <div class="form-check mb-3">

                        <input type="checkbox" class="form-check-input" id="rehabCheck" name="rehabilitation_required"
                            value="1">

                        <label class="form-check-label">

                            Requires Rehabilitation

                        </label>

                    </div>

                    <div id="rehabFields" style="display:none;">

                        <div class="row">

                            <div class="col-md-4 mb-3">

                                <label>Start Date</label>

                                <input type="date" name="rehabilitation_start" class="form-control">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>End Date</label>

                                <input type="date" name="rehabilitation_end" class="form-control">

                            </div>

                            <div class="col-md-4 mb-3">

                                <label>Method</label>

                                <input type="text" name="rehabilitation_method" class="form-control">

                            </div>

                        </div>

                    </div>

                    <hr>

                    <h5>

                        Assessment Location

                    </h5>

                    <div class="mb-3">

                        <label>Location Name</label>

                        <input type="text" id="location_name" name="location_name" class="form-control">

                    </div>

                    <div class="mb-3">

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

                    <input type="hidden" name="geojson" id="geojson">

                    <div class="mb-3">

                        <label>Remarks</label>

                        <textarea name="remarks" rows="4" class="form-control"></textarea>

                    </div>

                    <div class="mb-3">

                        <label>Status</label>

                        <select name="status" class="form-select">

                            <option value="1">Active</option>

                            <option value="0">Inactive</option>

                        </select>

                    </div>

                    <button class="btn btn-success">

                        <i class="fas fa-save"></i>

                        Save Assessment

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

            // ==========================
            // Rehabilitation Toggle
            // ==========================

            const rehabCheck = document.getElementById('rehabCheck');

            const rehabFields = document.getElementById('rehabFields');

            rehabCheck.addEventListener('change', function() {

                rehabFields.style.display = this.checked ? 'block' : 'none';

            });

            // ==========================
            // Default Philippines View
            // ==========================

            let lat = 12.8797;

            let lng = 121.7740;

            let map = L.map('map').setView([lat, lng], 6);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

                attribution: '© OpenStreetMap'

            }).addTo(map);

            // ==========================
            // Marker
            // ==========================

            let marker = L.marker([lat, lng], {

                draggable: true

            }).addTo(map);

            function updateLocation(lat, lng) {

                marker.setLatLng([lat, lng]);

                document.getElementById('latitude').value = lat.toFixed(7);

                document.getElementById('longitude').value = lng.toFixed(7);

            }

            updateLocation(lat, lng);

            marker.on('dragend', function() {

                let p = marker.getLatLng();

                updateLocation(p.lat, p.lng);

            });

            map.on('click', function(e) {

                updateLocation(e.latlng.lat, e.latlng.lng);

            });

            // ==========================
            // Geocoder
            // ==========================

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

            // ==========================
            // Leaflet Draw
            // ==========================

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

            map.on(L.Draw.Event.CREATED, function(e) {

                drawnItems.clearLayers();

                let layer = e.layer;

                drawnItems.addLayer(layer);

                document.getElementById('geojson').value =

                    JSON.stringify(layer.toGeoJSON());

            });

            map.on(L.Draw.Event.EDITED, function() {

                let geo = drawnItems.toGeoJSON();

                document.getElementById('geojson').value =

                    JSON.stringify(geo);

            });

            map.on(L.Draw.Event.DELETED, function() {

                document.getElementById('geojson').value = '';

            });

            setTimeout(function() {

                map.invalidateSize();

            }, 300);

        });
    </script>
@endpush
