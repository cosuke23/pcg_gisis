@extends('layouts.app')

@section('title', 'Add Water Quality Monitoring Report')
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
                Add Water Quality Monitoring Report
            </h2>

            <a href="{{ route('water-quality-monitorings.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Back
            </a>

        </div>

        @if ($errors->any())

            <div class="alert alert-danger">

                <strong>Please correct the following errors:</strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('water-quality-monitorings.store') }}" method="POST">

            @csrf

            <!-- ====================================================== -->
            <!-- REPORT INFORMATION -->
            <!-- ====================================================== -->

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

                            <label class="form-label">

                                Report Number

                            </label>

                            <input type="text" name="report_number" class="form-control"
                                value="{{ old('report_number') }}" placeholder="WQM-2026-0001" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Monitoring Date

                            </label>

                            <input type="date" name="monitoring_date" class="form-control"
                                value="{{ old('monitoring_date') }}" required>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ====================================================== -->
            <!-- MONITORING LOCATION -->
            <!-- ====================================================== -->

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

                            <label class="form-label">

                                Monitoring Station

                            </label>

                            <input type="text" name="monitoring_station" class="form-control"
                                value="{{ old('monitoring_station') }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Body of Water

                            </label>

                            <input type="text" name="body_of_water" class="form-control"
                                value="{{ old('body_of_water') }}" placeholder="Manila Bay" required>

                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="form-label">

                                Region

                            </label>

                            <input type="text" name="region" class="form-control" value="{{ old('region') }}" required>

                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="form-label">

                                Province

                            </label>

                            <input type="text" name="province" class="form-control" value="{{ old('province') }}"
                                required>

                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="form-label">

                                City / Municipality

                            </label>

                            <input type="text" name="city_municipality" class="form-control"
                                value="{{ old('city_municipality') }}" required>

                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="form-label">

                                Barangay

                            </label>

                            <input type="text" name="barangay" class="form-control" value="{{ old('barangay') }}">

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Monitoring Location

                            </label>

                            <div id="map" style="height:400px; border:1px solid #ced4da; border-radius:8px;">
                            </div>

                            <small class="text-muted">

                                Click anywhere on the map to set the monitoring location.

                            </small>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Latitude

                            </label>

                            <input type="text" id="latitude" name="latitude" class="form-control" readonly
                                value="{{ old('latitude') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Longitude

                            </label>

                            <input type="text" id="longitude" name="longitude" class="form-control" readonly
                                value="{{ old('longitude') }}">

                        </div>

                    </div>

                </div>

            </div>
            <!-- ====================================================== -->
            <!-- WATER QUALITY PARAMETERS -->
            <!-- ====================================================== -->

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

                            <label class="form-label">

                                Temperature (°C)

                            </label>

                            <input type="number" step="0.01" name="temperature" class="form-control"
                                value="{{ old('temperature') }}" placeholder="29.50">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                pH Level

                            </label>

                            <input type="number" step="0.01" name="ph_level" class="form-control"
                                value="{{ old('ph_level') }}" placeholder="8.20">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Dissolved Oxygen (mg/L)

                            </label>

                            <input type="number" step="0.01" name="dissolved_oxygen" class="form-control"
                                value="{{ old('dissolved_oxygen') }}" placeholder="6.80">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Salinity (ppt)

                            </label>

                            <input type="number" step="0.01" name="salinity" class="form-control"
                                value="{{ old('salinity') }}" placeholder="32.50">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Turbidity (NTU)

                            </label>

                            <input type="number" step="0.01" name="turbidity" class="form-control"
                                value="{{ old('turbidity') }}" placeholder="5.40">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Conductivity (mS/cm)

                            </label>

                            <input type="number" step="0.01" name="conductivity" class="form-control"
                                value="{{ old('conductivity') }}" placeholder="48.20">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Ammonia (mg/L)

                            </label>

                            <input type="number" step="0.01" name="ammonia" class="form-control"
                                value="{{ old('ammonia') }}" placeholder="0.10">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Nitrate (mg/L)

                            </label>

                            <input type="number" step="0.01" name="nitrate" class="form-control"
                                value="{{ old('nitrate') }}" placeholder="0.25">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Phosphate (mg/L)

                            </label>

                            <input type="number" step="0.01" name="phosphate" class="form-control"
                                value="{{ old('phosphate') }}" placeholder="0.05">

                        </div>

                    </div>

                </div>

            </div>

            <!-- ====================================================== -->
            <!-- ASSESSMENT -->
            <!-- ====================================================== -->

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

                            <label class="form-label">

                                Water Quality Status

                            </label>

                            <select name="water_quality_status" class="form-select" required>

                                <option value="">-- Select Status --</option>

                                <option value="Good" {{ old('water_quality_status') == 'Good' ? 'selected' : '' }}>
                                    Good
                                </option>

                                <option value="Fair" {{ old('water_quality_status') == 'Fair' ? 'selected' : '' }}>
                                    Fair
                                </option>

                                <option value="Poor" {{ old('water_quality_status') == 'Poor' ? 'selected' : '' }}>
                                    Poor
                                </option>

                                <option value="Critical"
                                    {{ old('water_quality_status') == 'Critical' ? 'selected' : '' }}>
                                    Critical
                                </option>

                            </select>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Pollution Source

                            </label>

                            <select name="pollution_source" class="form-select">

                                <option value="">-- Select Pollution Source --</option>

                                <option value="Domestic Wastewater">Domestic Wastewater</option>
                                <option value="Industrial Discharge">Industrial Discharge</option>
                                <option value="Oil Spill">Oil Spill</option>
                                <option value="Agricultural Runoff">Agricultural Runoff</option>
                                <option value="Solid Waste">Solid Waste</option>
                                <option value="Port Operations">Port Operations</option>
                                <option value="Fish Cage Operations">Fish Cage Operations</option>
                                <option value="Unknown">Unknown</option>
                                <option value="Others">Others</option>

                            </select>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Observed Condition

                            </label>

                            <textarea name="observed_condition" rows="4" class="form-control">{{ old('observed_condition') }}</textarea>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Recommendations

                            </label>

                            <textarea name="recommendations" rows="4" class="form-control">{{ old('recommendations') }}</textarea>

                        </div>

                        <div class="col-md-12">

                            <label class="form-label">

                                Remarks

                            </label>

                            <textarea name="remarks" rows="4" class="form-control">{{ old('remarks') }}</textarea>

                        </div>

                    </div>

                </div>

            </div>
            <!-- ====================================================== -->
            <!-- INSPECTOR INFORMATION -->
            <!-- ====================================================== -->

            <div class="card shadow-sm mb-3">

                <div class="card-header bg-secondary text-white">

                    <strong>

                        <i class="fas fa-user-tie"></i>

                        Inspector Information

                    </strong>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <label class="form-label">

                                Inspector Name

                            </label>

                            <input type="text" name="inspector_name" class="form-control"
                                value="{{ old('inspector_name') }}" placeholder="e.g. Julius B. Colminas" required>

                        </div>

                    </div>

                </div>

            </div>

            <!-- ====================================================== -->
            <!-- ACTION BUTTONS -->
            <!-- ====================================================== -->

            <div class="text-end">

                <button type="submit" class="btn btn-success">

                    <i class="fas fa-save"></i>

                    Save Report

                </button>

                <a href="{{ route('water-quality-monitorings.index') }}" class="btn btn-secondary">

                    <i class="fas fa-times"></i>

                    Cancel

                </a>

            </div>

        </form>

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
                attribution: '© OpenStreetMap'
            }).addTo(map);

            let marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

            update(lat, lng);

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

                    document.getElementById('affected_area').value = e.geocode.name;

                })
                .addTo(map);

            setTimeout(function() {

                map.invalidateSize();

            }, 300);

        });
    </script>
@endpush
