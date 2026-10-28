@extends('layouts.app')

@section('title', 'Dump Sites')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>Dump Sites</h2>

            <a href="{{ route('dump_sites.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Dump Site
            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">

            <div class="card-body">

                <div class="table-responsive">

                    <table id="dumpSitesTable" class="table table-bordered table-striped">

                        <thead class="table-dark">

                            <tr>

                                <th>#</th>
                                <th>Site Name</th>
                                <th>Location</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th width="180">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($dumpSites as $site)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>{{ $site->site_name }}</td>

                                    <td>{{ $site->location }}</td>

                                    <td>{{ $site->latitude }}</td>

                                    <td>{{ $site->longitude }}</td>

                                    <td>{{ $site->description }}</td>

                                    <td>

                                        @if ($site->is_active)
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

                                        <a href="{{ route('dump_sites.edit', $site->id) }}" class="btn btn-warning btn-sm">

                                            <i class="fas fa-edit"></i>

                                            Edit

                                        </a>

                                        <form action="{{ route('dump_sites.destroy', $site->id) }}" method="POST"
                                            class="d-inline">

                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Delete this dump site?')">

                                                <i class="fas fa-trash"></i>

                                                Delete

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="7" class="text-center">

                                        No dump sites found.

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

@push('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.bootstrap5.min.css">
@endpush

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>

    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(function() {

            $('#dumpSitesTable').DataTable({

                pageLength: 10,

                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],

                ordering: true,

                searching: true,

                info: true,

                paging: true

            });

        });
    </script>
@endpush
