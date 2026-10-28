@extends('layouts.app')

@section('title', 'Add MEP Vessel Inspection')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-ship text-info"></i>

                Add MEP Vessel Inspection

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

        <form action="{{ route('mep.vessel-inspections.store') }}" method="POST">

            @csrf

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
                                value="{{ old('inspection_number') }}" placeholder="INS-001" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Inspection Date</label>

                            <input type="date" name="inspection_date" class="form-control"
                                value="{{ old('inspection_date') }}" required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Vessel Name</label>

                            <input type="text" name="vessel_name" class="form-control" value="{{ old('vessel_name') }}" placeholder="MV. Example Vessel"
                                required>

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Official Number</label>

                            <input type="text" name="official_number" class="form-control"
                                value="{{ old('official_number') }}" placeholder="123456" >

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">IMO Number</label>

                            <input type="text" name="imo_number" class="form-control" value="{{ old('imo_number') }}" placeholder="IMO1234567">

                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Call Sign</label>

                            <input type="text" name="call_sign" class="form-control" value="{{ old('call_sign') }}" placeholder="DUA1234">

                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Flag</label>

                            <select name="flag" class="form-select">
                                <option value="">-- Select Flag --</option>

                                <option value="Philippines" {{ old('flag') == 'Philippines' ? 'selected' : '' }}>Philippines
                                </option>
                                <option value="Panama" {{ old('flag') == 'Panama' ? 'selected' : '' }}>Panama</option>
                                <option value="Liberia" {{ old('flag') == 'Liberia' ? 'selected' : '' }}>Liberia</option>
                                <option value="Marshall Islands" {{ old('flag') == 'Marshall Islands' ? 'selected' : '' }}>
                                    Marshall Islands</option>
                                <option value="Singapore" {{ old('flag') == 'Singapore' ? 'selected' : '' }}>Singapore
                                </option>
                                <option value="Hong Kong" {{ old('flag') == 'Hong Kong' ? 'selected' : '' }}>Hong Kong
                                </option>
                                <option value="Japan" {{ old('flag') == 'Japan' ? 'selected' : '' }}>Japan</option>
                                <option value="China" {{ old('flag') == 'China' ? 'selected' : '' }}>China</option>
                                <option value="South Korea" {{ old('flag') == 'South Korea' ? 'selected' : '' }}>South
                                    Korea</option>
                                <option value="Malaysia" {{ old('flag') == 'Malaysia' ? 'selected' : '' }}>Malaysia
                                </option>
                                <option value="Indonesia" {{ old('flag') == 'Indonesia' ? 'selected' : '' }}>Indonesia
                                </option>
                                <option value="Vietnam" {{ old('flag') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
                                <option value="Thailand" {{ old('flag') == 'Thailand' ? 'selected' : '' }}>Thailand
                                </option>
                                <option value="United States" {{ old('flag') == 'United States' ? 'selected' : '' }}>United
                                    States</option>
                                <option value="United Kingdom" {{ old('flag') == 'United Kingdom' ? 'selected' : '' }}>
                                    United Kingdom</option>
                                <option value="Australia" {{ old('flag') == 'Australia' ? 'selected' : '' }}>Australia
                                </option>
                                <option value="Norway" {{ old('flag') == 'Norway' ? 'selected' : '' }}>Norway</option>
                                <option value="Denmark" {{ old('flag') == 'Denmark' ? 'selected' : '' }}>Denmark</option>
                                <option value="Bahamas" {{ old('flag') == 'Bahamas' ? 'selected' : '' }}>Bahamas</option>
                                <option value="Malta" {{ old('flag') == 'Malta' ? 'selected' : '' }}>Malta</option>
                                <option value="Cyprus" {{ old('flag') == 'Cyprus' ? 'selected' : '' }}>Cyprus</option>
                                <option value="Other" {{ old('flag') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label">Vessel Type</label>

                            <select name="vessel_type" class="form-select">
                                <option value="">-- Select Vessel Type --</option>

                                <option value="Cargo Ship" {{ old('vessel_type') == 'Cargo Ship' ? 'selected' : '' }}>Cargo
                                    Ship</option>
                                <option value="Container Ship"
                                    {{ old('vessel_type') == 'Container Ship' ? 'selected' : '' }}>Container Ship</option>
                                <option value="Bulk Carrier" {{ old('vessel_type') == 'Bulk Carrier' ? 'selected' : '' }}>
                                    Bulk Carrier</option>
                                <option value="Oil Tanker" {{ old('vessel_type') == 'Oil Tanker' ? 'selected' : '' }}>Oil
                                    Tanker</option>
                                <option value="Chemical Tanker"
                                    {{ old('vessel_type') == 'Chemical Tanker' ? 'selected' : '' }}>Chemical Tanker
                                </option>
                                <option value="LPG Carrier" {{ old('vessel_type') == 'LPG Carrier' ? 'selected' : '' }}>LPG
                                    Carrier</option>
                                <option value="LNG Carrier" {{ old('vessel_type') == 'LNG Carrier' ? 'selected' : '' }}>LNG
                                    Carrier</option>
                                <option value="Passenger Ship"
                                    {{ old('vessel_type') == 'Passenger Ship' ? 'selected' : '' }}>Passenger Ship</option>
                                <option value="Cruise Ship" {{ old('vessel_type') == 'Cruise Ship' ? 'selected' : '' }}>
                                    Cruise Ship</option>
                                <option value="Ro-Ro Vessel" {{ old('vessel_type') == 'Ro-Ro Vessel' ? 'selected' : '' }}>
                                    Ro-Ro Vessel</option>
                                <option value="Fishing Vessel"
                                    {{ old('vessel_type') == 'Fishing Vessel' ? 'selected' : '' }}>Fishing Vessel</option>
                                <option value="Tugboat" {{ old('vessel_type') == 'Tugboat' ? 'selected' : '' }}>Tugboat
                                </option>
                                <option value="Barge" {{ old('vessel_type') == 'Barge' ? 'selected' : '' }}>Barge</option>
                                <option value="Landing Craft"
                                    {{ old('vessel_type') == 'Landing Craft' ? 'selected' : '' }}>Landing Craft</option>
                                <option value="Patrol Vessel"
                                    {{ old('vessel_type') == 'Patrol Vessel' ? 'selected' : '' }}>Patrol Vessel</option>
                                <option value="Naval Vessel" {{ old('vessel_type') == 'Naval Vessel' ? 'selected' : '' }}>
                                    Naval Vessel</option>
                                <option value="Research Vessel"
                                    {{ old('vessel_type') == 'Research Vessel' ? 'selected' : '' }}>Research Vessel
                                </option>
                                <option value="Dredger" {{ old('vessel_type') == 'Dredger' ? 'selected' : '' }}>Dredger
                                </option>
                                <option value="Pleasure Craft"
                                    {{ old('vessel_type') == 'Pleasure Craft' ? 'selected' : '' }}>Pleasure Craft</option>
                                <option value="Yacht" {{ old('vessel_type') == 'Yacht' ? 'selected' : '' }}>Yacht
                                </option>
                                <option value="Other" {{ old('vessel_type') == 'Other' ? 'selected' : '' }}>Other
                                </option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">

                            <label class="form-label">Owner</label>

                            <input type="text" name="owner" class="form-control" value="{{ old('owner') }}">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Master(Captain)</label>

                            <input type="text" name="master" class="form-control" value="{{ old('master') }}" placeholder="Cpt. Juan Dela Cruz">

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Inspection Location</label>

                            <input type="text" name="inspection_location" class="form-control"
                                value="{{ old('inspection_location') }}" required>

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
                                value="{{ old('inspector_name') }}" required>

                        </div>

                        <div class="col-md-6 mb-3">

                            <label class="form-label">Inspection Status</label>

                            <select name="inspection_status" class="form-select" required>

                                <option value="">Select Status</option>

                                <option value="Pending">Pending</option>

                                <option value="Passed">Passed</option>

                                <option value="Failed">Failed</option>

                                <option value="For Correction">For Correction</option>

                            </select>

                        </div>

                        <div class="col-md-12">

                            <label class="form-label">Remarks</label>

                            <textarea name="remarks" rows="5" class="form-control">{{ old('remarks') }}</textarea>

                        </div>

                    </div>

                </div>

            </div>

            <div class="text-end">

                <button type="submit" class="btn btn-success">

                    <i class="fas fa-save"></i>

                    Save Inspection

                </button>

                <a href="{{ route('mep.vessel-inspections.index') }}" class="btn btn-secondary">

                    Cancel

                </a>

            </div>

        </form>

    </div>

@endsection
