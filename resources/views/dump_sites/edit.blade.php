@extends('layouts.app')

@section('title', 'Edit Dump Site')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">

    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css">

    <style>
        #map {
            height: 500px;
            width: 100%;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid">

        <div class="card shadow-sm">

            <div class="card-header bg-warning">

                <h4 class="mb-0">

                    <i class="fas fa-edit"></i>

                    Edit Dump Site

                </h4>

            </div>

            <div class="card-body">

                <form action="{{ route('dump_sites.update', $dumpSite->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Site Name
                            </label>

                            <input type="text" name="site_name" value="{{ old('site_name', $dumpSite->site_name) }}"
                                class="form-control" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Location
                            </label>

                            <input type="text" name="location" value="{{ old('location', $dumpSite->location) }}"
                                class="form-control" required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Latitude
                            </label>

                            <input id="latitude" type="text" name="latitude"
                                value="{{ old('latitude', $dumpSite->latitude) }}" class="form-control" readonly>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Longitude
                            </label>

                            <input id="longitude" type="text" name="longitude"
                                value="{{ old('longitude', $dumpSite->longitude) }}" class="form-control" readonly>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Edit Dump Site Location

                        </label>

                        <div id="map"></div>

                        <small class="text-muted">

                            Search for a location, click the map, or drag the marker.

                        </small>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Description
                        </label>

                        <textarea name="description" rows="4" class="form-control">{{ old('description', $dumpSite->description) }}</textarea>

                    </div>

                    <button class="btn btn-success">

                        <i class="fas fa-save"></i>

                        Update

                    </button>

                    <a href="{{ route('dump_sites.index') }}" class="btn btn-secondary">

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

            const defaultLat = {{ $dumpSite->latitude ?: 12.8797 }};
            const defaultLng = {{ $dumpSite->longitude ?: 121.774 }};

            const map = L.map('map').setView([defaultLat, defaultLng], 14);

            L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; OpenStreetMap contributors',
                    maxZoom: 19
                }
            ).addTo(map);

            const marker = L.marker(
                [defaultLat, defaultLng], {
                    draggable: true
                }
            ).addTo(map);

            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');

            function updateCoordinates(lat, lng) {
                latInput.value = lat.toFixed(7);
                lngInput.value = lng.toFixed(7);
            }

            marker.on('dragend', function() {

                const position = marker.getLatLng();

                updateCoordinates(position.lat, position.lng);

            });

            map.on('click', function(e) {

                marker.setLatLng(e.latlng);

                updateCoordinates(
                    e.latlng.lat,
                    e.latlng.lng
                );

            });

            L.Control.geocoder({

                    defaultMarkGeocode: false

                })
                .on('markgeocode', function(e) {

                    const center = e.geocode.center;

                    map.setView(center, 15);

                    marker.setLatLng(center);

                    updateCoordinates(
                        center.lat,
                        center.lng
                    );

                })
                .addTo(map);

            setTimeout(function() {

                map.invalidateSize();

            }, 300);

        });
    </script>
@endpush
