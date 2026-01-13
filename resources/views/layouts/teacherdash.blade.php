<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Portal | Dashboard</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
          rel="stylesheet">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/frontend/teacherdash.css') }}">
    @stack('frontendstyles')
</head>

<body>
    <!-- Page Loader -->
<div id="page-loader" class="page-loader d-none">
    <div class="spinner-border text-primary" role="status"></div>
</div>

<div id="wrapper">
    <x-frontend.teacherdash.sidebar />

    <div id="content-wrapper">
        <x-frontend.teacherdash.navbar />

        {{-- Dynamic Page Content --}}
        <div id="page-content">
            @yield('content')
        </div>
    </div>
</div>

<!-- JS Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Core Script -->
<script>
(function () {

    const loader = document.getElementById('page-loader');
    function showLoader() {
        loader.classList.remove('d-none');
    }

    function hideLoader() {
        loader.classList.add('d-none');
    }
    /* ------------------------------
       Sidebar Toggle
    ------------------------------ */
    document.getElementById('sidebarToggle')?.addEventListener('click', () => {
        document.getElementById('sidebar')?.classList.toggle('active');
    });

    /* ------------------------------
       Active Menu Handler
    ------------------------------ */
    function setActiveLink(url) {
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.toggle('active', link.href === url);
        });
    }

    /* ------------------------------
       AJAX Page Loader
    ------------------------------ */
    window.loadPage = function (url) {
        showLoader();
        fetch(url, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => {
            if (!res.ok) throw new Error('Network error');
            return res.text();
        })
        .then(html => {
            document.getElementById('page-content').innerHTML = html;
            window.history.pushState({}, '', url);
            setActiveLink(url);
        })
        .catch(() => {
            Swal.fire('Error', 'Unable to load page', 'error');
        })
        .finally(() => {
            hideLoader();
        });
    };

    /* ------------------------------
       Link Click Interceptor
    ------------------------------ */
    document.addEventListener('click', function (e) {
        const link = e.target.closest('a[data-ajax]');
        if (!link) return;

        e.preventDefault();
        loadPage(link.href);
    });

    /* ------------------------------
       Browser Back / Forward
    ------------------------------ */
    window.addEventListener('popstate', () => {
        loadPage(location.href);
    });

    /* ------------------------------
       Global SweetAlert Helpers
    ------------------------------ */
    window.toastSuccess = msg => {
        Swal.fire({
            toast: true,
            icon: 'success',
            title: msg,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    };

    window.toastError = msg => {
        Swal.fire({
            toast: true,
            icon: 'error',
            title: msg,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
    };

    

})();
</script>

@stack('frontendscripts')
</body>
</html>
