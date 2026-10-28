@extends('layouts.app')

@section('title', 'MEP Reports Dashboard')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2>

                    <i class="fas fa-chart-line text-primary"></i>

                    Marine Environmental Protection Reports

                </h2>

                <small class="text-muted">

                    Philippine Coast Guard • Marine Environmental Protection Integrated Operation System

                </small>

            </div>

            <a href="{{ route('environmental.report.pdf') }}" class="btn btn-danger">

                <i class="fas fa-file-pdf"></i>

                Generate PDF Report

            </a>

        </div>

        <div class="row">

            <div class="col-lg-3">

                <div class="small-box bg-primary">

                    <div class="inner">

                        <h3>{{ $dumpSites }}</h3>

                        <p>Registered Dump Sites</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-map-marker-alt"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-3">

                <div class="small-box bg-danger">

                    <div class="inner">

                        <h3>{{ $oilSpills }}</h3>

                        <p>Oil Spill Incidents</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-water"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-3">

                <div class="small-box bg-info">

                    <div class="inner">

                        <h3>{{ $vesselInspections }}</h3>

                        <p>Vessel Inspections</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-ship"></i>

                    </div>

                </div>

            </div>

            <div class="col-lg-3">

                <div class="small-box bg-secondary">

                    <div class="inner">

                        <h3>{{ $landInspections }}</h3>

                        <p>Land Inspections</p>

                    </div>

                    <div class="icon">

                        <i class="fas fa-industry"></i>

                    </div>

                </div>

            </div>

        </div>

        <div class="row mt-4">

            <div class="col-lg-8">

                <div class="card">

                    <div class="card-header bg-primary text-white">

                        <strong>

                            Executive Dashboard

                        </strong>

                    </div>
                    <div class="card-body">

                        <div class="container-fluid">

                            <div class="row">

                                <div class="col-lg-6 mb-4">

                                    <div class="card">

                                        <div class="card-header">

                                            <strong>Oil Spill Trend</strong>

                                        </div>

                                        <div class="card-body">

                                            <canvas id="oilTrendChart" height="250"></canvas>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-6 mb-4">

                                    <div class="card">

                                        <div class="card-header">

                                            <strong>Spill Severity</strong>

                                        </div>

                                        <div class="card-body">

                                            <canvas id="severityChart" height="250"></canvas>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-6 mb-4">

                                    <div class="card">

                                        <div class="card-header">

                                            <strong>Vessel Inspection Status</strong>

                                        </div>

                                        <div class="card-body">

                                            <canvas id="vesselChart" height="250"></canvas>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-6 mb-4">

                                    <div class="card">

                                        <div class="card-header">

                                            <strong>Land Inspection Compliance</strong>

                                        </div>

                                        <div class="card-body">

                                            <canvas id="landChart" height="250"></canvas>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-lg-12">

                                    <div class="card">

                                        <div class="card-header">

                                            <strong>Dump Sites by Province</strong>

                                        </div>

                                        <div class="card-body">

                                            <canvas id="dumpChart" height="120"></canvas>

                                        </div>
                                        {{-- <div class="card">

                                            <div class="card-header bg-danger text-white">

                                                Environmental Risk Index

                                            </div>


                                            <div class="card-body">

                                                <canvas id="riskGauge"></canvas>

                                            </div>

                                        </div> --}}
                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-lg-4">
                <div class="card">

                    <div class="card-header bg-success text-white">

                        <i class="fas fa-robot"></i>

                        AI Environmental Assessment

                    </div>


                    <div class="card-body">


                        <div class="text-center mb-3">


                            <h1>

                                {{ $riskScore }}%

                            </h1>


                            <h4>

                                @if ($riskLevel == 'Critical')
                                    <span class="badge bg-danger">
                                    @elseif($riskLevel == 'High')
                                        <span class="badge bg-warning">
                                        @elseif($riskLevel == 'Moderate')
                                            <span class="badge bg-info">
                                            @else
                                                <span class="badge bg-success">
                                @endif


                                {{ $riskLevel }} Risk


                                </span>


                            </h4>


                        </div>



                        <hr>


                        <h6>

                            <i class="fas fa-search"></i>

                            AI Findings

                        </h6>


                        <ul>

                            @foreach ($aiFindings as $finding)
                                <li>

                                    {{ $finding }}

                                </li>
                            @endforeach

                        </ul>



                        <hr>


                        <h6>

                            <i class="fas fa-lightbulb"></i>

                            AI Recommendations

                        </h6>


                        <ul>

                            @foreach ($aiRecommendations as $recommendation)
                                <li>

                                    {{ $recommendation }}

                                </li>
                            @endforeach


                        </ul>


                    </div>

                </div>

            </div>

        </div>

        <div class="card mt-4">

            <div class="card-header bg-dark text-white">

                Latest Environmental Activities

            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <thead>

                        <tr>

                            <th>Module</th>

                            <th>Total Records</th>

                            <th>Status</th>

                        </tr>

                    </thead>

                    <tbody>

                        <tr>

                            <td>Dump Sites</td>

                            <td>{{ $dumpSites }}</td>

                            <td><span class="badge bg-success">Active</span></td>

                        </tr>

                        <tr>

                            <td>Oil Spill Incidents</td>

                            <td>{{ $oilSpills }}</td>

                            <td><span class="badge bg-danger">Monitoring</span></td>

                        </tr>

                        <tr>

                            <td>Vessel Inspections</td>

                            <td>{{ $vesselInspections }}</td>

                            <td><span class="badge bg-info">Operational</span></td>

                        </tr>

                        <tr>

                            <td>Land-based Inspections</td>

                            <td>{{ $landInspections }}</td>

                            <td><span class="badge bg-secondary">Operational</span></td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const months = [
            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
        ];

        // Oil Trend
        new Chart(document.getElementById('oilTrendChart'), {

            type: 'line',

            data: {

                labels: months,

                datasets: [{

                    label: 'Oil Spill Incidents',

                    data: @json($oilTrendData),

                    borderWidth: 3,

                    fill: true

                }]

            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }

        });

        // Severity

        new Chart(document.getElementById('severityChart'), {

            type: 'pie',

            data: {

                labels: @json($severity->keys()),

                datasets: [{

                    data: @json($severity->values())

                }]

            }

        });

        // Vessel

        new Chart(document.getElementById('vesselChart'), {

            type: 'doughnut',

            data: {

                labels: @json($vesselStatus->keys()),

                datasets: [{

                    data: @json($vesselStatus->values())

                }]

            }

        });

        // Land

        new Chart(document.getElementById('landChart'), {

            type: 'doughnut',

            data: {

                labels: @json($landStatus->keys()),

                datasets: [{

                    data: @json($landStatus->values())

                }]

            }

        });

        // Dump Sites

        new Chart(document.getElementById('dumpChart'), {

            type: 'bar',

            data: {

                labels: @json($dumpProvince->keys()),

                datasets: [{

                    label: 'Dump Sites',

                    data: @json($dumpProvince->values())

                }]

            }

        });
        // The risk gauge card is commented out in the markup above, so only
        // draw it when its canvas exists.
        document.getElementById('riskGauge') && new Chart(
            document.getElementById('riskGauge'), {

                type: 'doughnut',

                data: {

                    labels: [
                        'Risk',
                        'Safe'
                    ],

                    datasets: [{

                        data: [
                            @json($riskScore),
                            100 - @json($riskScore)
                        ]

                    }]

                },

                options: {

                    cutout: '75%',

                    plugins: {

                        legend: {
                            display: false
                        }

                    }

                }

            });
    </script>
@endpush
