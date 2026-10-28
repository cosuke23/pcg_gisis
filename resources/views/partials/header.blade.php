<header class="header">

    <div class="header-left">

        <button id="sidebarToggle" class="btn btn-light">

            <i class="fas fa-bars"></i>

        </button>

        <div class="ms-3">

            <h4 class="mb-0">

                Marine Environmental Protection Integrated Operation System

            </h4>

            <small>

                Philippine Coast Guard

            </small>

        </div>

    </div>

    <div class="header-right">

        <span class="me-3">

            {{ Auth::user()->name }}

        </span>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="btn btn-danger btn-sm">

                Logout

            </button>

        </form>

    </div>

</header>
