@extends('layouts.app')

@section('title', 'Edit MEP Vessel Inspection')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-edit text-warning"></i>

                Edit MEP Vessel Inspection

            </h2>

            <a href="{{ route('mep.vessel-inspections.index') }}" class="btn btn-secondary">

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
        <form action="{{ route('mep.vessel-inspections.update', ['vessel_inspection' => $mepVesselInspection->id]) }}"
            method="POST">

            @csrf
            @method('PUT')

            <!-- Vessel Information -->

            <div class="card mb-3">

                <div class="card-header bg-info">

                    <strong>Vessel Information</strong>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Inspection Number</label>

                            <input type="text" name="inspection_number" class="form-control"
                                value="{{ old('inspection_number', $mepVesselInspection->inspection_number) }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Inspection Date</label>

                            <input type="date" name="inspection_date" class="form-control"
                                value="{{ old('inspection_date', $mepVesselInspection->inspection_date) }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Vessel Name</label>

                            <input type="text" name="vessel_name" class="form-control"
                                value="{{ old('vessel_name', $mepVesselInspection->vessel_name) }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Official Number</label>

                            <input type="text" name="official_number" class="form-control"
                                value="{{ old('official_number', $mepVesselInspection->official_number) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">IMO Number</label>

                            <input type="text" name="imo_number" class="form-control"
                                value="{{ old('imo_number', $mepVesselInspection->imo_number) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Call Sign</label>

                            <input type="text" name="call_sign" class="form-control"
                                value="{{ old('call_sign', $mepVesselInspection->call_sign) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Flag</label>

                            <input type="text" name="flag" class="form-control"
                                value="{{ old('flag', $mepVesselInspection->flag) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Vessel Type</label>

                            <input type="text" name="vessel_type" class="form-control"
                                value="{{ old('vessel_type', $mepVesselInspection->vessel_type) }}">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Owner</label>

                            <input type="text" name="owner" class="form-control"
                                value="{{ old('owner', $mepVesselInspection->owner) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Master</label>

                            <input type="text" name="master" class="form-control"
                                value="{{ old('master', $mepVesselInspection->master) }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Inspection Location</label>

                            <input type="text" name="inspection_location" class="form-control"
                                value="{{ old('inspection_location', $mepVesselInspection->inspection_location) }}"
                                required>

                        </div>

                    </div>

                </div>

            </div>

            <!-- Inspection Details -->

            <div class="card mb-3">

                <div class="card-header bg-primary">

                    <strong>Inspection Details</strong>

                </div>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Inspector Name</label>

                            <input type="text" name="inspector_name" class="form-control"
                                value="{{ old('inspector_name', $mepVesselInspection->inspector_name) }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Inspection Status</label>

                            <select name="inspection_status" class="form-select" required>

                                <option value="Pending"
                                    {{ old('inspection_status', $mepVesselInspection->inspection_status) == 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="Passed"
                                    {{ old('inspection_status', $mepVesselInspection->inspection_status) == 'Passed' ? 'selected' : '' }}>
                                    Passed
                                </option>

                                <option value="Failed"
                                    {{ old('inspection_status', $mepVesselInspection->inspection_status) == 'Failed' ? 'selected' : '' }}>
                                    Failed
                                </option>

                                <option value="For Correction"
                                    {{ old('inspection_status', $mepVesselInspection->inspection_status) == 'For Correction' ? 'selected' : '' }}>
                                    For Correction
                                </option>

                            </select>

                        </div>

                        <div class="col-md-12">

                            <label class="form-label">Remarks</label>

                            <textarea name="remarks" rows="5" class="form-control">{{ old('remarks', $mepVesselInspection->remarks) }}</textarea>

                        </div>

                    </div>

                </div>

            </div>

            <div class="text-end">

                <button type="submit" class="btn btn-warning">

                    <i class="fas fa-save"></i>

                    Update Inspection

                </button>

                <a href="{{ route('mep.vessel-inspections.index') }}" class="btn btn-secondary">

                    Cancel

                </a>

            </div>

        </form>

    </div>

@endsection
