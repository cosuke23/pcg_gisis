@extends('layouts.app')


@section('content')
    <div class="container">


        <h2 class="mb-3">

            Edit Contact Point

        </h2>



        <div class="card">


            <div class="card-body">


                <form action="{{ route('contact_points.update', $contactPoint->id) }}" method="POST">


                    @csrf

                    @method('PUT')




                    <div class="mb-3">


                        <label>
                            Name
                        </label>

                        <input type="hidden" name="id" value="{{ $contactPoint->id }}" class="form-control" required>

                        <input type="text" name="name" value="{{ $contactPoint->name }}" class="form-control" required>


                    </div>





                    <div class="mb-3">


                        <label>
                            Position
                        </label>


                        <input type="text" name="position" value="{{ $contactPoint->position }}" class="form-control">


                    </div>






                    <div class="mb-3">


                        <label>
                            Office
                        </label>


                        <input type="text" name="office" value="{{ $contactPoint->agency }}" class="form-control">


                    </div>







                    <div class="mb-3">


                        <label>
                            Contact Number
                        </label>


                        <input type="text" name="contact_number" value="{{ $contactPoint->telephone }}"
                            class="form-control">


                    </div>







                    <div class="mb-3">


                        <label>
                            Email
                        </label>


                        <input type="email" name="email" value="{{ $contactPoint->email }}" class="form-control">


                    </div>





                    <button class="btn btn-primary">

                        Update

                    </button>


                    <a href="{{ route('contact_points.index') }}" class="btn btn-secondary">

                        Back

                    </a>




                </form>



            </div>


        </div>



    </div>
@endsection
