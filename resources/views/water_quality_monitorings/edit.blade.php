@extends('layouts.app')

@section('title', 'Edit Water Quality Monitoring Report')

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

        <form action="{{ route('water-quality-monitorings.update', $waterQualityMonitoring->id) }}" method="POST">

            @csrf
            @method('PUT')

            <div class="d-flex justify-content-between mb-3">

                <h2>

                    <i class="fas fa-edit text-warning"></i>

                    Edit Water Quality Monitoring Report

                </h2>

                <a href="{{ route('water-quality-monitorings.index') }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </a>

            </div>

            @if ($errors->any())

                <div class="alert alert-danger">

                    <strong>Please correct the following errors.</strong>

                    <ul class="mb-0 mt-2">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            @endif


            <!-- Report Information -->

            <div class="card shadow-sm mb-4">

                <div class="card-header bg-primary text-white">

                    <strong>

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
                                value="{{ old('report_number', $waterQualityMonitoring->report_number) }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Monitoring Date

                            </label>

                            <input type="date" name="monitoring_date" class="form-control"
                                value="{{ old('monitoring_date', $waterQualityMonitoring->monitoring_date) }}" required>

                        </div>

                    </div>

                </div>

            </div>



            <!-- Monitoring Location -->

            <div class="card shadow-sm mb-4">

                <div class="card-header bg-success text-white">

                    <strong>

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
                                value="{{ old('monitoring_station', $waterQualityMonitoring->monitoring_station) }}"
                                required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Body of Water

                            </label>

                            <input type="text" name="body_of_water" class="form-control"
                                value="{{ old('body_of_water', $waterQualityMonitoring->body_of_water) }}"
                                placeholder="Manila Bay" required>

                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="form-label">

                                Region

                            </label>

                            <input type="text" name="region" class="form-control"
                                value="{{ old('region', $waterQualityMonitoring->region) }}" required>

                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="form-label">

                                Province

                            </label>

                            <input type="text" name="province" class="form-control"
                                value="{{ old('province', $waterQualityMonitoring->province) }}" required>

                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="form-label">

                                City / Municipality

                            </label>

                            <input type="text" name="city_municipality" class="form-control"
                                value="{{ old('city_municipality', $waterQualityMonitoring->city_municipality) }}" required>

                        </div>

                        <div class="col-md-3 mb-3">

                            <label class="form-label">

                                Barangay

                            </label>

                            <input type="text" name="barangay" class="form-control"
                                value="{{ old('barangay', $waterQualityMonitoring->barangay) }}">

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
                                value="{{ old('latitude', $waterQualityMonitoring->latitude) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">

                                Longitude

                            </label>

                            <input type="text" id="longitude" name="longitude" class="form-control" readonly
                                value="{{ old('longitude', $waterQualityMonitoring->longitude) }}">

                        </div>

                    </div>

                </div>

            </div>
            <!-- Water Quality Parameters -->


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
                                value="{{ old('temperature', $waterQualityMonitoring->temperature) }}"
                                placeholder="29.50">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                pH Level

                            </label>

                            <input type="number" step="0.01" name="ph_level" class="form-control"
                                value="{{ old('ph_level', $waterQualityMonitoring->ph_level) }}" placeholder="8.20">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Dissolved Oxygen (mg/L)

                            </label>

                            <input type="number" step="0.01" name="dissolved_oxygen" class="form-control"
                                value="{{ old('dissolved_oxygen', $waterQualityMonitoring->dissolved_oxygen) }}"
                                placeholder="6.80">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Salinity (ppt)

                            </label>

                            <input type="number" step="0.01" name="salinity" class="form-control"
                                value="{{ old('salinity', $waterQualityMonitoring->salinity) }}" placeholder="32.50">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Turbidity (NTU)

                            </label>

                            <input type="number" step="0.01" name="turbidity" class="form-control"
                                value="{{ old('turbidity', $waterQualityMonitoring->turbidity) }}" placeholder="5.40">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Conductivity (mS/cm)

                            </label>

                            <input type="number" step="0.01" name="conductivity" class="form-control"
                                value="{{ old('conductivity', $waterQualityMonitoring->conductivity) }}"
                                placeholder="48.20">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Ammonia (mg/L)

                            </label>

                            <input type="number" step="0.01" name="ammonia" class="form-control"
                                value="{{ old('ammonia', $waterQualityMonitoring->ammonia) }}" placeholder="0.10">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Nitrate (mg/L)

                            </label>

                            <input type="number" step="0.01" name="nitrate" class="form-control"
                                value="{{ old('nitrate', $waterQualityMonitoring->nitrate) }}" placeholder="0.25">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">

                                Phosphate (mg/L)

                            </label>

                            <input type="number" step="0.01" name="phosphate" class="form-control"
                                value="{{ old('phosphate', $waterQualityMonitoring->phosphate) }}" placeholder="0.05">

                        </div>

                    </div>

                </div>

            </div>




            <!-- Environmental Assessment -->


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

                                <option value="Good"
                                    {{ old('water_quality_status', $waterQualityMonitoring->water_quality_status) == 'Good' ? 'selected' : '' }}>
                                    Good
                                </option>

                                <option value="Fair" {{ old('water_quality_status', $waterQualityMonitoring->water_quality_status) == 'Fair' ? 'selected' : '' }}>
                                    Fair
                                </option>

                                <option value="Poor"
                                    {{ old('water_quality_status', $waterQualityMonitoring->water_quality_status) == 'Poor' ? 'selected' : '' }}>
                                    Poor
                                </option>

                                <option value="Critical"
                                    {{ old('water_quality_status', $waterQualityMonitoring->water_quality_status) == 'Critical' ? 'selected' : '' }}>
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

                                <option value="Domestic Wastewater"
                                    {{ old('pollution_source', $waterQualityMonitoring->pollution_source ?? '') == 'Domestic Wastewater' ? 'selected' : '' }}>
                                    Domestic Wastewater
                                </option>

                                <option value="Industrial Discharge"
                                    {{ old('pollution_source', $waterQualityMonitoring->pollution_source ?? '') == 'Industrial Discharge' ? 'selected' : '' }}>
                                    Industrial Discharge
                                </option>

                                <option value="Oil Spill"
                                    {{ old('pollution_source', $waterQualityMonitoring->pollution_source ?? '') == 'Oil Spill' ? 'selected' : '' }}>
                                    Oil Spill
                                </option>

                                <option value="Agricultural Runoff"
                                    {{ old('pollution_source', $waterQualityMonitoring->pollution_source ?? '') == 'Agricultural Runoff' ? 'selected' : '' }}>
                                    Agricultural Runoff
                                </option>

                                <option value="Solid Waste"
                                    {{ old('pollution_source', $waterQualityMonitoring->pollution_source ?? '') == 'Solid Waste' ? 'selected' : '' }}>
                                    Solid Waste
                                </option>

                                <option value="Port Operations"
                                    {{ old('pollution_source', $waterQualityMonitoring->pollution_source ?? '') == 'Port Operations' ? 'selected' : '' }}>
                                    Port Operations
                                </option>

                                <option value="Fish Cage Operations"
                                    {{ old('pollution_source', $waterQualityMonitoring->pollution_source ?? '') == 'Fish Cage Operations' ? 'selected' : '' }}>
                                    Fish Cage Operations
                                </option>

                                <option value="Unknown"
                                    {{ old('pollution_source', $waterQualityMonitoring->pollution_source ?? '') == 'Unknown' ? 'selected' : '' }}>
                                    Unknown
                                </option>

                                <option value="Others"
                                    {{ old('pollution_source', $waterQualityMonitoring->pollution_source ?? '') == 'Others' ? 'selected' : '' }}>
                                    Others
                                </option>

                            </select>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Observed Condition

                            </label>

                            <textarea name="observed_condition" rows="4" class="form-control">{{ old('observed_condition', $waterQualityMonitoring->observed_condition) }}</textarea>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">

                                Recommendations

                            </label>

                            <textarea name="recommendations" rows="4" class="form-control">{{ old('recommendations', $waterQualityMonitoring->recommendations) }}</textarea>

                        </div>

                        <div class="col-md-12">

                            <label class="form-label">

                                Remarks

                            </label>

                            <textarea name="remarks" rows="4" class="form-control">{{ old('remarks', $waterQualityMonitoring->remarks) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            <div class="card shadow-sm mb-4">

                <div class="card-header bg-dark text-white">

                    Inspector Information

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6">

                            <label>Inspector Name</label>

                            <input type="text" name="inspector_name" class="form-control"
                                value="{{ old('inspector_name', $waterQualityMonitoring->inspector_name) }}">

                        </div>

                    </div>

                </div>

            </div>



            <div class="text-end mb-5">

                <button class="btn btn-success">

                    <i class="fas fa-save"></i>

                    Update Report

                </button>

                <a href="{{ route('water-quality-monitorings.index') }}" class="btn btn-secondary">

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
