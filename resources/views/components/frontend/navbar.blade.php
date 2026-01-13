<nav class="navbar navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="bi bi-fan me-2"></i>DashboardPro
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Features</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Pricing</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            </ul>
        </div>
        @php
            $user = auth()->user();

            $profileImage = $user && $user->profile_picture ? asset($user->profile_picture) : null;

            $initial = $user ? strtoupper(substr($user->name, 0, 1)) : '';
        @endphp

        @if (auth()->check())
            <div class="d-none d-lg-flex align-items-center gap-3 position-relative">

                <!-- Avatar Button -->
                <div class="dropdown">
                    <button class="btn p-0 border-0 bg-transparent d-flex align-items-center gap-2"
                        data-bs-toggle="dropdown" aria-expanded="false">

                        <!-- Profile Image OR Name Avatar -->
                        @if ($profileImage)
                            <img src="{{ $profileImage }}" alt="Profile" class="rounded-circle" width="40"
                                height="40">
                        @else
                            <div class="rounded-circle  text-white d-flex align-items-center justify-content-center"
                                style="width:40px;height:40px;font-weight:600;background:#ea4c54;">
                                {{ $initial }}
                            </div>
                        @endif

                        <!-- User Name -->
                        <span class="fw-semibold text-dark">
                            {{ $user->name }}
                        </span>
                    </button>

                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li>
                            <a class="dropdown-item" href="{{route('teacher.dashboard')}}">
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">
                                Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        @else
            <div class="d-none d-lg-flex align-items-center gap-2">
                <a href="{{ route('loginpage') }}">
                    <button class="btn btn-nav-outline">Login</button>
                </a>
                <button class="btn btn-nav-primary">Sign Up Now</button>
            </div>
        @endif


    </div>
</nav>
