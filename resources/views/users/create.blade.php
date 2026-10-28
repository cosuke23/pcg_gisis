@extends('layouts.app')

@section('title', 'Create User')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>
                <i class="fas fa-user-plus text-success"></i>
                Create User
            </h2>

            <a href="{{ route('users.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i>
                Back
            </a>

        </div>

        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <form action="{{ route('users.store') }}" method="POST">

            @csrf

            @include('users._form')

            <div class="text-end mt-3">

                <button class="btn btn-success">

                    <i class="fas fa-save"></i>

                    Save User

                </button>

            </div>

        </form>

    </div>

@endsection
