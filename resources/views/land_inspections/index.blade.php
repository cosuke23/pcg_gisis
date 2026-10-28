@extends('layouts.app')

@section('title', 'MEP Land-based Inspections')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-industry text-secondary"></i>

                MEP Land-based Inspections

            </h2>

            <a href="{{ route('land_inspections.create') }}" class="btn btn-secondary">

                <i class="fas fa-plus"></i>

                Add Inspection

            </a>

        </div>

        @if(session('success'))

            <div class="alert alert-success">

                {{ session('success') }}

            </div>

        @endif

        <div class="card">

            <div class="card-body">

                <table id="inspectionTable" class="table table-bordered table-striped table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Inspection No.</th>

                            <th>Date</th>

                            <th>Facility Name</th>

                            <th>Facility Type</th>

                            <th>Province</th>

                            <th>Inspector</th>

                            <th>Status</th>

                            <th width="180">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($inspections as $inspection)

                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $inspection->inspection_number }}</td>

                                <td>

                                    {{ \Carbon\Carbon::parse($inspection->inspection_date)->format('M d, Y') }}

                                </td>

                                <td>{{ $inspection->facility_name }}</td>

                                <td>{{ $inspection->facility_type }}</td>

                                <td>{{ $inspection->province }}</td>

                                <td>{{ $inspection->inspector_name }}</td>

                                <td>

                                    @switch($inspection->compliance_status)

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

                                </td>

                                <td>

                                    <a href="{{ route('land_inspections.show', $inspection->id) }}"
                                        class="btn btn-primary btn-sm">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    <a href="{{ route('land_inspections.edit', $inspection->id) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form action="{{ route('land_inspections.destroy', $inspection->id) }}"
                                        method="POST"
                                        class="d-inline">

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this inspection record?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center">

                                    No Land Inspection Records Found.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

@endsection

@push('scripts')

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>

    <script>

        $(function () {

            $('#inspectionTable').DataTable({

                responsive: true,

                pageLength: 10,

                order: [[1, 'desc']],

                lengthMenu: [

                    [10, 25, 50, 100, -1],

                    [10, 25, 50, 100, 'All']

                ]

            });

        });

    </script>

@endpush