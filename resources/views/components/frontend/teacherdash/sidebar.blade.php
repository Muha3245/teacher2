<nav id="sidebar">
    <div class="p-4 text-center">
        <h4 class="fw-bold text-primary"><i class="fa-solid fa-graduation-cap"></i> EduDash</h4>
    </div>
    <div class="nav flex-column">
        <a href="{{route('teacher.dashboard')}}" id="overview" class="nav-link {{ request()->routeIs('teacher.dashboard') ? 'active' : '' }}" data-ajax ><i class="fa-solid fa-house"></i> Overview</a>
        <a href="{{route('teacher.details')}}" id="myprofile" class="nav-link {{ request()->routeIs('teacher.details') ? 'active' : '' }}" data-ajax><i class="fa-solid fa-user"></i> My Profile</a>
        <a href="#" id="schedule" class="nav-link"><i class="fa-solid fa-calendar"></i> Schedule</a>
        <a href="#" id="messages" class="nav-link"><i class="fa-solid fa-comment-dots"></i> Messages</a>
        <hr class="mx-3">
        <a href="#" class="nav-link text-danger"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
    </div>
</nav>
