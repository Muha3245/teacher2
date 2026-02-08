@php
    $user = auth()->user();
    $profileImage = $user && $user->profile_picture ? asset($user->profile_picture) : null;
    $initial = $user ? strtoupper(substr($user->name, 0, 1)) : '';

    $notifications = auth()->user()->unreadNotifications ?? '';
@endphp

<nav class="navbar navbar-expand-lg sticky-top bg-white shadow-sm" style="height:100px; z-index:999;">
    <div class="container">

        <!-- Logo -->
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <i class="bi bi-fan me-2"></i>EduTech
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Center Menu -->
        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
            <ul class="navbar-nav gap-2">
                <li class="nav-item"><a class="nav-link fw-semibold" href="{{ url('/') }}">Home</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">Features</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">Pricing</a></li>
                <li class="nav-item"><a class="nav-link fw-semibold" href="#">Contact</a></li>
            </ul>
        </div>

        @if (auth()->check())
            <!-- Right Side -->
            <div class="d-none d-lg-flex align-items-center gap-4">

                <!-- 🔔 Notifications -->
                <div class="dropdown position-relative">
                    <button class="btn p-0 border-0 bg-transparent position-relative" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="bi bi-bell fs-5"></i>
                        @php
                            $unseenCount = $notifications->count();

                        @endphp
                        @if ($unseenCount > 0)
                            <span
                                class="position-absolute text-white top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $unseenCount }}
                            </span>
                        @endif
                    </button>

                    <!-- Dropdown Menu -->
                    <ul class="dropdown-menu dropdown-menu-end shadow p-0" style="width:350px;">
                        <li class="dropdown-header fw-semibold px-3 py-2">Notifications</li>

                        @forelse($notifications as $notification)
                            <li>
                                <a class="dropdown-item d-flex gap-3 py-2"
                                    href="{{ route('student.post.show', [
                                        'id' => $notification->data['post_id'],
                                        'nid' => $notification->id,
                                    ]) }}">

                                    <i class="bi bi-chat-dots text-primary fs-5"></i>

                                    <div>
                                        <div class="fw-semibold">
                                            {{ $notification->data['message'] }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $notification->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                </a>
                            </li>
                        @empty

                            <li>
                                <div class="text-center text-muted py-2">No new notifications</div>
                            </li>
                        @endforelse

                        <li>
                            <hr class="dropdown-divider m-0">
                        </li>
                        <li>
                            <a class="dropdown-item text-center fw-semibold text-primary" href="#">
                                View all notifications
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- 👤 User Menu -->
                <div class="dropdown">
                    <button class="btn p-0 border-0 bg-transparent d-flex align-items-center gap-2"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        @if ($profileImage)
                            <img src="{{ $profileImage }}" class="rounded-circle" width="40" height="40">
                        @else
                            <div class="rounded-circle text-white d-flex align-items-center justify-content-center"
                                style="width:40px;height:40px;background:#ea4c54;font-weight:600;">
                                {{ $initial }}
                            </div>
                        @endif
                        <span class="fw-semibold">{{ $user->name }}</span>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li><a class="dropdown-item" href="{{ route('teacher.dashboard') }}">Teacher Dashboard</a></li>
                        <li><a class="dropdown-item" href="{{ route('user.dashboard') }}">User Dashboard</a></li>
                        <li><a class="dropdown-item" href="#">Profile</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form action="{{ route('auth.logout') }}" method="POST">
                                @csrf
                                <button class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        @else
            <!-- Guest Buttons -->
            <div class="d-none d-lg-flex gap-2">
                <a href="{{ route('loginpage') }}" class="btn btn-outline-primary">Login</a>
                <a href="#" class="btn btn-primary">Sign Up Now</a>
            </div>
        @endif

    </div>
</nav>
