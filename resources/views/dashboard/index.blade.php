@extends('layouts.app')

@section('content')
    <div class="row">

        <div class="col-md-12">

            <div class="card">

                <div class="card-header bg-primary">

                    <h3 class="card-title">
                        Marine Environmental Protection Integrated Operation System
                    </h3>

                </div>

                <div class="card-body">

                    <h2>
                        Welcome, {{ Auth::user()->name }}
                    </h2>

                    <hr>

                    <p>
                        Philippine Coast Guard
                    </p>

                    <p>
                        Marine Environmental Protection Command
                    </p>

                </div>

            </div>

        </div>

    </div>


    <!-- ============================
                             Marine Environmental Protection Modules
                        ============================= -->

    <div class="row mt-4">

        <div class="col-md-12">

            <h3 class="mb-3">
                Marine Environmental Protection Modules
            </h3>

        </div>


        <!-- London Dumping Protocol -->

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <i class="fas fa-clipboard-list fa-3x text-primary mb-3"></i>

                    <h5>
                        London Dumping Protocol
                    </h5>

                    <p class="text-muted">
                        Manage permits and annual reporting for sea-based waste disposal.
                    </p>
                    <a href="{{ route('dump_sites.index') }}" class="btn btn-primary btn-sm">
                        Open Module
                    </a>

                </div>

            </div>

        </div>



        <!-- Oil Spill Response -->

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <i class="fas fa-droplet-slash fa-3x text-danger mb-3"></i>

                    <h5>
                        Oil Spill Response
                    </h5>

                    <p class="text-muted">
                        Track and report incidents of oil spills within Philippine jurisdiction.
                    </p>

                    <a href="{{ route('oil_spill_incidents.index') }}" class="btn btn-danger btn-sm">
                        Open Module
                    </a>

                </div>

            </div>

        </div>



        <!-- HNS Spill Response -->

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <i class="fas fa-biohazard fa-3x text-warning mb-3"></i>

                    <h5>
                        HNS Spill Response
                    </h5>

                    <p class="text-muted">
                        Monitor and report Hazardous and Noxious Substances spills.
                    </p>

                    <a href="{{ route('oil_spill_incidents.index') }}" class="btn btn-warning btn-sm">
                        Open Module
                    </a>

                </div>

            </div>

        </div>



        <!-- MEP Vessel Inspections -->

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <i class="fas fa-ship fa-3x text-info mb-3"></i>

                    <h5>
                        MEP Vessel Inspections
                    </h5>

                    <p class="text-muted">
                        Access records of environmental inspections for domestic vessels.
                    </p>

                    <a href="{{ route('mep.vessel-inspections.index') }}" class="btn btn-info btn-sm">
                        Open Module
                    </a>

                </div>

            </div>

        </div>


    </div>



    <div class="row mt-3">


        <!-- Land-based Inspections -->

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <i class="fas fa-industry fa-3x text-secondary mb-3"></i>

                    <h5>
                        MEP Land-based Inspections
                    </h5>

                    <p class="text-muted">
                        View environmental compliance data from land-based facilities.
                    </p>

                    <a href="{{ route('land_inspections.index') }}" class="btn btn-secondary btn-sm">

                        Open Module

                    </a>

                </div>

            </div>

        </div>



        <!-- Water Quality Monitoring -->

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <i class="fas fa-water fa-3x text-primary mb-3"></i>

                    <h5>
                        Water Quality Monitoring
                    </h5>

                    <p class="text-muted">
                        Submit and track monthly water quality reports.
                    </p>

                    <a href="{{ route('water-quality-monitorings.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-water"></i>
                        Open Module
                    </a>

                </div>

            </div>

        </div>



        <!-- Thematic Mapping -->

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <i class="fas fa-map fa-3x text-success mb-3"></i>

                    <h5>
                        Thematic Mapping
                    </h5>

                    <p class="text-muted">
                        Visualize shoreline and environmental protection mapping.
                    </p>
                    <a href="{{ route('thematic-mappings.index') }}" class="btn btn-success btn-sm">
                        Open Module
                    </a>

                </div>

            </div>

        </div>



        <!-- Coral Assessment -->

        <div class="col-md-3">

            <div class="card shadow-sm">

                <div class="card-body text-center">

                    <i class="fas fa-leaf fa-3x text-success mb-3"></i>

                    <h5>

                        Coral Assessment & Rehab

                    </h5>

                    <p class="text-muted">

                        Track coral reef health assessments and rehabilitation projects.

                    </p>

                    <a href="{{ route('coral-assessments.index') }}" class="btn btn-success btn-sm">

                        Open Module

                    </a>

                </div>

            </div>

        </div>


    </div>
@endsection
