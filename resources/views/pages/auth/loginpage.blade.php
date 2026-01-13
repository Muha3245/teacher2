@extends('layouts.frontend')

@push('frontendstyles')
<style>
    :root {
        --brand-pink: #ff85a2;
        --brand-pink-soft: #fff0f3;
        --brand-pink-dark: #f06292;
        --glass-white: rgba(255, 255, 255, 0.95);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: linear-gradient(135deg, #ffffff 0%, #fff5f7 100%);
        min-height: 100vh;
    }

    .login-section {
        padding: 80px 0;
        min-height: calc(100vh - 100px);
        display: flex;
        align-items: center;
    }

    .auth-card {
        background: var(--glass-white);
        border: 1px solid rgba(255, 133, 162, 0.2);
        border-radius: 24px;
        box-shadow: 0 20px 40px rgba(255, 133, 162, 0.08);
        overflow: hidden;
        backdrop-filter: blur(10px);
    }

    .nav-pills-custom {
        background: #f8f9fa;
        padding: 6px;
        border-radius: 14px;
        margin-bottom: 30px;
    }

    .nav-pills-custom .nav-link {
        color: #6c757d;
        font-weight: 600;
        border-radius: 10px;
        padding: 10px 20px;
        transition: all 0.3s ease;
    }

    .nav-pills-custom .nav-link.active {
        background-color: white;
        color: var(--brand-pink-dark);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .social-login-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        width: 100%;
        padding: 12px;
        border: 1px solid #e9ecef;
        background: white;
        border-radius: 12px;
        color: #444;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.2s ease;
        margin-bottom: 20px;
    }

    .social-login-btn:hover {
        background: #fafafa;
        border-color: var(--brand-pink);
        color: var(--brand-pink-dark);
        transform: translateY(-1px);
    }

    .divider-text {
        position: relative;
        text-align: center;
        margin: 25px 0;
    }

    .divider-text::before {
        content: "";
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: #eee;
        z-index: 1;
    }

    .divider-text span {
        position: relative;
        background: var(--glass-white);
        padding: 0 15px;
        color: #adb5bd;
        font-size: 0.85rem;
        z-index: 2;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .form-label {
        font-weight: 600;
        color: #444;
        font-size: 0.9rem;
        margin-bottom: 8px;
    }

    .input-group-text {
        background: #f8f9fa;
        border-right: none;
        color: #adb5bd;
        border-radius: 12px 0 0 12px;
    }

    .form-control {
        border-left: none;
        border-radius: 0 12px 12px 0;
        padding: 12px;
        background-color: #f8f9fa;
        border-color: #eee;
    }

    .form-control:focus {
        background-color: white;
        border-color: var(--brand-pink);
        box-shadow: 0 0 0 4px rgba(255, 133, 162, 0.1);
    }

    .btn-submit {
        background: var(--brand-pink);
        border: none;
        color: white;
        padding: 14px;
        border-radius: 12px;
        font-weight: 700;
        width: 100%;
        margin-top: 15px;
        transition: all 0.3s ease;
    }

    .btn-submit:hover {
        background: var(--brand-pink-dark);
        box-shadow: 0 8px 20px rgba(255, 133, 162, 0.3);
        transform: translateY(-2px);
    }

    .floating-shape {
        position: absolute;
        z-index: -1;
        opacity: 0.5;
    }
</style>

@endpush

@section('content')

<x-frontend.navbar />

<section class="login-section relative overflow-hidden">
    
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-12">
                <div class="auth-card p-4 p-md-5">
                    
                    <div class="text-center mb-4">
                        <h2 class="fw-bold text-dark">Welcome Back</h2>
                        <p class="text-muted">Join our community today</p>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif




                    <!-- Tabs Toggle -->
                    <ul class="nav nav-pills nav-pills-custom justify-content-center" id="authTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active w-100" id="login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab">Login</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link w-100" id="register-tab" data-bs-toggle="pill" data-bs-target="#pills-register" type="button" role="tab">Sign Up</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="authTabContent">
                        <!-- Login Content -->
                        <div class="tab-pane fade show active" id="pills-login" role="tabpanel">
                            <a href="{{ route('auth.google') }}" class="social-login-btn">
                                <img src="https://www.gstatic.com/images/branding/product/1x/gsa_512dp.png" width="20" alt="Google">
                                Sign in with Google
                            </a>

                            <div class="divider-text">
                                <span>OR EMAIL</span>
                            </div>

                            <form action="{{route('auth.login')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" class="form-control" placeholder="name@example.com" >
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <label class="form-label">Password</label>
                                        <a href="#" class="text-decoration-none small text-pink" style="color: var(--brand-pink)">Forgot?</a>
                                    </div>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                        <input type="password" name="password" class="form-control" placeholder="••••••••" >
                                    </div>
                                </div>
                                <button type="submit" class="btn-submit">Sign In to Account</button>
                            </form>
                        </div>

                        <!-- Register Content -->
                        <div class="tab-pane fade" id="pills-register" role="tabpanel">
                            <a href="{{route('auth.google')}}" class="social-login-btn">
                                <img src="https://www.gstatic.com/images/branding/product/1x/gsa_512dp.png" width="20" alt="Google">
                                Sign up with Google
                            </a>

                            <div class="divider-text">
                                <span>NEW ACCOUNT</span>
                            </div>

                            <form action="{{route('auth.register')}}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <input type="text" name="name" class="form-control" placeholder="John Doe" >
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                        <input type="email" name="email" class="form-control" placeholder="john@example.com" >
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Create Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                                        <input type="password" name="password" class="form-control" placeholder="Min. 8 characters" >
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <label class="form-label">Person</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person"></i></span>
                                        <select class="form-select" name="person" >
                                            <option value="">Select</option>
                                            <option value="student">Student</option>
                                            <option value="teacher">Teacher</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn-submit">Create My Account</button>
                            </form>
                        </div>
                    </div>

                    <p class="text-center mt-4 mb-0 small text-muted">
                        By continuing, you agree to our <a href="#" class="text-dark fw-bold">Terms of Service</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection