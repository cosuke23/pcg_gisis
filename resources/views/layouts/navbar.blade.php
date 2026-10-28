<nav class="main-header navbar navbar-expand navbar-white navbar-light border-bottom">

    <!-- Left navbar -->
    <ul class="navbar-nav">

        <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="fas fa-bars"></i>
            </a>
        </li>

        <li class="nav-item d-flex align-items-center">

            <img src="{{ asset('images/pcg_logo.png') }}"
                 alt="PCG Logo"
                 style="height:40px;"
                 class="me-2">

            <div>

                <h5 class="mb-0 fw-bold text-primary">
                    PCG MEPIOS
                </h5>

                <small class="text-muted">
                    Marine Environmental Protection Integrated Operation System
                </small>

            </div>

        </li>

    </ul>

    <!-- Right navbar -->
    <ul class="navbar-nav ms-auto align-items-center">

        <li class="nav-item me-4">

            <span class="badge bg-primary p-2">
                Reporting Year : {{ date('Y') }}
            </span>

        </li>

        <li class="nav-item dropdown">

            <a class="nav-link" data-bs-toggle="dropdown" href="#">

                <i class="fas fa-user-circle fa-lg"></i>

                {{ Auth::user()->name }}

                <i class="fas fa-angle-down"></i>

            </a>

            <div class="dropdown-menu dropdown-menu-end">

                <span class="dropdown-item-text">

                    <strong>{{ Auth::user()->name }}</strong>

                    <br>

                    <small>{{ Auth::user()->role }}</small>

                </span>

                <div class="dropdown-divider"></div>

                <a href="{{ route('profile.edit') }}"
                   class="dropdown-item">

                    <i class="fas fa-user me-2"></i>

                    Profile

                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button class="dropdown-item">

                        <i class="fas fa-sign-out-alt me-2"></i>

                        Logout

                    </button>

                </form>

            </div>

        </li>

    </ul>

</nav>  