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
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 15px;
            margin-bottom: 20px;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                <h3 class="mb-0">

                    <i class="fas fa-map-marked-alt"></i>

                    View Thematic Mapping

                </h3>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6">

                        <div class="detail-label">

                            Map Title

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->map_title }}

                        </div>

                    </div>

                    <div class="col-md-6">

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

                    <div class="col-md-6">

                        <div class="detail-label">

                            Geometry Type

                        </div>

                        <div class="detail-value">

                            <span class="badge bg-info">

                                {{ $thematicMapping->geometry_type }}

                            </span>

                        </div>

                    </div>

                    <div class="col-md-6">

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

                <div class="row">

                    <div class="col-md-12">

                        <div class="detail-label">

                            Location Name

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->location_name }}

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-4">

                        <div class="detail-label">

                            Region

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->region ?? 'N/A' }}

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="detail-label">

                            Province

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->province ?? 'N/A' }}

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="detail-label">

                            Municipality / City

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->municipality ?? 'N/A' }}

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="detail-label">

                            Latitude

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->latitude }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="detail-label">

                            Longitude

                        </div>

                        <div class="detail-value">

                            {{ $thematicMapping->longitude }}

                        </div>

                    </div>

                </div>

                <div class="mb-4">

                    <div class="detail-label">

                        Description

                    </div>

                    <div class="detail-value">

                        {!! nl2br(e($thematicMapping->description)) !!}

                    </div>

                </div>

                <hr>

                <h5 class="mb-3">

                    <i class="fas fa-map-marker-alt text-danger"></i>

                    Mapped Location

                </h5>

                <div id="map"></div>

                <div class="mt-4">

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

    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let lat = {{ $thematicMapping->latitude }};
            let lng = {{ $thematicMapping->longitude }};

            let map = L.map('map').setView([lat, lng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

                attribution: '&copy; OpenStreetMap contributors'

            }).addTo(map);

            // If GeoJSON exists, display it

            @if (!empty($thematicMapping->geojson))

                let geojson = {!! $thematicMapping->geojson !!};

                let layer = L.geoJSON(geojson).addTo(map);

                map.fitBounds(layer.getBounds(), {
                    padding: [20, 20]
                });
            @else

                // Otherwise display marker

                L.marker([lat, lng])

                    .addTo(map)

                    .bindPopup(
                        "<strong>{{ addslashes($thematicMapping->map_title) }}</strong><br>{{ addslashes($thematicMapping->location_name) }}"
                    )

                    .openPopup();
            @endif

        });
    </script>
@endpush
