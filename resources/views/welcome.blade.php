@extends('layouts.frontend')
@push('frontendstyles')
@endpush
@section('content')
    <x-frontend.navbar />

    @php
        $teacherprofile = TeacherProfile();
        $teachersubjects = TeacherSubjects();
    @endphp

    {{-- hero-section --}}
    <section class="hero-section">
        <div class="background-elements">
            <div class="central-glow"></div>
            <div class="floating-shape-1"></div>
            <div class="floating-shape-2"></div>
            <div class="grid-overlay"></div>
        </div>
        <div class="layout-container">
            <div class="main-content">
                <div class="headlines">
                    <h1>
                        Connect with the Right Teacher.<br />
                        <span class="highlight">Learn Smarter. Teach Better.</span>
                    </h1>
                    <p>
                        Join the fastest-growing community of learners and educators. Master any subject, anytime, anywhere.
                    </p>
                </div>
                <div class="search-component">
                    <form action="{{ route('search.teachers') }}" method="GET" class="search-form">
                        <div class="form-group">
                            <div class="form-icon">
                                <span class="material-symbols-outlined">search</span>
                            </div>
                            <select name="subject" class="select-input">
                                <option value="">Select Subject</option>

                                @foreach ($teachersubjects as $subject)
                                    <option value="{{ $subject->subject->name }}"
                                        {{ request('subject') == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->subject->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="select-icon">
                                <span class="material-symbols-outlined">expand_more</span>
                            </div>
                        </div>
                        <div class="divider"></div>
                        <div class="form-group">
                            <div class="form-icon">
                                <span class="material-symbols-outlined">location_on</span>
                            </div>
                            <input class="form-input" name="location" placeholder="Zip Code or Online" type="text" />
                        </div>

                        <button class="search-button" type="submit">
                            <span>Search</span>
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </form>
                </div>
                <div class="stats-row">
                    <div class="stat-item">
                        <div class="stat-icon">
                            <span class="material-symbols-outlined" style="color: #4ade80;">check_circle</span>
                        </div>
                        <div class="stat-text">
                            <span class="stat-number">12k+</span>
                            <span class="stat-label">Active Teachers</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <span class="material-symbols-outlined" style="color: #60a5fa;">groups</span>
                        </div>
                        <div class="stat-text">
                            <span class="stat-number">85k+</span>
                            <span class="stat-label">Students Enrolled</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon">
                            <span class="material-symbols-outlined" style="color: #a78bfa;">library_books</span>
                        </div>
                        <div class="stat-text">
                            <span class="stat-number">150+</span>
                            <span class="stat-label">Subjects Covered</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="bottom-gradient"></div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works-section">
        <div class="background-decorations">
            <div class="blob-1"></div>
            <div class="blob-2"></div>
            <div class="blob-3"></div>
        </div>
        <div class="content-container">
            <div class="section-header">
                <h2 class="subtitle">How It Works</h2>
                <h1 class="title">Simple Steps to Learning Success</h1>
                <p>
                    Our platform makes it easy to connect and start learning. Follow this simple process to find your
                    perfect match.
                </p>
            </div>
            <div class="steps-container">
                <div class="connecting-arrows">
                    <div class="arrows-wrapper">
                        <div class="arrow-spacer"></div>
                        <div class="arrow-container arrow-container-1">
                            <svg class="arrow-svg" fill="none" viewbox="0 0 200 40" xmlns="http://www.w3.org/2000/svg">
                                <path class="animate-dash" d="M10 20C50 20 50 10 90 10C130 10 130 30 190 30"
                                    stroke="currentColor" stroke-dasharray="6 6" stroke-linecap="round" stroke-width="2">
                                </path>
                                <path d="M185 25L190 30L185 35" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <div class="arrow-spacer"></div>
                        <div class="arrow-container arrow-container-2">
                            <svg class="arrow-svg" fill="none" viewbox="0 0 200 40" xmlns="http://www.w3.org/2000/svg">
                                <path class="animate-dash" d="M10 20C50 20 50 30 90 30C130 30 130 10 190 10"
                                    stroke="currentColor" stroke-dasharray="6 6" stroke-linecap="round" stroke-width="2">
                                </path>
                                <path d="M185 5L190 10L185 15" stroke="currentColor" stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2"></path>
                            </svg>
                        </div>
                        <div class="arrow-spacer"></div>
                    </div>
                </div>
                <div class="cards-grid">
                    <div class="glass-card" style="animation-delay: 0.1s;">
                        <div class="card-icon-container">
                            <div class="card-icon-wrapper">
                                <span class="material-symbols-outlined card-icon">person_add</span>
                            </div>
                            <div class="step-number">1</div>
                        </div>
                        <div class="card-text-container">
                            <h3 class="card-title">Teacher creates profile</h3>
                            <p class="card-description">
                                Educators list their skills, experience, and availability to showcase their teaching
                                style.
                            </p>
                        </div>
                    </div>
                    <div class="glass-card" style="animation-delay: 0.2s;">
                        <div class="card-icon-container">
                            <div class="card-icon-wrapper">
                                <span class="material-symbols-outlined card-icon">post_add</span>
                            </div>
                            <div class="step-number">2</div>
                        </div>
                        <div class="card-text-container">
                            <h3 class="card-title">Student posts requirement</h3>
                            <p class="card-description">
                                Students describe what they need help with, their preferred schedule, and budget.
                            </p>
                        </div>
                    </div>
                    <div class="glass-card" style="animation-delay: 0.3s;">
                        <div class="card-icon-container">
                            <div class="card-icon-wrapper">
                                <span class="material-symbols-outlined card-icon">handshake</span>
                            </div>
                            <div class="step-number">3</div>
                        </div>
                        <div class="card-text-container">
                            <h3 class="card-title">Match &amp; connect</h3>
                            <p class="card-description">
                                Our intelligent algorithm finds the perfect pair for a successful and engaging lesson.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="cta-button-container">
                <button class="cta-button">
                    <span>Get Started Now</span>
                    <span class="material-symbols-outlined arrow-icon">arrow_forward</span>
                </button>
            </div>
        </div>
    </section>

    {{-- Teacher and teacher jobs --}}

    <section class="teacher-jobs">
        <div class="layout-container">
            <div class="left-section">
                <div class="section-header">
                    <h1 class="title">
                        Teachers
                    </h1>
                </div>
                <div class="grid">
                    <button><a href="{{ route('teachersposts') }}"
                            style="list-style: none;text-decoration:none; color:black;">Teacher</a></button>
                    <button data-type="online">Online Teachers</button>
                    <button data-type="home">Home Teachers</button>
                    <button data-type="assignment">Assignment Help</button>
                </div>
            </div>
            <div class="right-section">
                <div class="section-header">
                    <h1 class="title">
                        Teachers jobs
                    </h1>
                </div>
                <div class="grid">
                    <button><a href="{{ route('studentposts') }}"
                            style="list-style: none;text-decoration:none; color:black;">Teacher jobs</a></button>
                    <button>Online Teacheing</button>
                    <button>Home Teacheing</button>
                    <button>Assignment jobbs</button>
                </div>
            </div>
    </section>
    <!-- Features Section -->
    <section class="features-section">
        <div class="layout-container">
            <div class="section-header">
                <h1 class="title">
                    Empowering Your Learning Journey
                </h1>
                <p>
                    Discover why thousands of students and teachers choose our platform for their
                    educational needs.
                </p>
            </div>
            <div class="grid">
                <div class="card">
                    <div class="card-icon-wrapper">
                        <div class="ripple-animation"></div>
                        <span class="material-symbols-outlined card-icon">verified_user</span>
                    </div>
                    <div class="card-text">
                        <h2 class="card-title">Verified Teachers</h2>
                        <p class="card-description">Every
                            educator is vetted for quality and safety to ensure a premium learning
                            experience.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon-wrapper">
                        <div class="ripple-animation" style="animation-delay: 0.2s;"></div>
                        <span class="material-symbols-outlined card-icon">psychology</span>
                    </div>
                    <div class="card-text">
                        <h2 class="card-title">Smart Matching</h2>
                        <p class="card-description">Our
                            AI-driven algorithm connects you with the perfect tutor based on your unique
                            learning style.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon-wrapper">
                        <div class="ripple-animation" style="animation-delay: 0.4s;"></div>
                        <span class="material-symbols-outlined card-icon">calendar_month</span>
                    </div>
                    <div class="card-text">
                        <h2 class="card-title">Flexible
                            Scheduling</h2>
                        <p class="card-description">Book lessons
                            that fit your busy life with our easy-to-use dynamic calendar system.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon-wrapper">
                        <div class="ripple-animation" style="animation-delay: 0.6s;"></div>
                        <span class="material-symbols-outlined card-icon">security</span>
                    </div>
                    <div class="card-text">
                        <h2 class="card-title">Secure Payments</h2>
                        <p class="card-description">Transactions
                            are protected with bank-level security protocols for your peace of mind.</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon-wrapper">
                        <div class="ripple-animation" style="animation-delay: 0.8s;"></div>
                        <span class="material-symbols-outlined card-icon">video_camera_front</span>
                    </div>
                    <div class="card-text">
                        <h2 class="card-title">
                            Interactive Classroom</h2>
                        <p class="card-description">Built-in
                            high definition video tools and whiteboards make remote learning feel seamless.
                        </p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-icon-wrapper">
                        <div class="ripple-animation" style="animation-delay: 1s;"></div>
                        <span class="material-symbols-outlined card-icon">monitoring</span>
                    </div>
                    <div class="card-text">
                        <h2 class="card-title">Progress
                            Tracking</h2>
                        <p class="card-description">Monitor your
                            improvement over time with detailed analytics and regular feedback reports.</p>
                    </div>
                </div>
            </div>
            <div class="bottom-cta">
                <button class="cta-button">
                    <span class="truncate">Get Started Now</span>
                </button>
            </div>
        </div>
    </section>

    <!-- Teacher Showcase Section -->
    <section class="teacher-showcase-section">
        <div class="main-container">
            <!-- Page Heading -->
            <div class="page-heading">
                <div class="heading-text">
                    <h1 class="heading-title">Expert Tutors Ready to Help</h1>
                    <p class="heading-subtitle">
                        Browse our highest-rated educators and book your first lesson today.
                        From quantum physics to classical piano, learn from the best.
                    </p>
                </div>
                <!-- Navigation Controls -->
                <div class="carousel-nav">
                    <button id="prev-button" class="nav-button">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </button>
                    <button id="next-button" class="nav-button active">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </div>
            </div>
            <!-- Carousel Section -->
            <div class="carousel-container no-scrollbar">
                <div class="carousel">

                    @foreach ($teacherprofile as $teacher)
                        <a href="{{ route('teacher.profile', $teacher->id) }}"
                            style="list-style: none; text-decoration: none;">
                            <div class="custom-card">

                                {{-- Avatar --}}
                                <img class="card-avatar" src="{{ $teacher->profile_picture }}"
                                    alt="{{ $teacher->full_name }}"
                                    onerror="this.onerror=null;this.src='https://randomuser.me/api/portraits/{{ rand(0, 1) ? 'men' : 'women' }}/{{ rand(1, 99) }}.jpg';">

                                {{-- Full headline (title = no limit) --}}
                                <h4 class="card-title" title="{{ $teacher->full_name }}">
                                    {{ $teacher->full_name }}
                                </h4>

                                {{-- Subjects (dynamic) --}}
                                <div class="card-meta">
                                    @foreach ($teacher->subjects->take(3) as $sub)
                                        <span class="badge">{{ $sub->subject->name ?? '' }}</span>
                                    @endforeach
                                </div>

                                {{-- Education --}}
                                <div class="card-meta">
                                    <span class="material-symbols-outlined">school</span>
                                    <span>
                                        {{ $teacher->educations->first()->education?->degree ?? 'Expert' }}
                                    </span>
                                </div>

                                {{-- Description (SAME length for all cards) --}}
                                <p class="card-text">
                                    {{ \Illuminate\Support\Str::limit(
                                        strip_tags($teacher->headline ?? 'Experienced professional tutor providing high-quality learning sessions.'),
                                        110,
                                    ) }}
                                </p>

                                {{-- Rating --}}
                                <div class="rating-stars text-warning">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>

                            </div>
                        </a>
                    @endforeach

                </div>
            </div>


        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="cta-wrapper">
            <div class="cta-container">
                <div class="cta-card">

                    <div class="cta-content">
                        <!-- LEFT -->
                        <div class="cta-left">
                            <div class="cta-text">
                                <h1>
                                    Ready to Teach or
                                    <span class="highlight">
                                        Learn Smarter?
                                        <svg viewBox="0 0 100 10" preserveAspectRatio="none">
                                            <path d="M0 5 Q 50 10 100 5"></path>
                                        </svg>
                                    </span>
                                </h1>

                                <p>
                                    Join thousands of educators and eager students on the world's
                                    most intuitive learning platform. Start your journey today.
                                </p>
                            </div>

                            <div class="cta-buttons">
                                <button class="btn btn-primary">
                                    <span class="material-symbols-outlined">school</span>
                                    Join as Teacher
                                </button>

                                <button class="btn btn-outline">
                                    <span class="material-symbols-outlined">local_library</span>
                                    Join as Student
                                </button>
                            </div>

                            <div class="cta-users">
                                <div class="avatars">
                                    <img
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuB5UV-oH4E1oSQHAjfvpDVNab10ghJZRnC5qIVCIlCX-gYfH-WHyFC2SHGOr_Y9MHvadCUrIgtWBv7XdKiwZgORA9r2-Kij1F5XTtA6xyH3NY9TZukPE8kMGTCyAKvckWOKBY-mH_GZ2JNu7IpRON5CuRH1c0err8rG4bWEpx1yj_YrK9dPR8TKgVAiU4sydS1kY2eNXUpP8edh4oF2rWJ1ZPo2iiUuuKlT46WGo6L4iHXRuNNK1J2zwVkA9Mm1mKi0INQcofaJbpO2">
                                    <img
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAMCUxMzmPw2kz6asWk3U8NYcX6tGTOW0an9TN29UfOl04xxFgFKeMCcbCtMSx3gWNYMNAls2ZinH3If6WbmxV3nCp5fjh_VUZ-0M2NUJTYC5js91qCmW4wP8ZDkz_XppKzUSMo5Eg44rO9y_fCNX-OmnXrFmfK8MRr2nHI_HMIJZpHhIgIMQlyhKHjS6UxN28BhYhd8XE-9xL0GSYx9B7GvojMZsZwNALdP4Kt9TYiOmG5npcCG0nth_F4k0Kl3mRRc7NziFZufUfe">
                                    <img
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDyEee0L-nPEs1PCf_IjNfIjeJFboBHzc0zKoRDoIiMCIfmEmouByEnjqonwkOLcIo6xVzIwJ9tJIYViOPCi9FASiqvK-PLa0SYw_MOXXDnnsxFbYiA_vQ4fcvw5hOynq2TbwFZhDftGwbwkj2X3951Tag4d76i6jRIGhyGC6KmYMZURH7W8Cgbd-sGwcyq0hMgmCaLb4DyPaT2NAQIUOZaW4wbr7a72e6Ehssq1J12XVmpkwLLh4cNBFsM3ctVfZiDoyxmySN0b2DA">
                                </div>
                                <span>Join 10,000+ users</span>
                            </div>
                        </div>

                        <!-- RIGHT -->
                        <div class="cta-right">
                            <div class="cta-blob"></div>

                            <div class="cta-image"></div>

                            <div class="cta-badge badge-success">
                                <span class="material-symbols-outlined">check_circle</span>
                                <div>
                                    <small>Success Rate</small>
                                    <strong>98%</strong>
                                </div>
                            </div>

                            <div class="cta-badge badge-certified">
                                <span class="material-symbols-outlined">verified</span>
                                <div>
                                    <strong>Certified</strong>
                                    <small>Tutors</small>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
@push('frontendscripts')
    <script>
        const swiper = new Swiper(".mySwiper", {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: true,
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                768: {
                    slidesPerView: 2,
                },
                992: {
                    slidesPerView: 2,
                },
                1200: {
                    slidesPerView: 2,
                },
            },
        });
    </script>
    <script>
        // gsap.from(".features-section .card", {
        //     opacity: 1,
        //     y: 40,
        //     duration: 0.8,
        //     stagger: 0.15
        // });
    </script>
@endpush
