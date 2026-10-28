@extends('layouts.app')

@section('title', 'MEP Vessel Inspections')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-ship text-info"></i>

                MEP Vessel Inspections

            </h2>

            <a href="{{ route('mep.vessel-inspections.create') }}" class="btn btn-info">

                <i class="fas fa-plus"></i>

                Add Inspection

            </a>

        </div>

        @if (session('success'))
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

                            <th>Vessel Name</th>

                            <th>Official No.</th>

                            <th>IMO No.</th>

                            <th>Vessel Type</th>

                            <th>Inspector</th>

                            <th>Status</th>

                            <th width="170">Action</th>

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

                                <td>{{ $inspection->vessel_name }}</td>

                                <td>{{ $inspection->official_number }}</td>

                                <td>{{ $inspection->imo_number }}</td>

                                <td>{{ $inspection->vessel_type }}</td>

                                <td>{{ $inspection->inspector_name }}</td>

                                <td>

                                    @switch($inspection->inspection_status)
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

                                </td>

                                <td>

                                    <a href="{{ route('mep.vessel-inspections.show', $inspection->id) }}"
                                        class="btn btn-primary btn-sm">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    <a href="{{ route('mep.vessel-inspections.edit', $inspection->id) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form action="{{ route('mep.vessel-inspections.destroy', $inspection->id) }}"
                                        method="POST" class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this inspection?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                                <tr>

                                    <td colspan="10" class="text-center">

                                        No Vessel Inspection Records Found.

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
            $(function() {

                $('#inspectionTable').DataTable({

                    responsive: true,

                    pageLength: 10,

                    order: [
                        [1, 'desc']
                    ],

                    lengthMenu: [
                        [10, 25, 50, 100, -1],
                        [10, 25, 50, 100, 'All']
                    ]

                });

            });
        </script>
    @endpush
