@extends('layouts.app')

@section('title', 'View MEP Vessel Inspection')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-ship text-info"></i>

                MEP Vessel Inspection Details

            </h2>

            <div>
                <a href="{{ route('mep.vessel-inspections.edit', $mepVesselInspection->id) }}" class="btn btn-warning">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

                <a href="{{ route('mep.vessel-inspections.index') }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </a>

            </div>

        </div>

        <!-- Vessel Information -->

        <div class="card mb-3">

            <div class="card-header bg-info">

                <strong>Vessel Information</strong>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Inspection Number</label>

                        <p>{{ $mepVesselInspection->inspection_number }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Inspection Date</label>

                        <p>

                            {{ \Carbon\Carbon::parse($mepVesselInspection->inspection_date)->format('F d, Y') }}

                        </p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Vessel Name</label>

                        <p>{{ $mepVesselInspection->vessel_name }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Official Number</label>

                        <p>{{ $mepVesselInspection->official_number ?: 'N/A' }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">IMO Number</label>

                        <p>{{ $mepVesselInspection->imo_number ?: 'N/A' }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Call Sign</label>

                        <p>{{ $mepVesselInspection->call_sign ?: 'N/A' }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Flag</label>

                        <p>{{ $mepVesselInspection->flag ?: 'N/A' }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Vessel Type</label>

                        <p>{{ $mepVesselInspection->vessel_type ?: 'N/A' }}</p>

                    </div>

                    <div class="col-md-4 mb-3">

                        <label class="fw-bold">Owner</label>

                        <p>{{ $mepVesselInspection->owner ?: 'N/A' }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">Master</label>

                        <p>{{ $mepVesselInspection->master ?: 'N/A' }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">Inspection Location</label>

                        <p>{{ $mepVesselInspection->inspection_location }}</p>

                    </div>

                </div>

            </div>

        </div>

        <!-- Inspection Details -->

        <div class="card">

            <div class="card-header bg-primary">

                <strong>Inspection Details</strong>

            </div>

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">Inspector Name</label>

                        <p>{{ $mepVesselInspection->inspector_name }}</p>

                    </div>

                    <div class="col-md-6 mb-3">

                        <label class="fw-bold">Inspection Status</label>

                        <p>

                            @switch($mepVesselInspection->inspection_status)
                                @case('Passed')
                                    <span class="badge bg-success">Passed</span>
                                @break

                                @case('Failed')
                                    <span class="badge bg-danger">Failed</span>
                                @break

                                @case('For Correction')
                                    <span class="badge bg-warning text-dark">For Correction</span>
                                @break

                                @default
                                    <span class="badge bg-secondary">Pending</span>
                            @endswitch

                        </p>

                    </div>

                    <div class="col-md-12">

                        <label class="fw-bold">Remarks</label>

                        <div class="border rounded p-3 bg-light">

                            {{ $mepVesselInspection->remarks ?: 'No remarks available.' }}

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
