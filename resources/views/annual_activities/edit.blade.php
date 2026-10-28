@extends('layouts.app')

@section('title', 'Edit Annual Activity')

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

                    <i class="fas fa-edit"></i>

                    Edit Annual Activity

                </h3>

            </div>

            <div class="card-body">

                <form action="{{ route('annual_activities.update', $annualActivity->id) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Activity Title</label>

                            <input type="text" name="activity_title" value="{{ $annualActivity->activity_title }}"
                                class="form-control" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Activity Date</label>

                            <input type="date" name="activity_date" value="{{ $annualActivity->activity_date }}"
                                class="form-control" required>

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Activity Type</label>

                            <select name="activity_type" class="form-select">

                                <option {{ $annualActivity->activity_type == 'Coastal Cleanup' ? 'selected' : '' }}>Coastal
                                    Cleanup</option>
                                <option {{ $annualActivity->activity_type == 'Oil Spill Response' ? 'selected' : '' }}>Oil Spill
                                    Response</option>
                                <option {{ $annualActivity->activity_type == 'Oil Spill Exercise' ? 'selected' : '' }}>Oil Spill
                                    Exercise</option>
                                <option {{ $annualActivity->activity_type == 'Inspection' ? 'selected' : '' }}>Inspection</option>
                                <option {{ $annualActivity->activity_type == 'Marine Patrol' ? 'selected' : '' }}>Marine Patrol
                                </option>
                                <option {{ $annualActivity->activity_type == 'Training' ? 'selected' : '' }}>Training</option>
                                <option {{ $annualActivity->activity_type == 'Seminar' ? 'selected' : '' }}>Seminar</option>
                                <option {{ $annualActivity->activity_type == 'Information Campaign' ? 'selected' : '' }}>
                                    Information Campaign</option>
                                <option {{ $annualActivity->activity_type == 'Others' ? 'selected' : '' }}>Others</option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Conducted By</label>

                            <input type="text" name="conducted_by" value="{{ $annualActivity->conducted_by }}"
                                class="form-control">

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Location</label>

                        <input type="text" id="location" name="location" value="{{ $annualActivity->location }}"
                            class="form-control">

                    </div>

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label>Latitude</label>

                            <input type="text" id="latitude" name="latitude" value="{{ $annualActivity->latitude }}"
                                class="form-control" readonly>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label>Longitude</label>

                            <input type="text" id="longitude" name="longitude" value="{{ $annualActivity->longitude }}"
                                class="form-control" readonly>

                        </div>

                    </div>

                    <div class="mb-3">

                        <label>Select Location</label>

                        <div id="map"></div>

                    </div>

                    <div class="mb-3">

                        <label>Participants</label>

                        <input type="number" name="participants" value="{{ $annualActivity->participants }}"
                            class="form-control">

                    </div>

                    <div class="mb-3">

                        <label>Description</label>

                        <textarea name="description" rows="4" class="form-control">{{ $annualActivity->description }}</textarea>

                    </div>

                    <button class="btn btn-primary">

                        <i class="fas fa-save"></i>

                        Update Activity

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

            let lat = {{ $annualActivity->latitude ?? 12.8797 }};
            let lng = {{ $annualActivity->longitude ?? 121.774 }};

            let map = L.map('map').setView([lat, lng], 13);

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

                    document.getElementById('location').value = e.geocode.name;

                })
                .addTo(map);

            setTimeout(function() {

                map.invalidateSize();

            }, 300);

        });
    </script>
@endpush
