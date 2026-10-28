@extends('layouts.app')

@section('title', 'Annual Activities')

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css">
@endpush

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-calendar-alt"></i>

                Annual Activities

            </h2>

            <a href="{{ route('annual_activities.create') }}" class="btn btn-primary">

                <i class="fas fa-plus"></i>

                Add Activity

            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif

        <div class="card">

            <div class="card-body">

                <table id="activitiesTable" class="table table-bordered table-striped">

                    <thead class="table-dark">

                        <tr>

                            <th>#</th>

                            <th>Date</th>

                            <th>Activity</th>

                            <th>Type</th>

                            <th>Location</th>

                            <th>Conducted By</th>

                            <th>Participants</th>

                            <th>Status</th>

                            <th width="180">

                                Action

                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @forelse($annualActivities as $activity)
                            <tr>

                                <td>{{ $loop->iteration }}</td>

                                <td>{{ \Carbon\Carbon::parse($activity->activity_date)->format('M d, Y') }}</td>

                                <td>{{ $activity->activity_title }}</td>

                                <td>{{ $activity->activity_type }}</td>

                                <td>{{ $activity->location }}</td>

                                <td>{{ $activity->conducted_by }}</td>

                                <td>{{ number_format($activity->participants) }}</td>

                                <td>

                                    @if ($activity->is_active)
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

                                    <a href="{{ route('annual_activities.edit', $activity->id) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="fas fa-edit"></i>

                                        Edit

                                    </a>

                                    <form action="{{ route('annual_activities.destroy', $activity->id) }}" method="POST"
                                        class="d-inline">

                                        @csrf

                                        @method('DELETE')

                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this activity?')">

                                            <i class="fas fa-trash"></i>

                                            Delete

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="text-center">

                                    No Annual Activities Found.

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

    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function() {

            $('#activitiesTable').DataTable({

                responsive: true,

                pageLength: 10,

                order: [
                    [1, 'desc']
                ]

            });

        });
    </script>
@endpush
