@extends('layouts.app')

@section('title', 'Add Thematic Mapping')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.css">
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

                    <i class="fas fa-map-marked-alt"></i>

                    Add Thematic Mapping

                </h3>

            </div>

            <div class="card-body">

                <form action="{{ route('thematic-mappings.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Map Title</label>

                            <input type="text" name="map_title" class="form-control" value="{{ old('map_title') }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Category</label>

                            <select name="category" class="form-select" required>

                                <option value="">Select Category</option>

                                <option>Marine Protected Area</option>

                                <option>Coral Reef</option>

                                <option>Mangrove</option>

                                <option>Seagrass</option>

                                <option>Shoreline</option>

                                <option>Marine Park</option>

                                <option>Fish Sanctuary</option>

                                <option>Water Quality Station</option>

                                <option>Pollution Source</option>

                                <option>Oil Spill Area</option>

                                <option>Dump Site</option>

                                <option>Others</option>

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Geometry Type</label>

                            <select name="geometry_type" class="form-select">

                                <option>Point</option>

                                <option>Line</option>

                                <option>Polygon</option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Status</label>

                            <select name="status" class="form-select">

                                <option value="1">Active</option>

                                <option value="0">Inactive</option>

                            </select>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Location Name</label>

                        <input type="text" id="location_name" name="location_name" class="form-control"
                            value="{{ old('location_name') }}" required>

                    </div>

                    <div class="mb-3">

                        <label>Select Location</label>

                        <div id="map"></div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Latitude</label>

                            <input type="text" id="latitude" name="latitude" class="form-control" readonly required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Longitude</label>

                            <input type="text" id="longitude" name="longitude" class="form-control" readonly required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>Region</label>

                            <input type="text" name="region" class="form-control" value="{{ old('region') }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>Province</label>

                            <input type="text" name="province" class="form-control" value="{{ old('province') }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>Municipality / City</label>

                            <input type="text" name="municipality" class="form-control"
                                value="{{ old('municipality') }}">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Description</label>

                        <textarea name="description" rows="4" class="form-control">{{ old('description') }}</textarea>

                    </div>

                    <button class="btn btn-success">

                        <i class="fas fa-save"></i>

                        Save Mapping

                    </button>

                    <a href="{{ route('thematic-mappings.index') }}" class="btn btn-secondary">

                        Cancel

                    </a>

                </form>

            </div>

        </div>

    </div>

@endsection
@push('scripts')
    <script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // Default to Philippines

            let lat = 12.8797;

            let lng = 121.7740;

            // Initialize map

            let map = L.map('map').setView([lat, lng], 6);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

                attribution: '&copy; OpenStreetMap contributors'

            }).addTo(map);

            // Draggable marker

            let marker = L.marker([lat, lng], {

                draggable: true

            }).addTo(map);

            // Update coordinates

            function updateLocation(lat, lng) {

                marker.setLatLng([lat, lng]);

                document.getElementById('latitude').value = lat.toFixed(7);

                document.getElementById('longitude').value = lng.toFixed(7);

            }

            updateLocation(lat, lng);

            // Click map

            map.on('click', function(e) {

                updateLocation(e.latlng.lat, e.latlng.lng);

            });

            // Drag marker

            marker.on('dragend', function() {

                let p = marker.getLatLng();

                updateLocation(p.lat, p.lng);

            });

            // Search control

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

            // Resize fix

            setTimeout(function() {

                map.invalidateSize();

            }, 300);

        });
    </script>
@endpush
