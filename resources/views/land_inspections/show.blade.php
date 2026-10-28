@extends('layouts.app')

@section('title', 'View MEP Land-based Inspection')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-industry text-secondary"></i>

                MEP Land-based Inspection Details

            </h2>

            <div>

                <a href="{{ route('land_inspections.edit', $mepLandInspection->id) }}" class="btn btn-warning">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

                <a href="{{ route('land_inspections.index') }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </a>

            </div>

        </div>

        <!-- Facility Information -->

        <div class="card mb-3">

            <div class="card-header bg-secondary text-white">

                <strong>Facility Information</strong>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Inspection Number</label>

                        <p>{{ $mepLandInspection->inspection_number }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Inspection Date</label>

                        <p>

                            {{ \Carbon\Carbon::parse($mepLandInspection->inspection_date)->format('F d, Y') }}

                        </p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Facility Name</label>

                        <p>{{ $mepLandInspection->facility_name }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Facility Type</label>

                        <p>{{ $mepLandInspection->facility_type ?: 'N/A' }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Owner / Company</label>

                        <p>{{ $mepLandInspection->owner ?: 'N/A' }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Permit Number</label>

                        <p>{{ $mepLandInspection->permit_number ?: 'N/A' }}</p>

                    </div>

                </div>

            </div>

        </div>

        <!-- Inspection Details -->

        <div class="card mb-3">

            <div class="card-header bg-primary text-white">

                <strong>Inspection Details</strong>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Inspection Location</label>

                        <p>{{ $mepLandInspection->inspection_location }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">City / Municipality</label>

                        <p>{{ $mepLandInspection->city_municipality ?: 'N/A' }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Province</label>

                        <p>{{ $mepLandInspection->province ?: 'N/A' }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">Inspector Name</label>

                        <p>{{ $mepLandInspection->inspector_name }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">Compliance Status</label>

                        <p>

                            @switch($mepLandInspection->compliance_status)
                                @case('Compliant')
                                    <span class="badge bg-success">

                                        Compliant

                                    </span>
                                @break

                                @case('Non-Compliant')
                                    <span class="badge bg-danger">

                                        Non-Compliant

                                    </span>
                                @break

                                @case('For Reinspection')
                                    <span class="badge bg-warning text-dark">

                                        For Reinspection

                                    </span>
                                @break

                                @default
                                    <span class="badge bg-secondary">

                                        Pending

                                    </span>
                            @endswitch

                        </p>

                    </div>

                </div>

            </div>

        </div>

        <!-- Findings -->

        <div class="card mb-3">

            <div class="card-header bg-info text-white">

                <strong>Inspection Findings</strong>

            </div>

            <div class="card-body">

                {!! nl2br(e($mepLandInspection->findings ?: 'No findings recorded.')) !!}

            </div>

        </div>

        <!-- Recommendations -->

        <div class="card mb-3">

            <div class="card-header bg-warning">

                <strong>Recommendations</strong>

            </div>

            <div class="card-body">

                {!! nl2br(e($mepLandInspection->recommendations ?: 'No recommendations available.')) !!}

            </div>

        </div>

        <!-- Remarks -->

        <div class="card">

            <div class="card-header bg-dark text-white">

                <strong>Remarks</strong>

            </div>

            <div class="card-body">

                {!! nl2br(e($mepLandInspection->remarks ?: 'No remarks available.')) !!}

            </div>

        </div>

    </div>

@endsection
