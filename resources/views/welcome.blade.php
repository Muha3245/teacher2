@extends('layouts.frontend')
@push('frontendstyles')
    <style>
        /* Teacher Card Hover */
        .teacherSwiper .card {
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .teacherSwiper .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
        }

        /* Profile Image Hover */
        .teacherSwiper .card img {
            transition: transform 0.3s ease;
        }

        .teacherSwiper .card img:hover {
            transform: scale(1.1);
        }

        /* Swiper Navigation - Top Right */
        .teacher-nav-buttons {
            position: absolute;
            top: -45px;
            right: 0;
            z-index: 10;
        }

        .swiper-button-next,
        .swiper-button-prev {
            background-color: #6366f1;
            color: #fff;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .swiper-button-next:hover,
        .swiper-button-prev:hover {
            background-color: #4f46e5;
        }

        /* Remove Pagination Dots */
        .teacherSwiper .swiper-pagination {
            display: none;
        }

        /* Badge Styling */
        .teacherSwiper .badge {
            font-size: 0.7rem;
            padding: 0.25rem 0.5rem;
            border-radius: 1rem;
        }
    </style>
@endpush
@section('content')
    <x-frontend.navbar />


    @php
        $teacherprofile = TeacherProfile();
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
                <button class="btn btn-hero-primary">Get Started</button>
                <button class="btn btn-hero-outline">Learn More</button>
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
    <section class="py-16 bg-gray-50 position-relative">
        <div class="container mx-auto">
            <div class="text-center mb-12">
                <span class="text-indigo-600 uppercase tracking-widest font-semibold">Our Teachers</span>
                <h2 class="text-3xl md:text-4xl font-bold mt-2">Meet Our Expert Teachers</h2>
                <p class="text-gray-500 mt-2 max-w-2xl mx-auto">
                    Explore our experienced teachers with multiple subjects and years of teaching experience.
                </p>
            </div>

            {{-- Arrow Navigation Container --}}
            <div class="d-flex justify-content-end mb-4">
                <div class="teacher-nav-buttons">
                    <div class="swiper-button-prev"></div>
                    <div class="swiper-button-next"></div>
                </div>
            </div>

            <div class="swiper teacherSwiper">
                <div class="swiper-wrapper">
                    @foreach ($teacherprofile as $teacher)
                        <div class="swiper-slide">
                            <div class="card text-center border-0 shadow-lg rounded-lg p-4 position-relative">
                                {{-- Profile Picture --}}
                                <div class="mx-auto rounded-circle overflow-hidden border border-primary mb-3"
                                    style="width: 100px; height: 100px;">
                                    <img src="https://randomuser.me/api/portraits/{{ rand(0, 1) == 0 ? 'men' : 'women' }}/{{ rand(1, 99) }}.jpg"
                                        alt="{{ $teacher->full_name }}" class="w-100 h-100 object-fit-cover">
                                </div>

                                {{-- Name & Headline --}}
                                <h4 class="fw-bold text-dark">{{ $teacher->full_name }}</h4>
                                <p class="text-muted mb-2">{{ $teacher->headline }}</p>

                                {{-- Subjects --}}
                                <div class="d-flex flex-wrap justify-content-center gap-2 mb-3">
                                    @foreach ($teacher->subjects as $sub)
                                        <span
                                            class="badge bg-indigo-100 text-indigo-700">{{ $sub->subject->name ?? '' }}</span>
                                    @endforeach
                                </div>

                                {{-- Education Tooltip --}}
                                @if ($teacher->educations->count())
                                    <div class="text-muted small mb-3">
                                        <span class="text-decoration-underline"
                                            title="@foreach ($teacher->educations as $edu) {{ $edu->education?->degree ?? '' }} ({{ $edu->institution }})@if (!$loop->last), @endif @endforeach">
                                            View Education
                                        </span>
                                    </div>
                                @endif

                                {{-- View Profile Button --}}
                                <a href="#" class="btn btn-primary btn-sm px-4 py-2 mt-2">View Profile</a>
                            </div>
                        </div>
                    @endforeach
                </div>
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
            spaceBetween: 20,
            loop: true,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
            breakpoints: {
                576: {
                    slidesPerView: 1
                },
                768: {
                    slidesPerView: 2
                },
                992: {
                    slidesPerView: 3
                },
                1200: {
                    slidesPerView: 4
                },
            },
        });
    </script>
@endpush
