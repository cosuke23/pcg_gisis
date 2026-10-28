@extends('layouts.app')

@section('title', 'Coral Assessment & Rehabilitation')

@section('content')

    <div class="container-fluid">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                <i class="fas fa-check-circle"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        <div class="card shadow">

            <div class="card-header bg-success text-white">

                <div class="d-flex justify-content-between align-items-center">

                    <h3 class="mb-0">

                        <i class="fas fa-leaf"></i>

                        Coral Assessment & Rehabilitation

                    </h3>

                    <a href="{{ route('coral-assessments.create') }}" class="btn btn-light">

                        <i class="fas fa-plus-circle"></i>

                        New Assessment

                    </a>

                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover table-striped" id="assessmentTable">

                        <thead class="table-success">

                            <tr>

                                <th>#</th>

                                <th>Assessment No.</th>

                                <th>Assessment Date</th>

                                <th>Site</th>

                                <th>Reef Type</th>

                                <th>Condition</th>

                                <th>Live Coral</th>

                                <th>Rehabilitation</th>

                                <th>Status</th>

                                <th width="180">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($assessments as $assessment)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        <strong>

                                            {{ $assessment->assessment_number }}

                                        </strong>

                                    </td>

                                    <td>

                                        {{ \Carbon\Carbon::parse($assessment->assessment_date)->format('M d, Y') }}

                                    </td>

                                    <td>

                                        {{ $assessment->site_name }}

                                    </td>

                                    <td>

                                        <span class="badge bg-primary">

                                            {{ $assessment->reef_type }}

                                        </span>

                                    </td>

                                    <td>

                                        @switch($assessment->reef_condition)
                                            @case('Excellent')
                                                <span class="badge bg-success">Excellent</span>
                                            @break

                                            @case('Good')
                                                <span class="badge bg-info">Good</span>
                                            @break

                                            @case('Fair')
                                                <span class="badge bg-warning">Fair</span>
                                            @break

                                            @case('Poor')
                                                <span class="badge bg-danger">Poor</span>
                                            @break

                                            @default
                                                <span class="badge bg-dark">Critical</span>
                                        @endswitch

                                    </td>

                                    <td>

                                        {{ number_format($assessment->live_coral_cover, 2) }} %

                                    </td>

                                    <td>

                                        @if ($assessment->rehabilitation_required)
                                            <span class="badge bg-warning">

                                                Required

                                            </span>
                                        @else
                                            <span class="badge bg-success">

                                                Not Required

                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        @if ($assessment->status)
                                            <span class="badge bg-success">

                                                Active

                                            </span>
                                        @else
                                            <span class="badge bg-danger">

                                                Inactive

                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        <a href="{{ route('coral-assessments.show', $assessment->id) }}"
                                            class="btn btn-info btn-sm">

                                            <i class="fas fa-eye"></i>

                                        </a>

                                        <a href="{{ route('coral-assessments.edit', $assessment->id) }}"
                                            class="btn btn-warning btn-sm">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        <form action="{{ route('coral-assessments.destroy', $assessment->id) }}"
                                            method="POST" style="display:inline-block;" class="deleteForm">

                                            @csrf

                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm">

                                                <i class="fas fa-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection

@push('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $(function() {

            $('#assessmentTable').DataTable({

                responsive: true,

                pageLength: 10,

                order: [
                    [1, 'desc']
                ]

            });

        });

        $('.deleteForm').submit(function(e) {

            e.preventDefault();

            let form = this;

            Swal.fire({

                title: 'Delete Assessment?',

                text: 'This assessment record will be permanently deleted.',

                icon: 'warning',

                showCancelButton: true,

                confirmButtonColor: '#d33',

                confirmButtonText: 'Yes, Delete'

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });
    </script>
@endpush
