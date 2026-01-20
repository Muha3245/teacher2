@extends('layouts.frontend')
@push('frontendstyles')
    <style>
        /* --- Teacher Section Navigation --- */
        .teacher-section-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            margin-bottom: 2rem;
        }

        .teacher-nav-buttons {
            display: flex;
            gap: 10px;
            position: relative;
        }

        /* Reset Swiper Default Absolute Position */
        .teacher-nav-buttons .swiper-button-next,
        .teacher-nav-buttons .swiper-button-prev {
            position: static;
            width: 40px;
            height: 40px;
            margin: 0;
            background-color: #fff;
            color: #6366f1;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .teacher-nav-buttons .swiper-button-next:after,
        .teacher-nav-buttons .swiper-button-prev:after {
            font-size: 16px;
            /* Smaller, cleaner arrows */
            font-weight: bold;
        }

        .teacher-nav-buttons .swiper-button-next:hover,
        .teacher-nav-buttons .swiper-button-prev:hover {
            background-color: #6366f1;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
        }

        /* --- Beautiful Testimonial Style Card --- */
        .teacher-card {
            background: #ffffff;
            border-radius: 20px;
            padding: 30px 20px;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            border: 1px solid #f0f0f0;
            height: 100%;
            margin: 10px 5px;
            /* Space for box-shadow */
        }

        .teacher-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
            border-color: transparent;
        }

        .teacher-avatar-wrapper {
            position: relative;
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
        }

        .teacher-avatar-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .teacher-card .quote-icon {
            position: absolute;
            bottom: 0;
            right: 0;
            background: #6366f1;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            border: 3px solid #fff;
        }

        .teacher-card h4 {
            color: #1f2937;
            font-size: 1.25rem;
            margin-bottom: 5px;
        }

        .teacher-card .headline {
            color: #6366f1;
            font-weight: 500;
            font-size: 0.9rem;
            margin-bottom: 15px;
        }

        .teacher-card .subjects-tags .badge {
            background: #f3f4f6;
            color: #4b5563;
            font-weight: 500;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 0.75rem;
        }

        .teacher-card .view-profile-btn {
            margin-top: 20px;
            border-radius: 12px;
            font-weight: 600;
            padding: 10px 25px;
            background: #f3f4f6;
            color: #1f2937;
            border: none;
            transition: 0.3s;
        }

        .teacher-card:hover .view-profile-btn {
            background: #6366f1;
            color: #fff;
        }

        .search-bar-wrapper {
            width: 100%;
            max-width: 700px;
        }

        .search-bar {
            display: flex;
            align-items: center;
            background: #ffffff;
            border-radius: 999px;
            border: 1px solid #e5e7eb;
            padding: 6px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .search-input {
            border: none;
            outline: none;
            padding: 14px 16px;
            font-size: 0.95rem;
            width: 100%;
            background: transparent;
        }

        .search-input.left {
            border-radius: 999px 0 0 999px;
        }

        .search-input.right {
            border-radius: 0 999px 999px 0;
        }

        .search-input::placeholder {
            color: #9ca3af;
        }

        .divider {
            color: #cbd5e1;
            font-weight: 500;
            user-select: none;
        }

        .search-btn {
            background: #4f46e5;
            border: none;
            color: white;
            padding: 12px 18px;
            border-radius: 999px;
            margin-left: 6px;
            cursor: pointer;
            transition: 0.2s;
        }

        .search-btn:hover {
            background: #4338ca;
        }
    </style>
@endpush
@section('content')
    <x-frontend.navbar />

    @php
        $teacherprofile = TeacherProfile();
        $teachersubjects = TeacherSubjects();
    @endphp

    
    <header class="hero-section">

        <div class="bg-shape bg-shape-1"></div>
        <div class="bg-shape bg-shape-2"></div>
        <div class="bg-shape bg-shape-3"></div>
        <div class="bg-shape bg-shape-4"></div>

        <div class="decoration dec-arrow"><i class="bi bi-cursor-fill"></i></div>
        <div class="decoration dec-donut"></div>
        <div class="decoration dec-star"><i class="bi bi-star-fill"></i></div>
        <div class="decoration dec-dot-small-blue"></div>
        <div class="container">
            <h1 class="hero-title">Build Your Modern Dashboard<br>Quickly and Easily</h1>
            <p class="hero-subtitle">
                Organize your projects, track your progress, and collaborate with your team efficiently.<br>
                Everything you need for smooth workflow and insightful analytics in one place.
            </p>
            <div class="d-flex justify-content-center">
                {{-- <button class="btn btn-hero-primary">Get Started</button>
                <button class="btn btn-hero-outline">Learn More</button> --}}
                <form action="{{ route('search.teachers') }}" method="GET" class="search-bar-wrapper">
                    <div class="search-bar">
                        <select name="subject" class="search-input left">
                            <option value="">Select Subject</option>

                            @foreach($teachersubjects as $subject)
                                <option value="{{ $subject->subject->name }}"
                                    {{ request('subject') == $subject->id ? 'selected' : '' }}>
                                    {{ $subject->subject->name }}
                                </option>
                            @endforeach
                        </select>

                        <span class="divider">|</span>

                        <input type="text" name="location" class="search-input right" placeholder="Search location"
                            value="{{ request('location') }}">

                        <button type="submit" class="search-btn">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>

            </div>
        </div>
        <div class="decoration dec-dot-big-pink"></div>
        <div class="decoration dec-stamp-lock">
            <div class="lock-text">MODESTYOM<br>URE<br><i class="bi bi-lock"></i></div>
        </div>
        <div class="decoration dec-squiggle"><i class="bi bi-bezier2"></i></div>


    </header>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="section-header">
                <span class="section-tag">FEATURES</span>
                <h2 class="section-title">Powerful Dashboard Features</h2>
                <p class="text-muted small mt-2">Everything you need to manage your team and projects efficiently.</p>
            </div>

            <div class="row g-4">
                <div class="col-md-4">
                    <div class="custom-card">
                        <div class="card-icon-box">
                            <i class="bi bi-buildings text-dark"></i>
                        </div>
                        <h4 class="card-title">Project Management</h4>
                        <p class="card-text">Track your tasks, deadlines, and team progress with intuitive tools.</p>
                        <div class="rating-stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-card">
                        <div class="card-icon-box">
                            <i class="bi bi-motherboard text-danger"></i>
                        </div>
                        <h4 class="card-title">Analytics Dashboard</h4>
                        <p class="card-text">Visualize your data with charts and reports for better decision-making.</p>
                        <div class="rating-stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-card">
                        <div class="card-icon-box">
                            <i class="bi bi-diagram-3 text-dark"></i>
                        </div>
                        <h4 class="card-title">Team Collaboration</h4>
                        <p class="card-text">Communicate and collaborate with your team efficiently in real-time.</p>
                        <div class="rating-stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Teacher profile --}}
    <section class="py-5 bg-light position-relative">
        <div class="container">

            {{-- Header with Integrated Arrows --}}
            <div class="teacher-section-header">
                <div class="header-text">
                    <span class="text-indigo-600 fw-bold text-uppercase tracking-widest small">Our Teachers</span>
                    <h2 class="display-6 fw-bold mt-1">Meet Our Expert Teachers</h2>
                </div>

                <div class="teacher-nav-buttons d-none d-md-flex">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

            <div class="swiper teacherSwiper">
                <div class="swiper-wrapper">
                    @foreach ($teacherprofile as $teacher)
                        <div class="swiper-slide">
                            <div class="teacher-card text-center">
                                {{-- Profile Picture --}}
                                <div class="teacher-avatar-wrapper">
                                    
                                    {{-- <img src="https://randomuser.me/api/portraits/{{ rand(0, 1) == 0 ? 'men' : 'women' }}/{{ rand(1, 99) }}.jpg"
                                        alt="{{ $teacher->full_name }}"> --}}
                                    <img src="{{ $teacher->profile_picture }}" alt="{{ $teacher->full_name }}"
                                    onerror="this.onerror=null;this.src='https://randomuser.me/api/portraits/{{ rand(0, 1) == 0 ? 'men' : 'women' }}/{{ rand(1, 99) }}.jpg';">
                                    <div class="quote-icon">
                                        <i class="bi bi-patch-check-fill"></i>
                                    </div>
                                </div>

                                {{-- Info --}}
                                <h4>{{ $teacher->full_name }}</h4>
                                <p class="headline">{{ $teacher->headline }}</p>

                                {{-- Subjects --}}
                                <div class="subjects-tags d-flex flex-wrap justify-content-center gap-2 mb-3">
                                    @foreach ($teacher->subjects as $sub)
                                        <span class="badge">{{ $sub->subject->name ?? '' }}</span>
                                    @endforeach
                                </div>

                                {{-- Education --}}
                                @if ($teacher->educations->count())
                                    <p class="text-muted small mb-0">
                                        <i class="bi bi-mortarboard-fill me-1"></i>
                                        {{ $teacher->educations->first()->education?->degree ?? 'Expert' }}
                                    </p>
                                @endif

                                <a href="#" class="btn view-profile-btn">View Profile</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Mobile Pagination --}}
                <div class="swiper-pagination d-md-none mt-4"></div>
            </div>
        </div>
    </section>



    <section class="py-5" style="background-color: #fafafa;">
        <div class="container">
            <div class="section-header pt-5">
                <span class="section-tag">TESTIMONIALS</span>
                <h2 class="section-title">What Our Users Say</h2>
                <p class="text-muted small mt-2">Real feedback from customers who improved their workflow using our
                    dashboard.</p>
            </div>

            <div class="row g-4 pb-5">
                <div class="col-md-4">
                    <div class="custom-card">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Avatar" class="card-avatar">
                        <h4 class="card-title">Jane Doe</h4>
                        <p class="card-text">This dashboard improved our team collaboration and task management
                            significantly.</p>
                        <div class="rating-stars text-warning">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-card">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Avatar" class="card-avatar">
                        <h4 class="card-title">John Smith</h4>
                        <p class="card-text">Easy-to-use and intuitive design. Analytics help us make better decisions.
                        </p>
                        <div class="rating-stars text-warning">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="custom-card">
                        <img src="https://randomuser.me/api/portraits/men/86.jpg" alt="Avatar" class="card-avatar">
                        <h4 class="card-title">Michael Lee</h4>
                        <p class="card-text">Our workflow is now organized, and team communication is seamless.</p>
                        <div class="rating-stars text-warning">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-5 bg-white">
        <div class="container">
            <div class="section-header text-center">
                <span class="section-tag">TRENDING</span>
                <h2 class="section-title">Trending Categories</h2>
                <p class="text-muted mt-2">Popular categories based on user engagement</p>
            </div>

            <div class="row align-items-center">
                <div class="col-md-4">
                    <h3 class="fw-bold">Productivity Tools</h3>
                    <p class="text-muted small">Best tools to boost your team's efficiency and output.</p>
                    <p class="text-muted small mt-4">Includes project trackers, communication platforms, and scheduling
                        apps.</p>
                </div>

                <div class="col-md-8">
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">

                            <div class="swiper-slide">
                                <div class="testimonial-grid-card" style="background-color: #fff5f5;">
                                    <div class="user-mini">
                                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="">
                                        <div>
                                            <h6 class="mb-0 fw-bold">Rachel</h6>
                                            <small class="text-muted" style="font-size: 0.7rem;">Manager</small>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled mt-3 small text-muted">
                                        <li class="mb-2"><i class="bi bi-dot"></i> Experience: 5 years</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> Certified Professional</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> Total Revenue: $500</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="testimonial-grid-card" style="background-color: #eff5ff;">
                                    <div class="user-mini">
                                        <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="">
                                        <div>
                                            <h6 class="mb-0 fw-bold">Carlos</h6>
                                            <small class="text-muted" style="font-size: 0.7rem;">Designer</small>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled mt-3 small text-muted">
                                        <li class="mb-2"><i class="bi bi-dot"></i> Experience: 2 years</li>
                                        <li class="bi bi-dot"></i> Certified Professional</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> Total Revenue: $200</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-grid-card" style="background-color: #fff5f5;">
                                    <div class="user-mini">
                                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="">
                                        <div>
                                            <h6 class="mb-0 fw-bold">Rachel</h6>
                                            <small class="text-muted" style="font-size: 0.7rem;">Manager</small>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled mt-3 small text-muted">
                                        <li class="mb-2"><i class="bi bi-dot"></i> Experience: 5 years</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> Certified Professional</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> Total Revenue: $500</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="testimonial-grid-card" style="background-color: #eff5ff;">
                                    <div class="user-mini">
                                        <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="">
                                        <div>
                                            <h6 class="mb-0 fw-bold">Carlos</h6>
                                            <small class="text-muted" style="font-size: 0.7rem;">Designer</small>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled mt-3 small text-muted">
                                        <li class="mb-2"><i class="bi bi-dot"></i> Experience: 2 years</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> Certified Professional</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> Total Revenue: $200</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-grid-card" style="background-color: #fff5f5;">
                                    <div class="user-mini">
                                        <img src="https://randomuser.me/api/portraits/women/65.jpg" alt="">
                                        <div>
                                            <h6 class="mb-0 fw-bold">Rachel</h6>
                                            <small class="text-muted" style="font-size: 0.7rem;">Manager</small>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled mt-3 small text-muted">
                                        <li class="mb-2"><i class="bi bi-dot"></i> Experience: 5 years</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> Certified Professional</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> Total Revenue: $500</li>
                                    </ul>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="testimonial-grid-card" style="background-color: #eff5ff;">
                                    <div class="user-mini">
                                        <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="">
                                        <div>
                                            <h6 class="mb-0 fw-bold">Carlos</h6>
                                            <small class="text-muted" style="font-size: 0.7rem;">Designer</small>
                                        </div>
                                    </div>
                                    <ul class="list-unstyled mt-3 small text-muted">
                                        <li class="mb-2"><i class="bi bi-dot"></i> Experience: 2 years</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> Certified Professional</li>
                                        <li class="mb-2"><i class="bi bi-dot"></i> Total Revenue: $200</li>
                                    </ul>
                                </div>
                            </div>

                        </div>

                        <div class="swiper-button-next" style="height: 20px;right: -10px;color: #aba0a0;"></div>
                        <div class="swiper-button-prev" style="height: 20px;left: -10px;color: #aba0a0;"></div>
                        <div class="swiper-pagination" style="bottom: 0px;"></div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@push('frontendscripts')
    <script>
        var teacherSwiper = new Swiper(".teacherSwiper", {
            slidesPerView: 1,
            spaceBetween: 30, // Increased spacing for a cleaner look
            loop: true,
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            navigation: {
                nextEl: ".teacher-nav-buttons .swiper-button-next",
                prevEl: ".teacher-nav-buttons .swiper-button-prev",
            },
            pagination: {
                el: ".teacherSwiper .swiper-pagination",
                clickable: true,
            },
            breakpoints: {
                768: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 3
                },
            },
        });
    </script>
@endpush
