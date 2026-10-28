@extends('layouts.app')

@section('title', 'User Management')

@section('content')

    <div class="container-fluid">

        <!-- Header -->
        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>
                <i class="fas fa-users-cog text-primary"></i>
                User Management
            </h2>

            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <i class="fas fa-user-plus"></i>
                Add User
            </a>

        </div>

        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">

                <i class="fas fa-check-circle"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>

            </div>
        @endif

        <!-- Card -->
        <div class="card shadow-sm">

            <div class="card-header bg-primary text-white">

                <h5 class="mb-0">
                    <i class="fas fa-list"></i>
                    Registered System Users
                </h5>

            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table id="usersTable" class="table table-bordered table-hover align-middle">

                        <thead class="table-light">

                            <tr>

                                <th width="60">#</th>

                                <th>Employee No.</th>

                                <th>Name</th>

                                <th>Email</th>

                                <th>Agency</th>

                                <th>Office</th>

                                <th>Position</th>

                                <th>Role</th>

                                <th>Status</th>

                                <th>Last Login</th>

                                <th width="180">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($users as $user)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>

                                    <td>

                                        <strong>
                                            {{ $user->employee_no }}
                                        </strong>

                                    </td>

                                    <td>

                                        {{ $user->name }}

                                        @if (Auth::id() == $user->id)
                                            <span class="badge bg-info ms-1">
                                                You
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        {{ $user->email }}

                                        @if ($user->email_verified_at)
                                            <span class="badge bg-success">
                                                Verified
                                            </span>
                                        @else
                                            <span class="badge bg-warning text-dark">
                                                Unverified
                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        {{ $user->agency }}

                                    </td>

                                    <td>

                                        {{ $user->office }}

                                    </td>

                                    <td>

                                        {{ $user->position }}

                                    </td>

                                    <td>

                                        @switch($user->role)
                                            @case('Administrator')
                                                <span class="badge bg-danger">
                                                    Administrator
                                                </span>
                                            @break

                                            @case('MEPCOM')
                                                <span class="badge bg-primary">
                                                    MEPCOM
                                                </span>
                                            @break

                                            @case('Inspector')
                                                <span class="badge bg-warning text-dark">
                                                    Inspector
                                                </span>
                                            @break

                                            @default
                                                <span class="badge bg-secondary">
                                                    Viewer
                                                </span>
                                        @endswitch

                                    </td>

                                    <td>

                                        @if ($user->status == 'Active')
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

                                        @if ($user->last_login)
                                          {{ \Carbon\Carbon::parse($user->last_login)->format('M d, Y h:i A') }} PHT
                                        @else
                                            <span class="text-muted">

                                                Never Logged In

                                            </span>
                                        @endif

                                    </td>

                                    <td>

                                        <div class="btn-group">

                                            <a href="{{ route('users.show', $user->id) }}" class="btn btn-info btn-sm">

                                                <i class="fas fa-eye"></i>

                                            </a>

                                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                            @if (Auth::id() != $user->id)
                                                <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    onsubmit="return confirm('Delete this user?')">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm">

                                                        <i class="fas fa-trash"></i>

                                                    </button>

                                                </form>
                                            @endif

                                        </div>

                                    </td>

                                </tr>

                                @empty

                                    <tr>

                                        <td colspan="11" class="text-center text-muted">

                                            No users found.

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


    @push('scripts')
        <script>
            $(function() {

                $('#usersTable').DataTable({

                    responsive: true,

                    autoWidth: false,

                    pageLength: 10,

                    order: [
                        [1, 'asc']
                    ],

                    language: {

                        search: "_INPUT_",

                        searchPlaceholder: "Search users..."

                    }

                });

            });
        </script>
    @endpush
