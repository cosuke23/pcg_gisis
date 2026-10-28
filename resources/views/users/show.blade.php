@extends('layouts.app')

@section('title', 'User Details')

@section('content')

    <div class="container-fluid">

        <!-- Header -->

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>

                <i class="fas fa-user-circle text-info"></i>

                User Profile

            </h2>

            <div>

                <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">

                    <i class="fas fa-edit"></i>

                    Edit

                </a>

                <a href="{{ route('users.index') }}" class="btn btn-secondary">

                    <i class="fas fa-arrow-left"></i>

                    Back

                </a>

            </div>

        </div>

        <div class="row">

            <!-- Profile Card -->

            <div class="col-lg-4">

                <div class="card shadow-sm">

                    <div class="card-body text-center">

                        <div class="mb-3">

                            <i class="fas fa-user-circle text-primary" style="font-size:120px;"></i>

                        </div>

                        <h3 class="mb-1">

                            {{ $user->name }}

                        </h3>

                        <p class="text-muted">

                            {{ $user->position ?: 'No Position Assigned' }}

                        </p>

                        <hr>

                        <h5>

                            @switch($user->role)
                                @case('Administrator')
                                    <span class="badge bg-danger fs-6">

                                        Administrator

                                    </span>
                                @break

                                @case('MEPCOM')
                                    <span class="badge bg-primary fs-6">

                                        MEPCOM

                                    </span>
                                @break

                                @case('Inspector')
                                    <span class="badge bg-warning text-dark fs-6">

                                        Inspector

                                    </span>
                                @break

                                @default
                                    <span class="badge bg-secondary fs-6">

                                        Viewer

                                    </span>
                            @endswitch

                        </h5>

                        <br>

                        @if ($user->status == 'Active')
                            <span class="badge bg-success fs-6">

                                Active Account

                            </span>
                        @else
                            <span class="badge bg-danger fs-6">

                                Inactive Account

                            </span>
                        @endif

                    </div>

                </div>

            </div>

            <!-- Information Card -->

            <div class="col-lg-8">

                <div class="card shadow-sm">

                    <div class="card-header bg-primary text-white">

                        <h5 class="mb-0">

                            <i class="fas fa-id-card"></i>

                            User Information

                        </h5>

                    </div>

                    <div class="card-body">

                        <table class="table table-bordered">

                            <tbody>

                                <tr>

                                    <th width="220">

                                        Employee No.

                                    </th>

                                    <td>

                                        {{ $user->employee_no }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Full Name

                                    </th>

                                    <td>

                                        {{ $user->name }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Email Address

                                    </th>

                                    <td>

                                        {{ $user->email }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Email Verification

                                    </th>

                                    <td>

                                        @if ($user->email_verified_at)
                                            <span class="badge bg-success">

                                                Verified

                                            </span>

                                            <br>

                                            <small class="text-muted">

                                                {{ $user->email_verified_at->format('F d, Y h:i A') }}

                                            </small>
                                        @else
                                            <span class="badge bg-warning text-dark">

                                                Not Verified

                                            </span>
                                        @endif

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Agency

                                    </th>

                                    <td>

                                        {{ $user->agency }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Office

                                    </th>

                                    <td>

                                        {{ $user->office ?: '-' }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Position

                                    </th>

                                    <td>

                                        {{ $user->position ?: '-' }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Country

                                    </th>

                                    <td>

                                        {{ $user->country }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Last Login

                                    </th>

                                    <td>

                                        @if ($user->last_login)
                                            {{ $user->last_login->format('F d, Y h:i A') }}
                                        @else
                                            <span class="text-muted">

                                                Never Logged In

                                            </span>
                                        @endif

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Account Created

                                    </th>

                                    <td>

                                        {{ $user->created_at->format('F d, Y h:i A') }}

                                    </td>

                                </tr>

                                <tr>

                                    <th>

                                        Last Updated

                                    </th>

                                    <td>

                                        {{ $user->updated_at->format('F d, Y h:i A') }}

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
