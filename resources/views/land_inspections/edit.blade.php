@extends('layouts.app')

@section('title', 'Edit MEP Land-based Inspection')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-industry text-secondary"></i>

                Edit MEP Land-based Inspection

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

        <form action="{{ route('land_inspections.update', $mepLandInspection->id) }}" method="POST">

            @csrf
            @method('PUT')

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
                                value="{{ old('inspection_number', $mepLandInspection->inspection_number) }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Inspection Date</label>

                            <input type="date" name="inspection_date" class="form-control"
                                value="{{ old('inspection_date', $mepLandInspection->inspection_date) }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Facility Name</label>

                            <input type="text" name="facility_name" class="form-control"
                                value="{{ old('facility_name', $mepLandInspection->facility_name) }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Facility Type</label>

                            <input type="text" name="facility_type" class="form-control"
                                value="{{ old('facility_type', $mepLandInspection->facility_type) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Owner / Company</label>

                            <input type="text" name="owner" class="form-control"
                                value="{{ old('owner', $mepLandInspection->owner) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Permit Number</label>

                            <input type="text" name="permit_number" class="form-control"
                                value="{{ old('permit_number', $mepLandInspection->permit_number) }}">

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
                                value="{{ old('inspection_location', $mepLandInspection->inspection_location) }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">City / Municipality</label>

                            <input type="text" name="city_municipality" class="form-control"
                                value="{{ old('city_municipality', $mepLandInspection->city_municipality) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Province</label>

                            <input type="text" name="province" class="form-control"
                                value="{{ old('province', $mepLandInspection->province) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Inspector Name</label>

                            <input type="text" name="inspector_name" class="form-control"
                                value="{{ old('inspector_name', $mepLandInspection->inspector_name) }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Compliance Status</label>

                            <select name="compliance_status" class="form-select" required>

                                <option value="Pending"
                                    {{ old('compliance_status', $mepLandInspection->compliance_status) == 'Pending' ? 'selected' : '' }}>
                                    Pending</option>

                                <option value="Compliant"
                                    {{ old('compliance_status', $mepLandInspection->compliance_status) == 'Compliant' ? 'selected' : '' }}>
                                    Compliant</option>

                                <option value="Non-Compliant"
                                    {{ old('compliance_status', $mepLandInspection->compliance_status) == 'Non-Compliant' ? 'selected' : '' }}>
                                    Non-Compliant</option>

                                <option value="For Reinspection"
                                    {{ old('compliance_status', $mepLandInspection->compliance_status) == 'For Reinspection' ? 'selected' : '' }}>
                                    For Reinspection</option>

                            </select>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">Findings</label>

                            <textarea name="findings" rows="4" class="form-control">{{ old('findings', $mepLandInspection->findings) }}</textarea>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">Recommendations</label>

                            <textarea name="recommendations" rows="4" class="form-control">{{ old('recommendations', $mepLandInspection->recommendations) }}</textarea>

                        </div>

                        <div class="col-md-12 mb-3">

                            <label class="form-label">Remarks</label>

                            <textarea name="remarks" rows="4" class="form-control">{{ old('remarks', $mepLandInspection->remarks) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>

            <div class="mt-3 text-end">

                <button type="submit" class="btn btn-success">

                    <i class="fas fa-save"></i>

                    Update Inspection

                </button>

                <a href="{{ route('land_inspections.index') }}" class="btn btn-secondary">

                    Cancel

                </a>

            </div>

        </form>

    </div>

@endsection
