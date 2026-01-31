<div id="sidebar-wrapper">
    <div class="sidebar-heading text-center py-4 border-bottom">
        <h4 class="fw-bold text-white">{{ config('app.name') }}</h4>
    </div>

    <div class="list-group list-group-flush my-3 sidebar-menu">
        <a href="{{ route('admin') }}" class="list-group-item list-group-item-action active">
            <i class="bi bi-speedometer2 me-2"></i> Dashboard
        </a>
        <a href="{{ route('admin.user.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-people-fill me-2"></i> Users
        </a>
        <a href="{{ route('admin.teacher.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-tags-fill me-2"></i> Teacher profiles
        </a>
        <a href="{{ route('admin.post.index') }}" class="list-group-item list-group-item-action">
            <i class="bi bi-box-seam me-2"></i> Posts
        </a>

        <a href="#" class="list-group-item list-group-item-action text-danger mt-3"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
           <i class="bi bi-box-arrow-right me-2"></i> Logout
        </a>

        <form id="logout-form" action="#" method="POST" class="d-none">
            @csrf
        </form>
    </div>
</div>
