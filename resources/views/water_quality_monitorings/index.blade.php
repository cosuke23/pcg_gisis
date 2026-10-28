@extends('layouts.app')

@section('title', 'Water Quality Monitoring')

@section('content')

    <div class="container-fluid">

        <!-- Page Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>
                <i class="fas fa-water text-primary"></i>
                Water Quality Monitoring
            </h2>

            <a href="{{ route('water-quality-monitorings.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i>
                Add New Report
            </a>

        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                <i class="fas fa-check-circle"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        <!-- Report Table -->
        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">

                <strong>

                    <i class="fas fa-list"></i>

                    Water Quality Monitoring Reports

                </strong>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover table-striped" id="waterQualityTable">

                        <thead class="table-dark">

                            <tr>

                                <th width="5%">#</th>

                                <th>Report No.</th>

                                <th>Date</th>

                                <th>Monitoring Station</th>

                                <th>Body of Water</th>

                                <th>Province</th>

                                <th>Status</th>

                                <th>Inspector</th>

                                <th width="170">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($reports as $report)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $report->report_number }}</td>

                                    <td>
                                        {{ \Carbon\Carbon::parse($report->monitoring_date)->format('M d, Y') }}
                                    </td>

                                    <td>{{ $report->monitoring_station }}</td>

                                    <td>{{ $report->body_of_water }}</td>

                                    <td>{{ $report->province }}</td>

                                    <td>

                                        @if ($report->water_quality_status == 'Good')
                                            <span class="badge bg-success">

                                                Good

                                            </span>
                                        @elseif($report->water_quality_status == 'Fair')
                                            <span class="badge bg-info">

                                                Fair

                                            </span>
                                        @elseif($report->water_quality_status == 'Poor')
                                            <span class="badge bg-warning text-dark">

                                                Poor

                                            </span>
                                        @else
                                            <span class="badge bg-danger">

                                                Critical

                                            </span>
                                        @endif

                                    </td>

                                    <td>{{ $report->inspector_name }}</td>

                                    <td>

                                        <a href="{{ route('water-quality-monitorings.show', $report->id) }}"
                                            class="btn btn-sm btn-info">

                                            <i class="fas fa-eye"></i>

                                        </a>

                                        <a href="{{ route('water-quality-monitorings.edit', $report->id) }}"
                                            class="btn btn-sm btn-warning">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        <form action="{{ route('water-quality-monitorings.destroy', $report->id) }}"
                                            method="POST" class="d-inline">

                                            @csrf

                                            @method('DELETE')

                                            <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Delete this report?')">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="text-center text-muted">

                                        No Water Quality Monitoring Reports Found.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection


@section('scripts')

    <script>
        $(document).ready(function() {

            $('#waterQualityTable').DataTable({

                responsive: true,

                autoWidth: false,

                pageLength: 10,

                order: [
                    [2, 'desc']
                ],

                language: {

                    search: "Search:",

                    lengthMenu: "Show _MENU_ entries",

                    info: "Showing _START_ to _END_ of _TOTAL_ reports",

                    emptyTable: "No reports available"

                }

            });

        });
    </script>

@endsection
