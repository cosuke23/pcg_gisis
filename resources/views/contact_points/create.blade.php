@extends('layouts.app')


@section('content')
    <div class="container">


        <h2 class="mb-3">
            Add Contact Point
        </h2>



        <div class="card">

            <div class="card-body">


                <form action="{{ route('contact_points.store') }}" method="POST">


                    @csrf



                    <div class="mb-3">

                        <label>
                            Name
                        </label>

                        <input type="text" name="name" class="form-control" required>

                    </div>



                    <div class="mb-3">

                        <label>
                            Position
                        </label>


                        <input type="text" name="position" class="form-control">


                    </div>



                    <div class="mb-3">

                        <label>
                            Office
                        </label>


                        <input type="text" name="office" class="form-control">


                    </div>




                    <div class="mb-3">

                        <label>
                            Contact Number
                        </label>


                        <input type="text" name="telephone" class="form-control">


                    </div>



                    <div class="mb-3">

                        <label>
                            Email
                        </label>


                        <input type="email" name="email" class="form-control">


                    </div>





                    <button class="btn btn-success">

                        Save

                    </button>


                    <a href="{{ route('contact_points.index') }}" class="btn btn-secondary">

                        Back

                    </a>



                </form>



            </div>


        </div>



    </div>
@endsection
