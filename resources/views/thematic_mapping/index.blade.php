@extends('layouts.app')

@section('title', 'Thematic Mapping')

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

                        <i class="fas fa-map-marked-alt"></i>

                        Thematic Mapping

                    </h3>

                    <a href="{{ route('thematic-mappings.create') }}" class="btn btn-light">

                        <i class="fas fa-plus-circle"></i>

                        Add Mapping

                    </a>

                </div>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-bordered table-hover table-striped" id="mappingTable">

                        <thead class="table-success">

                            <tr>

                                <th width="5%">#</th>

                                <th>Title</th>

                                <th>Category</th>

                                <th>Geometry</th>

                                <th>Location</th>

                                <th>Coordinates</th>

                                <th>Status</th>

                                <th width="180">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @foreach ($maps as $map)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        <strong>{{ $map->map_title }}</strong>

                                    </td>

                                    <td>

                                        <span class="badge bg-primary">

                                            {{ $map->category }}

                                        </span>

                                    </td>

                                    <td>

                                        <span class="badge bg-info">

                                            {{ $map->geometry_type }}

                                        </span>

                                    </td>

                                    <td>

                                        {{ $map->location_name }}

                                    </td>

                                    <td>

                                        <small>

                                            {{ $map->latitude }}

                                            <br>

                                            {{ $map->longitude }}

                                        </small>

                                    </td>

                                    <td>

                                        @if ($map->status)
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

                                        <a href="{{ route('thematic-mappings.show', $map->id) }}"
                                            class="btn btn-info btn-sm">

                                            <i class="fas fa-eye"></i>

                                        </a>

                                        <a href="{{ route('thematic-mappings.edit', $map->id) }}"
                                            class="btn btn-warning btn-sm">

                                            <i class="fas fa-edit"></i>

                                        </a>

                                        <form action="{{ route('thematic-mappings.destroy', $map->id) }}" method="POST"
                                            style="display:inline-block;" class="deleteForm">

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

            $('#mappingTable').DataTable({

                responsive: true,

                pageLength: 10,

                order: [
                    [0, 'desc']
                ]

            });

        });

        $('.deleteForm').submit(function(e) {

            e.preventDefault();

            let form = this;

            Swal.fire({

                title: 'Delete Mapping?',

                text: 'This record will be permanently deleted.',

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
