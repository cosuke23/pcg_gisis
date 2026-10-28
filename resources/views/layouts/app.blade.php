<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <title>
        @yield('title', 'PCG MEPIOS')
    </title>


    <!-- Bootstrap & App CSS / JS -->
    @include('partials.assets')


    <!-- Page Specific CSS -->
    @stack('styles')


</head>


<body>


    <div class="app-wrapper">


        <!-- Sidebar -->
        @include('partials.sidebar')



        <!-- Main Area -->
        <div class="main-wrapper">


            <!-- Header -->
            @include('partials.header')



            <!-- Page -->
            <main class="content-wrapper">

                @yield('content')

            </main>



            <!-- Footer -->
            @include('partials.footer')


        </div>


    </div>




    <!-- Page Specific Scripts -->
    @stack('scripts')


</body>

</html>
