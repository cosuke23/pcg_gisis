@extends('layouts.app')

@section('title', 'GIS Dashboard')

@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <style>
        #gisMap {
            height: 750px;
            width: 100%;
            border-radius: 10px;
        }

        .dashboard-card {
            border-left: 5px solid #0d6efd;
            box-shadow: 0 3px 8px rgba(0, 0, 0, .1);
        }

        .legend {
            background: #fff;
            padding: 10px;
            border-radius: 8px;
            line-height: 28px;
        }

        .legend span {
            display: inline-block;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            margin-right: 8px;
        }
    </style>
@endpush


@section('content')

    <div class="container-fluid">

        <div class="row mb-3">

            <div class="col-md-3">

                <div class="card dashboard-card">

                    <div class="card-body text-center">

                        <h6>Total Incidents</h6>

                        <h2>{{ $incidents->count() }}</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card dashboard-card">

                    <div class="card-body text-center">

                        <h6>Critical</h6>

                        <h2>{{ $incidents->where('severity_level', 'Critical')->count() }}</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card dashboard-card">

                    <div class="card-body text-center">

                        <h6>Ongoing</h6>

                        <h2>{{ $incidents->where('response_status', 'Ongoing')->count() }}</h2>

                    </div>

                </div>

            </div>

            <div class="col-md-3">

                <div class="card dashboard-card">

                    <div class="card-body text-center">

                        <h6>Closed</h6>

                        <h2>{{ $incidents->where('response_status', 'Closed')->count() }}</h2>

                    </div>

                </div>

            </div>

        </div>


        <div class="card">

            <div class="card-header bg-primary text-white">

                <h4 class="mb-0">

                    <i class="fas fa-earth-asia"></i>

                    Oil Spill GIS Dashboard

                </h4>

            </div>

            <div class="card-body">

                <div id="gisMap"></div>

            </div>

        </div>

    </div>

@endsection


@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {

            const incidents = @json($incidents);

            // ============================
            // Base Maps
            // ============================

            var osm = L.tileLayer(
                'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '© OpenStreetMap'
                }
            );

            var satellite = L.tileLayer(
                'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                    attribution: 'Esri Satellite'
                }
            );

            var topo = L.tileLayer(
                'https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                    maxZoom: 17,
                    attribution: 'OpenTopoMap'
                }
            );

            // ============================
            // Initialize Map
            // ============================

            var map = L.map('gisMap', {

                center: [12.8797, 121.7740],

                zoom: 6,

                layers: [osm]

            });

            // ============================
            // Layer Switcher
            // ============================

            var baseMaps = {

                "OpenStreetMap": osm,

                "Satellite": satellite,

                "Topographic": topo

            };

            L.control.layers(baseMaps).addTo(map);

            // ============================
            // Marker Color
            // ============================

            function getColor(level) {

                switch (level) {

                    case "Critical":
                        return "#dc3545";

                    case "High":
                        return "#fd7e14";

                    case "Moderate":
                        return "#ffc107";

                    case "Low":
                        return "#198754";

                    default:
                        return "#0d6efd";

                }

            }

            // ============================
            // Plot Incidents
            // ============================

            var bounds = [];

            incidents.forEach(function(item) {

                if (
                    item.latitude == null ||
                    item.longitude == null ||
                    item.latitude == "" ||
                    item.longitude == ""
                ) {
                    return;
                }

                var lat = parseFloat(item.latitude);
                var lng = parseFloat(item.longitude);

                if (isNaN(lat) || isNaN(lng)) {
                    return;
                }

                bounds.push([lat, lng]);

                var marker = L.circleMarker([lat, lng], {

                    radius: 10,

                    color: getColor(item.severity_level),

                    fillColor: getColor(item.severity_level),

                    fillOpacity: 1,

                    weight: 3

                }).addTo(map);
                marker.on('add', function() {

                    const el = marker.getElement();

                    if (el) {

                        el.classList.add('blink-marker');

                    }

                });

                marker.bindPopup(
                    `
            <div style="min-width:240px">

                <h5>${item.incident_number}</h5>

                <hr>

                <b>Date:</b> ${item.incident_date}<br>

                <b>Time:</b> ${item.incident_time}<br>

                <b>Type:</b> ${item.spill_type}<br>

                <b>Severity:</b>
                <span style="color:${getColor(item.severity_level)};font-weight:bold;">
                    ${item.severity_level}
                </span><br>

                <b>Status:</b> ${item.response_status}<br>

                <b>Volume:</b> ${item.estimated_volume ?? ''} ${item.volume_unit ?? ''}<br>

                <b>Affected Area:</b><br>

                ${item.affected_area}

            </div>
            `
                );

            });

            // ============================
            // Zoom to Markers
            // ============================

            if (bounds.length > 0) {

                map.fitBounds(bounds);

            }

            // ============================
            // Legend
            // ============================

            var legend = L.control({
                position: 'bottomright'
            });

            legend.onAdd = function() {

                var div = L.DomUtil.create('div', 'legend');

                div.style.background = 'white';
                div.style.padding = '10px';
                div.style.borderRadius = '8px';
                div.style.boxShadow = '0 0 8px rgba(0,0,0,.3)';

                div.innerHTML = `
        <b>Severity</b><br><br>

        <span style="display:inline-block;width:15px;height:15px;background:#198754;border-radius:50%;"></span>
        Low<br>

        <span style="display:inline-block;width:15px;height:15px;background:#ffc107;border-radius:50%;"></span>
        Moderate<br>

        <span style="display:inline-block;width:15px;height:15px;background:#fd7e14;border-radius:50%;"></span>
        High<br>

        <span style="display:inline-block;width:15px;height:15px;background:#dc3545;border-radius:50%;"></span>
        Critical
        `;

                return div;

            };

            legend.addTo(map);

            setTimeout(function() {

                map.invalidateSize();

            }, 300);

        });
    </script>
@endpush
