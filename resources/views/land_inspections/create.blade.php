@extends('layouts.app')

@section('title', 'Add MEP Land-based Inspection')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-industry text-secondary"></i>

                Add MEP Land-based Inspection

            </h2>

            <a href="{{ route('land_inspections.index') }}" class="btn btn-secondary">

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

        <form action="{{ route('land_inspections.store') }}" method="POST">

            @csrf

            <!-- Facility Information -->

            <div class="card mb-3">

                <div class="card-header bg-secondary text-white">

                    <strong>Facility Information</strong>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Inspection Number</label>

                            <input type="text" name="inspection_number" class="form-control"
                                value="{{ old('inspection_number') }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Inspection Date</label>

                            <input type="date" name="inspection_date" class="form-control"
                                value="{{ old('inspection_date', date('Y-m-d')) }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Facility Name</label>

                            <input type="text" name="facility_name" class="form-control"
                                value="{{ old('facility_name') }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label for="facility_type" class="form-label">

                                Facility Type <span class="text-danger">*</span>

                            </label>

                            <select name="facility_type" id="facility_type"
                                class="form-select @error('facility_type') is-invalid @enderror" required>

                                <option value="">-- Select Facility Type --</option>

                                @php

                                    $facilityTypes = [
                                        'Port Terminal',

                                        'Commercial Port',

                                        'Private Port',

                                        'Fish Port',

                                        'Marina',

                                        'Shipyard',

                                        'Dry Dock',

                                        'Cargo Terminal',

                                        'Container Yard',

                                        'Fuel Depot',

                                        'Petroleum Depot',

                                        'Oil Storage Facility',

                                        'LNG Terminal',

                                        'Chemical Storage Facility',

                                        'Waste Treatment Facility',

                                        'Waste Transfer Station',

                                        'Industrial Plant',

                                        'Power Plant',

                                        'Coastal Manufacturing Facility',

                                        'Recycling Facility',

                                        'Hazardous Waste Facility',

                                        'Government Facility',

                                        'Environmental Monitoring Station',

                                        'Other',
                                    ];

                                @endphp

                                @foreach ($facilityTypes as $type)
                                    <option value="{{ $type }}"
                                        {{ old('facility_type', $mepLandInspection->facility_type ?? '') == $type ? 'selected' : '' }}>

                                        {{ $type }}

                                    </option>
                                @endforeach

                            </select>

                            @error('facility_type')
                                <div class="invalid-feedback">

                                    {{ $message }}

                                </div>
                            @enderror

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Owner / Company</label>

                            <input type="text" name="owner" class="form-control" value="{{ old('owner') }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Permit Number</label>

                            <input type="text" name="permit_number" class="form-control"
                                value="{{ old('permit_number') }}">

                        </div>

                    </div>

                </div>

            </div>

            <!-- Inspection Details -->

            <div class="card">

                <div class="card-header bg-primary text-white">

                    <strong>Inspection Details</strong>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Inspection Location</label>

                            <input type="text" name="inspection_location" class="form-control"
                                value="{{ old('inspection_location') }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">City / Municipality</label>

                            <input type="text" name="city_municipality" class="form-control"
                                value="{{ old('city_municipality') }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Province</label>

                            <input type="text" name="province" class="form-control" value="{{ old('province') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Inspector Name</label>

                            <input type="text" name="inspector_name" class="form-control"
                                value="{{ old('inspector_name') }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Compliance Status</label>

                            <select name="compliance_status" class="form-select" required>

                                <option value="Pending">Pending</option>

                                <option value="Compliant">Compliant</option>

                                <option value="Non-Compliant">Non-Compliant</option>

                                <option value="For Reinspection">For Reinspection</option>

                            </select>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">Findings</label>

                            <textarea name="findings" rows="4" class="form-control">{{ old('findings') }}</textarea>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">Recommendations</label>

                            <textarea name="recommendations" rows="4" class="form-control">{{ old('recommendations') }}</textarea>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">Remarks</label>

                            <textarea name="remarks" rows="4" class="form-control">{{ old('remarks') }}</textarea>

                        </div>

                    </div>

                </div>

            </div>

            <div class="mt-3 text-end">

                <button type="submit" class="btn btn-success">

                    <i class="fas fa-save"></i>

                    Save Inspection

                </button>

                <a href="{{ route('land_inspections.index') }}" class="btn btn-secondary">

                    Cancel

                </a>

            </div>

        </form>

    </div>

@endsection
