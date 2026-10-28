@extends('layouts.app')

@section('title', 'Edit Thematic Mapping')

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

            <div class="card-header bg-warning">

                <h3>

                    <i class="fas fa-edit"></i>

                    Edit Thematic Mapping

                </h3>

            </div>

            <div class="card-body">

                <form action="{{ route('thematic-mappings.update', $thematicMapping->id) }}" method="POST">

                    @csrf

                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Map Title</label>

                            <input type="text" name="map_title" class="form-control"
                                value="{{ old('map_title', $thematicMapping->map_title) }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Category</label>

                            <select name="category" class="form-select" required>

                                <option value="">Select Category</option>

                                @foreach (['Marine Protected Area', 'Coral Reef', 'Mangrove', 'Seagrass', 'Shoreline', 'Marine Park', 'Fish Sanctuary', 'Water Quality Station', 'Pollution Source', 'Oil Spill Area', 'Dump Site', 'Others'] as $category)
                                    <option value="{{ $category }}"
                                        {{ old('category', $thematicMapping->category) == $category ? 'selected' : '' }}>
                                        {{ $category }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Geometry Type</label>

                            <select name="geometry_type" class="form-select">

                                @foreach (['Point', 'Line', 'Polygon'] as $type)
                                    <option value="{{ $type }}"
                                        {{ old('geometry_type', $thematicMapping->geometry_type) == $type ? 'selected' : '' }}>
                                        {{ $type }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Status</label>

                            <select name="status" class="form-select">

                                <option value="1" {{ old('status', $thematicMapping->status) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ old('status', $thematicMapping->status) == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Location Name</label>

                        <input type="text" id="location_name" name="location_name" class="form-control"
                            value="{{ old('location_name', $thematicMapping->location_name) }}" required>

                    </div>

                    <div class="mb-3">

                        <label>Select Location</label>

                        <div id="map"></div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Latitude</label>

                            <input type="text" id="latitude" name="latitude" class="form-control"
                                value="{{ old('latitude', $thematicMapping->latitude) }}" readonly required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Longitude</label>

                            <input type="text" id="longitude" name="longitude" class="form-control"
                                value="{{ old('longitude', $thematicMapping->longitude) }}" readonly required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label>Region</label>

                            <input type="text" name="region" class="form-control"
                                value="{{ old('region', $thematicMapping->region) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>Province</label>

                            <input type="text" name="province" class="form-control"
                                value="{{ old('province', $thematicMapping->province) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label>Municipality / City</label>

                            <input type="text" name="municipality" class="form-control"
                                value="{{ old('municipality', $thematicMapping->municipality) }}">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Description</label>

                        <textarea name="description" rows="4" class="form-control">{{ old('description', $thematicMapping->description) }}</textarea>

                    </div>

                    <button class="btn btn-warning">

                        <i class="fas fa-save"></i>

                        Update Mapping

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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let lat = {{ $thematicMapping->latitude }};
            let lng = {{ $thematicMapping->longitude }};

            let map = L.map('map').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

                attribution: '&copy; OpenStreetMap contributors'

            }).addTo(map);

            let marker = L.marker([lat, lng], {

                draggable: true

            }).addTo(map);

            function updateLocation(lat, lng) {

                marker.setLatLng([lat, lng]);

                document.getElementById('latitude').value = lat.toFixed(7);

                document.getElementById('longitude').value = lng.toFixed(7);

            }

            map.on('click', function(e) {

                updateLocation(e.latlng.lat, e.latlng.lng);

            });

            marker.on('dragend', function() {

                let p = marker.getLatLng();

                updateLocation(p.lat, p.lng);

            });

            L.Control.geocoder({

                defaultMarkGeocode: false

            }).on('markgeocode', function(e) {

                let center = e.geocode.center;

                map.setView(center, 15);

                updateLocation(center.lat, center.lng);

                document.getElementById('location_name').value = e.geocode.name;

            }).addTo(map);

            updateLocation(lat, lng);

            setTimeout(function() {

                map.invalidateSize();

            }, 300);

        });
    </script>
@endpush
@extends('layouts.app')

@section('title', 'View Thematic Mapping')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <style>
        #map {
            height: 500px;
            border-radius: 8px;
            border: 1px solid #dee2e6;
        }

        .detail-label {
            font-weight: bold;
            color: #6c757d;
        }

        .detail-value {
            font-size: 16px;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header bg-info text-white">

                <h3>

                    <i class="fas fa-map-marked-alt"></i>

                    Thematic Mapping Details

                </h3>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <div class="detail-label">

                            Map Title

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->map_title }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <div class="detail-label">

                            Category

                        </div>

                        <div class="detail-value">

                            <span class="badge bg-primary">

                                {{ $thematicMapping->category }}

                            </span>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <div class="detail-label">

                            Geometry Type

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->geometry_type }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <div class="detail-label">

                            Status

                        </div>

                        <div class="detail-value">

                            @if ($thematicMapping->status)
                                <span class="badge bg-success">

                                    Active

                                </span>
                            @else
                                <span class="badge bg-danger">

                                    Inactive

                                </span>
                            @endif

                        </div>

                    </div>

                </div>

                <div class="mb-3">

                    <div class="detail-label">

                        Location

                    </div>

                    <div class="detail-value">

                        {{ $thematicMapping->location_name }}

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <div class="detail-label">

                            Region

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->region }}

                        </div>

                    </div>

                    <div class="col-md-4 mb-3">

                        <div class="detail-label">

                            Province

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->province }}

                        </div>

                    </div>

                    <div class="col-md-4 mb-3">

                        <div class="detail-label">

                            Municipality

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->municipality }}

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <div class="detail-label">

                            Latitude

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->latitude }}

                        </div>

                    </div>

                    <div class="col-md-6 mb-3">

                        <div class="detail-label">

                            Longitude

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->longitude }}

                        </div>

                    </div>

                </div>

                <div class="mb-3">

                    <div class="detail-label">

                        Description

                    </div>

                    <div class="detail-value">

                        {!! nl2br(e($thematicMapping->description)) !!}

                    </div>

                </div>

                <hr>

                <h5>

                    <i class="fas fa-map-marker-alt text-danger"></i>

                    Mapped Location

                </h5>

                <div id="map"></div>

                <br>

                <a href="{{ route('thematic-mappings.index') }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </a>

                <a href="{{ route('thematic-mappings.edit', $thematicMapping->id) }}" class="btn btn-warning">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
<script src="https://unpkg.com/leaflet-draw@1.0.4/dist/leaflet.draw.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let lat = {{ $thematicMapping->latitude }};

            let lng = {{ $thematicMapping->longitude }};

            let map = L.map('map').setView([lat, lng], 15);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

                attribution: '© OpenStreetMap'

            }).addTo(map);

            L.marker([lat, lng])

                .addTo(map)

                .bindPopup(
                    "<strong>{{ addslashes($thematicMapping->map_title) }}</strong><br>{{ addslashes($thematicMapping->location_name) }}"
                )
                .openPopup();

        });
    </script>
@endpush
