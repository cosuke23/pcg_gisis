@extends('layouts.app')

@section('title', 'Add Annual Activity')

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

        <div class="card">

            <div class="card-header">

                <h3>

                    <i class="fas fa-calendar-plus"></i>

                    Add Annual Activity

                </h3>

            </div>

            <div class="card-body">

                <form action="{{ route('annual_activities.store') }}" method="POST">

                    @csrf

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Activity Title

                            </label>

                            <input type="text" name="activity_title" class="form-control" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Activity Date

                            </label>

                            <input type="date" name="activity_date" class="form-control" required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Activity Type

                            </label>

                            <select name="activity_type" class="form-select" required>

                                <option value="">Select Activity</option>

                                <option>Coastal Cleanup</option>

                                <option>Oil Spill Response</option>

                                <option>Oil Spill Exercise</option>

                                <option>Inspection</option>

                                <option>Marine Patrol</option>

                                <option>Training</option>

                                <option>Seminar</option>

                                <option>Information Campaign</option>

                                <option>Others</option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Conducted By

                            </label>

                            <input type="text" name="conducted_by" class="form-control">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">

                            Location

                        </label>

                        <input type="text" id="location" name="location" class="form-control" required>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>

                                Latitude

                            </label>

                            <input type="text" id="latitude" name="latitude" class="form-control" readonly>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>

                                Longitude

                            </label>

                            <input type="text" id="longitude" name="longitude" class="form-control" readonly>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>

                            Search or Click the Map

                        </label>

                        <div id="map"></div>

                    </div>

                    <div class="mb-3">

                        <label>

                            Participants

                        </label>

                        <input type="number" name="participants" value="0" class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>

                            Description

                        </label>

                        <textarea name="description" rows="4" class="form-control"></textarea>

                    </div>

                    <button class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Save Activity

                    </button>

                    <a href="{{ route('annual_activities.index') }}" class="btn btn-secondary">

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
                maxZoom: 19,
                attribution: '© OpenStreetMap'
            }).addTo(map);

            let marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            function update(lat, lng) {

                marker.setLatLng([lat, lng]);

                document.getElementById('latitude').value = lat.toFixed(7);

                document.getElementById('longitude').value = lng.toFixed(7);

            }

            map.on('click', function(e) {

                update(e.latlng.lat, e.latlng.lng);

            });

            marker.on('dragend', function() {

                let p = marker.getLatLng();

                update(p.lat, p.lng);

            });

            L.Control.geocoder({

                    defaultMarkGeocode: false

                })

                .on('markgeocode', function(e) {

                    let c = e.geocode.center;

                    map.setView(c, 15);

                    update(c.lat, c.lng);

                    document.getElementById('location').value = e.geocode.name;

                })

                .addTo(map);

            setTimeout(function() {

                map.invalidateSize();

            }, 300);

        });
    </script>
@endpush
