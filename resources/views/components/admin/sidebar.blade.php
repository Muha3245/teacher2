<div id="sidebar-wrapper" class="shadow-sm">
    <div class="sidebar-heading text-center py-4">
        <div class="brand-logo mb-2">
            <i class="bi bi-mortarboard-fill fs-1 text-primary"></i>
        </div>
        <h5 class="fw-bold text-dark mb-0">{{ config('app.name', 'TeacherOn') }}</h5>
        <small class="text-muted fw-light text-uppercase tracking-wider" style="font-size: 0.65rem;">Admin Dashboard</small>
    </div>

    <div class="list-group list-group-flush sidebar-menu">
        <div class="menu-label text-muted small fw-bold px-4 mt-4 mb-2 text-uppercase">Main Menu</div>
        
        <a href="{{ route('admin') }}" class="list-group-item list-group-item-action {{ request()->routeIs('admin') ? 'active' : '' }}">
            <i class="bi bi-grid-1x2-fill me-3"></i> Dashboard
        </a>
        
        <a href="{{ route('admin.user.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/users*') ? 'active' : '' }}">
            <i class="bi bi-people-fill me-3"></i> Management Users
        </a>

        <div class="menu-label text-muted small fw-bold px-4 mt-4 mb-2 text-uppercase">Academic</div>

        <a href="{{ route('admin.teacher.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/teacher*') ? 'active' : '' }}">
            <i class="bi bi-person-badge-fill me-3"></i> Teacher Profiles
        </a>

        <a href="{{ route('admin.post.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/post*') ? 'active' : '' }}">
            <i class="bi bi-chat-quote-fill me-3"></i> Student Posts
        </a>
        <div class="menu-label text-muted small fw-bold px-4 mt-4 mb-2 text-uppercase">Connections</div>

        <a href="{{ route('admin.teacher.index') }}" class="list-group-item list-group-item-action {{ request()->is('admin/teacher*') ? 'active' : '' }}">
           <i class="bi bi-diagram-2"></i> connections
        </a>

        

        <div class="mt-auto mb-4">
            <hr class="mx-4 opacity-10">
            <a href="#" class="list-group-item list-group-item-action logout-link"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-left me-3"></i> Sign Out
            </a>
        </div>
    </div>

    <form id="logout-form" action="#" method="POST" class="d-none">
        @csrf
    </form>
</div>