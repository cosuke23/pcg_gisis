@extends('layouts.app')

@section('title', 'View Coral Assessment')

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
            margin-bottom: 20px;
            font-size: 15px;
        }
    </style>
@endpush

@section('content')

    <div class="container-fluid">

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                <h3>

                    <i class="fas fa-leaf"></i>

                    Coral Assessment & Rehabilitation Details

                </h3>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6">

                        <div class="detail-label">

                            Assessment Number

                        </div>

                        <div class="detail-value">

                            <strong>{{ $assessment->assessment_number }}</strong>

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="detail-label">

                            Assessment Date

                        </div>

                        <div class="detail-value">

                            {{ \Carbon\Carbon::parse($assessment->assessment_date)->format('F d, Y') }}

                        </div>

                    </div>

                </div>

                <hr>

                <div class="row">

                    <div class="col-md-6">

                        <div class="detail-label">

                            Site Name

                        </div>

                        <div class="detail-value">

                            {{ $assessment->site_name }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="detail-label">

                            Reef Type

                        </div>

                        <div class="detail-value">

                            <span class="badge bg-primary">

                                {{ $assessment->reef_type }}

                            </span>

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="detail-label">

                            Assessment Method

                        </div>

                        <div class="detail-value">

                            {{ $assessment->assessment_method }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="detail-label">

                            Team Leader

                        </div>

                        <div class="detail-value">

                            {{ $assessment->team_leader }}

                        </div>

                    </div>

                </div>

                <hr>

                <h5>

                    Coral Cover Assessment

                </h5>

                <div class="row">

                    <div class="col-md-3">

                        <div class="detail-label">

                            Live Coral

                        </div>

                        <div class="detail-value">

                            <span class="badge bg-success">

                                {{ number_format($assessment->live_coral_cover, 2) }} %

                            </span>

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="detail-label">

                            Dead Coral

                        </div>

                        <div class="detail-value">

                            {{ number_format($assessment->dead_coral_cover, 2) }} %

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="detail-label">

                            Algae Cover

                        </div>

                        <div class="detail-value">

                            {{ number_format($assessment->algae_cover, 2) }} %

                        </div>

                    </div>

                    <div class="col-md-3">

                        <div class="detail-label">

                            Sand Cover

                        </div>

                        <div class="detail-value">

                            {{ number_format($assessment->sand_cover, 2) }} %

                        </div>

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="detail-label">

                            Reef Condition

                        </div>

                        <div class="detail-value">

                            @switch($assessment->reef_condition)
                                @case('Excellent')
                                    <span class="badge bg-success">Excellent</span>
                                @break

                                @case('Good')
                                    <span class="badge bg-info">Good</span>
                                @break

                                @case('Fair')
                                    <span class="badge bg-warning">Fair</span>
                                @break

                                @case('Poor')
                                    <span class="badge bg-danger">Poor</span>
                                @break

                                @default
                                    <span class="badge bg-dark">Critical</span>
                            @endswitch

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="detail-label">

                            Implementing Agency

                        </div>

                        <div class="detail-value">

                            {{ $assessment->implementing_agency ?: 'N/A' }}

                        </div>

                    </div>

                </div>

                <hr>

                <h5>

                    Rehabilitation Information

                </h5>

                <div class="row">

                    <div class="col-md-4">

                        <div class="detail-label">

                            Required

                        </div>

                        <div class="detail-value">

                            @if ($assessment->rehabilitation_required)
                                <span class="badge bg-warning">

                                    YES

                                </span>
                            @else
                                <span class="badge bg-success">

                                    NO

                                </span>
                            @endif

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="detail-label">

                            Start Date

                        </div>

                        <div class="detail-value">

                            {{ $assessment->rehabilitation_start ?: 'N/A' }}

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="detail-label">

                            End Date

                        </div>

                        <div class="detail-value">

                            {{ $assessment->rehabilitation_end ?: 'N/A' }}

                        </div>

                    </div>

                </div>

                <div class="mb-3">

                    <div class="detail-label">

                        Rehabilitation Method

                    </div>

                    <div class="detail-value">

                        {{ $assessment->rehabilitation_method ?: 'N/A' }}

                    </div>

                </div>

                <hr>

                <h5>

                    Assessment Location

                </h5>

                <div class="row">

                    <div class="col-md-4">

                        <div class="detail-label">

                            Region

                        </div>

                        <div class="detail-value">

                            {{ $assessment->region }}

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="detail-label">

                            Province

                        </div>

                        <div class="detail-value">

                            {{ $assessment->province }}

                        </div>

                    </div>

                    <div class="col-md-4">

                        <div class="detail-label">

                            Municipality

                        </div>

                        <div class="detail-value">

                            {{ $assessment->municipality }}

                        </div>

                    </div>

                </div>

                <div class="mb-3">

                    <div class="detail-label">

                        Location Name

                    </div>

                    <div class="detail-value">

                        {{ $assessment->location_name }}

                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">

                        <div class="detail-label">

                            Latitude

                        </div>

                        <div class="detail-value">

                            {{ $assessment->latitude }}

                        </div>

                    </div>

                    <div class="col-md-6">

                        <div class="detail-label">

                            Longitude

                        </div>

                        <div class="detail-value">

                            {{ $assessment->longitude }}

                        </div>

                    </div>

                </div>

                <hr>

                <div class="mb-4">

                    <div class="detail-label">

                        Remarks

                    </div>

                    <div class="detail-value">

                        {!! nl2br(e($assessment->remarks)) !!}

                    </div>

                </div>

                <h5>

                    <i class="fas fa-map-marker-alt text-danger"></i>

                    Assessment Map

                </h5>

                <div id="map"></div>

                <br>

                <a href="{{ route('coral-assessments.index') }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </a>

                <a href="{{ route('coral-assessments.edit', $assessment->id) }}" class="btn btn-warning">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let lat = {{ $assessment->latitude }};

            let lng = {{ $assessment->longitude }};

            let map = L.map('map').setView([lat, lng], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

                attribution: '© OpenStreetMap contributors'

            }).addTo(map);

            @if (!empty($assessment->geojson))

                try {

                    let geo = {!! $assessment->geojson !!};

                    let layer = L.geoJSON(geo).addTo(map);

                    map.fitBounds(layer.getBounds(), {

                        padding: [20, 20]

                    });

                } catch (e) {

                    console.log(e);

                    L.marker([lat, lng]).addTo(map);

                }
            @else

                L.marker([lat, lng])

                    .addTo(map)

                    .bindPopup(
                        "<strong>{{ addslashes($assessment->site_name) }}</strong><br>{{ addslashes($assessment->location_name) }}"
                    )

                    .openPopup();
            @endif

        });
    </script>
@endpush
