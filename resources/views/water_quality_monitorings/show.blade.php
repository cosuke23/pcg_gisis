@extends('layouts.app')

@section('title', 'Water Quality Monitoring Details')
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

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-water text-primary"></i>

                Water Quality Monitoring Details

            </h2>

            <div>

                <a href="{{ route('water-quality-monitorings.edit', $waterQualityMonitoring->id) }}" class="btn btn-warning">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

                <a href="{{ route('water-quality-monitorings.index') }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </a>

            </div>

        </div>

        <!-- ===================================================== -->
        <!-- REPORT INFORMATION -->
        <!-- ===================================================== -->

        <div class="card shadow-sm mb-3">

            <div class="card-header bg-primary text-white">

                <strong>

                    <i class="fas fa-file-alt"></i>

                    Report Information

                </strong>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">

                            Report Number

                        </label>

                        <p>{{ $waterQualityMonitoring->report_number }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">

                            Monitoring Date

                        </label>

                        <p>

                            {{ \Carbon\Carbon::parse($waterQualityMonitoring->monitoring_date)->format('F d, Y') }}

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- ===================================================== -->
        <!-- MONITORING LOCATION -->
        <!-- ===================================================== -->

        <div class="card shadow-sm mb-3">

            <div class="card-header bg-info text-white">

                <strong>

                    <i class="fas fa-map-marker-alt"></i>

                    Monitoring Location

                </strong>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">

                            Monitoring Station

                        </label>

                        <p>{{ $waterQualityMonitoring->monitoring_station }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">

                            Body of Water

                        </label>

                        <p>{{ $waterQualityMonitoring->body_of_water }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">

                            Region

                        </label>

                        <p>{{ $waterQualityMonitoring->region }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">

                            Province

                        </label>

                        <p>{{ $waterQualityMonitoring->province }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">

                            City / Municipality

                        </label>

                        <p>{{ $waterQualityMonitoring->city_municipality }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">

                            Barangay

                        </label>

                        <p>{{ $waterQualityMonitoring->barangay ?: '-' }}</p>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="fw-bold">

                            Latitude

                        </label>

                        <p>{{ $waterQualityMonitoring->latitude }}</p>

                    </div>

                    <div class="col-md-3 mb-3">

                        <label class="fw-bold">

                            Longitude

                        </label>

                        <p>{{ $waterQualityMonitoring->longitude }}</p>

                    </div>

                    <div class="col-md-12">

                        <label class="fw-bold mb-2">

                            Monitoring Location Map

                        </label>

                        <div id="waterQualityMap" style="height:450px;border:1px solid #ced4da;border-radius:8px;">

                        </div>

                    </div>

                </div>

            </div>

        </div>
        <!-- ===================================================== -->
        <!-- WATER QUALITY PARAMETERS -->
        <!-- ===================================================== -->

        <div class="card shadow-sm mb-3">

            <div class="card-header bg-success text-white">

                <strong>

                    <i class="fas fa-flask"></i>

                    Water Quality Parameters

                </strong>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Temperature</label>
                        <p>{{ $waterQualityMonitoring->temperature ?? '-' }} °C</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">pH Level</label>
                        <p>{{ $waterQualityMonitoring->ph_level ?? '-' }}</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Dissolved Oxygen</label>
                        <p>{{ $waterQualityMonitoring->dissolved_oxygen ?? '-' }} mg/L</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Salinity</label>
                        <p>{{ $waterQualityMonitoring->salinity ?? '-' }} ppt</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Turbidity</label>
                        <p>{{ $waterQualityMonitoring->turbidity ?? '-' }} NTU</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Conductivity</label>
                        <p>{{ $waterQualityMonitoring->conductivity ?? '-' }} mS/cm</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Ammonia</label>
                        <p>{{ $waterQualityMonitoring->ammonia ?? '-' }} mg/L</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Nitrate</label>
                        <p>{{ $waterQualityMonitoring->nitrate ?? '-' }} mg/L</p>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="fw-bold">Phosphate</label>
                        <p>{{ $waterQualityMonitoring->phosphate ?? '-' }} mg/L</p>
                    </div>

                </div>

            </div>

        </div>

        <!-- ===================================================== -->
        <!-- ASSESSMENT -->
        <!-- ===================================================== -->

        <div class="card shadow-sm mb-3">

            <div class="card-header bg-warning">

                <strong>

                    <i class="fas fa-clipboard-check"></i>

                    Assessment

                </strong>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">Water Quality Status</label>

                        <p>

                            @switch($waterQualityMonitoring->water_quality_status)
                                @case('Good')
                                    <span class="badge bg-success">Good</span>
                                @break

                                @case('Fair')
                                    <span class="badge bg-info">Fair</span>
                                @break

                                @case('Poor')
                                    <span class="badge bg-warning text-dark">Poor</span>
                                @break

                                @default
                                    <span class="badge bg-danger">Critical</span>
                            @endswitch

                        </p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">Pollution Source</label>

                        <p>{{ $waterQualityMonitoring->pollution_source ?: '-' }}</p>

                    </div>

                    <div class="col-md-12 mb-3">

                        <label class="fw-bold">Observed Condition</label>

                        <div class="border rounded p-3 bg-light">

                            {{ $waterQualityMonitoring->observed_condition ?: 'No observations recorded.' }}

                        </div>

                    </div>

                    <div class="col-md-12 mb-3">

                        <label class="fw-bold">Recommendations</label>

                        <div class="border rounded p-3 bg-light">

                            {{ $waterQualityMonitoring->recommendations ?: 'No recommendations provided.' }}

                        </div>

                    </div>

                    <div class="col-md-12">

                        <label class="fw-bold">Remarks</label>

                        <div class="border rounded p-3 bg-light">

                            {{ $waterQualityMonitoring->remarks ?: 'No remarks available.' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

        <!-- ===================================================== -->
        <!-- INSPECTOR INFORMATION -->
        <!-- ===================================================== -->

        <div class="card shadow-sm">

            <div class="card-header bg-secondary text-white">

                <strong>

                    <i class="fas fa-user-tie"></i>

                    Inspector Information

                </strong>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6">

                        <label class="fw-bold">Inspector Name</label>

                        <p>{{ $waterQualityMonitoring->inspector_name }}</p>

                    </div>

                    <div class="col-md-6">

                        <label class="fw-bold">Date Created</label>

                        <p>
                            {{ $waterQualityMonitoring->created_at->timezone('Asia/Singapore')->format('F d, Y h:i A') }}
                            SGT
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection


@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            let latitude = {{ $waterQualityMonitoring->latitude ?? 12.8797 }};
            let longitude = {{ $waterQualityMonitoring->longitude ?? 121.774 }};

            let map = L.map('waterQualityMap').setView([latitude, longitude], 14);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {

                attribution: '&copy; OpenStreetMap contributors'

            }).addTo(map);

            let blueIcon = L.icon({

                iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-blue.png',

                shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/images/marker-shadow.png',

                iconSize: [25, 41],

                iconAnchor: [12, 41],

                popupAnchor: [1, -34],

                shadowSize: [41, 41]

            });

            L.marker([latitude, longitude], {

                    icon: blueIcon

                })
                .addTo(map)
                .bindPopup(`
        <strong>{{ $waterQualityMonitoring->monitoring_station }}</strong><br>
        {{ $waterQualityMonitoring->body_of_water }}<br>
        <strong>Status:</strong> {{ $waterQualityMonitoring->water_quality_status }}
    `)
                .openPopup();

        });
    </script>
@endpush
