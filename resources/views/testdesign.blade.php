
@extends('layouts.frontend')
@section('content')

<x-frontend.navbar />


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
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
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
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
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
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                                class="bi bi-star-fill"></i>
                        </div>
                    </div>
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