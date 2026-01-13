<x-admin.header />

<body>

    <div id="wrapper">
        <!-- Sidebar -->
        <div id="sidebar-wrapper">
            <x-admin.sidebar />
        </div>
        <div id="page-content-wrapper" class="d-flex flex-column" style="min-height: 100vh;">
            <!-- Top Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom px-4">
                <button class="btn btn-primary" id="menu-toggle"><i id="menu-icon" class="bi bi-list"></i></button>
                <span class="navbar-brand ms-3">Admin Dashboard</span>
            </nav>

            <!-- Main Content -->
            <main class="flex-fill p-4">
                <!-- Toast Container -->
                <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1080">
                    @if (session('success'))
                        <div class="toast align-items-center text-white bg-success border-0 show" role="alert"
                            aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body">
                                    {{ session('success') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                    data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="toast align-items-center text-white bg-danger border-0 show mb-2" role="alert"
                                aria-live="assertive" aria-atomic="true">
                                <div class="d-flex">
                                    <div class="toast-body">
                                        {{ $error }}
                                    </div>
                                    <button type="button" class="btn-close btn-close-white me-2 m-auto"
                                        data-bs-dismiss="toast" aria-label="Close"></button>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                @yield('content')
            </main>

            <x-admin.footer />

        </div>
    </div>
    <x-admin.footer-script />

</body>

</html>
