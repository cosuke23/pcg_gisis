@extends('layouts.app')

@section('title', 'Oil Spill Incidents')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-water text-primary"></i>

                Oil Spill Incidents

            </h2>

            <a href="{{ route('oil_spill_incidents.create') }}" class="btn btn-primary">

                <i class="fas fa-plus"></i>

                Report Incident

            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif

        <div class="card">

            <div class="card-body">

                <table id="incidentTable" class="table table-bordered table-striped table-hover">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>
                            <th>Incident No.</th>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Source</th>
                            <th>Severity</th>
                            <th>Status</th>
                            <th>Affected Area</th>
                            <th width="170">Action</th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($incidents as $incident)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $incident->incident_number }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($incident->incident_date)->format('M d, Y') }}
                                    <br>
                                    <small>{{ $incident->incident_time }}</small>
                                </td>

                                <td>{{ $incident->spill_type }}</td>

                                <td>{{ $incident->spill_source }}</td>

                                <td>

                                    @php

                                        $severity = strtolower($incident->severity_level);

                                    @endphp

                                    @if ($severity == 'critical')
                                        <span class="badge bg-danger">Critical</span>
                                    @elseif($severity == 'high')
                                        <span class="badge bg-warning text-dark">High</span>
                                    @elseif($severity == 'moderate')
                                        <span class="badge bg-info">Moderate</span>
                                    @else
                                        <span class="badge bg-success">Low</span>
                                    @endif

                                </td>

                                <td>

                                    @switch($incident->response_status)
                                        @case('Closed')
                                            <span class="badge bg-success">Closed</span>
                                        @break

                                        @case('Contained')
                                            <span class="badge bg-primary">Contained</span>
                                        @break

                                        @case('Cleaned Up')
                                            <span class="badge bg-info">Cleaned Up</span>
                                        @break

                                        @default
                                            <span class="badge bg-warning text-dark">Ongoing</span>
                                    @endswitch

                                </td>

                                <td>{{ $incident->affected_area }}</td>

                                <td>

                                    <a href="{{ route('oil_spill_incidents.edit', $incident->id) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    <form action="{{ route('oil_spill_incidents.destroy', $incident->id) }}" method="POST"
                                        class="d-inline">

                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this incident?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="text-center">

                                        No Oil Spill Incidents Found.

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

                $('#incidentTable').DataTable({

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
