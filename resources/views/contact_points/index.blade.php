@extends('layouts.app')

@section('title', 'Contact Points')


@section('content')

    <div class="container-fluid">


        <div class="d-flex justify-content-between align-items-center mb-3">

            <h2>
                Contact Points
            </h2>


            <a href="{{ route('contact_points.create') }}" class="btn btn-primary">

                + Add Contact Point

            </a>


        </div>



        @if (session('success'))
            <div class="alert alert-success">

                {{ session('success') }}

            </div>
        @endif




        <div class="card">


            <div class="card-body">


                <table id="contactPointsTable" class="table table-bordered table-striped">


                    <thead class="table-dark">


                        <tr>

                            <th width="50">
                                #
                            </th>


                            <th>
                                Name
                            </th>


                            <th>
                                Position
                            </th>


                            <th>
                                Office
                            </th>


                            <th>
                                Contact Number
                            </th>


                            <th>
                                Email
                            </th>


                            <th width="180">
                                Action
                            </th>


                        </tr>


                    </thead>



                    <tbody>


                        @forelse($contactPoints as $contact)
                            <tr>


                                <td>
                                    {{ $loop->iteration }}
                                </td>


                                <td>
                                    {{ $contact->name }}
                                </td>


                                <td>
                                    {{ $contact->position }}
                                </td>


                                <td>
                                    {{ $contact->agency }}
                                </td>


                                <td>
                                    {{ $contact->telephone }}
                                </td>


                                <td>
                                    {{ $contact->email }}
                                </td>



                                <td>


                                    <a href="{{ route('contact_points.edit', $contact->id) }}"
                                        class="btn btn-warning btn-sm">

                                        <i class="bi bi-pencil"></i>
                                        Edit

                                    </a>




                                    <form action="{{ route('contact_points.destroy', $contact->id) }}" method="POST"
                                        class="d-inline">


                                        @csrf

                                        @method('DELETE')



                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Delete this contact point?')">


                                            <i class="bi bi-trash"></i>
                                            Delete


                                        </button>


                                    </form>



                                </td>


                            </tr>



                        @empty


                            <tr>

                                <td colspan="7" class="text-center">

                                    No contact points available.

                                </td>

                            </tr>
                        @endforelse



                    </tbody>



                </table>



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
        $(document).ready(function() {


            $('#contactPointsTable').DataTable({

                responsive: true,


                pageLength: 10,


                lengthMenu: [

                    [10, 25, 50, -1],

                    [10, 25, 50, "All"]

                ],


                order: [

                    [0, 'desc']

                ],


                language: {

                    search: "Search Contact Point:",

                    lengthMenu: "Show _MENU_ records"

                }


            });



        });
    </script>
@endpush
