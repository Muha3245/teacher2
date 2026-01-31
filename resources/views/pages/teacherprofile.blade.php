@extends('layouts.frontend')

@push('frontendstyles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    body { background-color: #f4f7f6; color: #333; }
    
    /* Top Header Section */
    .to-header {
        background: #fff;
        border-bottom: 1px solid #e0e0e0;
        padding: 30px 0;
        margin-bottom: 30px;
    }
    .to-profile-img {
        width: 150px;
        height: 150px;
        border-radius: 8px;
        object-fit: cover;
        border: 1px solid #ddd;
    }
    .to-name { font-size: 28px; font-weight: 700; color: #222; margin-bottom: 5px; }
    .to-headline { font-size: 18px; color: #007bff; font-weight: 500; }
    
    /* Buttons */
    .btn-contact-main {
        background-color: #ff9800;
        color: white;
        font-weight: 700;
        padding: 12px 30px;
        border-radius: 4px;
        border: none;
        text-transform: uppercase;
    }
    .btn-contact-main:hover { background-color: #f57c00; color: white; }

    /* Content Cards */
    .to-card {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 4px;
        padding: 25px;
        margin-bottom: 20px;
    }
    .to-section-title {
        font-size: 20px;
        font-weight: 700;
        color: #444;
        border-bottom: 1px solid #eee;
        padding-bottom: 12px;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }
    .to-section-title i { margin-right: 10px; color: #888; }

    /* Tags & Labels */
    .subject-pill {
        display: inline-block;
        background: #f0f3ff;
        color: #0d6efd;
        padding: 6px 15px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        margin: 0 8px 8px 0;
        border: 1px solid #dbe4ff;
    }
    .fee-box {
        font-size: 24px;
        font-weight: 800;
        color: #333;
    }
    .info-label { color: #777; font-size: 13px; font-weight: 600; text-transform: uppercase; }
    .info-value { color: #333; font-weight: 600; display: block; margin-bottom: 15px; }

    /* Timeline for Education */
    .edu-item { padding-left: 15px; border-left: 3px solid #0d6efd; margin-bottom: 20px; }
</style>
@endpush

@section('content')
     <x-frontend.navbar />

<div class="to-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2 text-center text-md-start">
                @if($profile->profile_picture)
                    <img src="{{ asset($profile->profile_picture) }}" class="to-profile-img"
                        onerror="this.onerror=null;this.src='https://randomuser.me/api/portraits/{{ rand(0, 1) ? 'men' : 'women' }}/{{ rand(1, 99) }}.jpg';">
                @else
                    <div class="to-profile-img bg-secondary d-flex align-items-center justify-content-center text-white fs-1">
                        {{ strtoupper(substr($profile->full_name,0,1)) }}
                    </div>
                @endif
            </div>
            <div class="col-md-7 mt-3 mt-md-0">
                <h1 class="to-name">{{ $profile->full_name }}</h1>
                <p class="to-headline">{{ $profile->headline }}</p>
                <div class="text-muted">
                    <i class="fa fa-map-marker-alt me-2"></i> {{ $profile->location }} 
                    <span class="mx-2">|</span> 
                    <i class="fa fa-graduation-cap me-2"></i> {{ $profile->years_teaching }} Years Experience
                </div>
            </div>
            <div class="col-md-3 text-md-end mt-4 mt-md-0">
                <button class="btn-contact-main w-100">Contact Teacher</button>
                <p class="small text-muted text-center mt-2">Response time: High</p>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5">
    <div class="row">
        <div class="col-lg-8">
            
            {{-- ABOUT SECTION --}}
            <div class="to-card">
                <h2 class="to-section-title"><i class="fa fa-user"></i> About</h2>
                <div style="white-space: pre-line; line-height: 1.8; color: #555;">
                    {{ $profile->profile_description }}
                </div>
            </div>

            {{-- SUBJECTS SECTION --}}
            @if($profile->subjects->isNotEmpty())
            <div class="to-card">
                <h2 class="to-section-title"><i class="fa fa-book"></i> Subjects</h2>
                <div class="d-flex flex-wrap">
                    @foreach($profile->subjects as $ts)
                        @if(optional($ts->subject)->name)
                            <span class="subject-pill">{{ $ts->subject->name }}</span>
                        @endif
                    @endforeach
                </div>
            </div>
            @endif

            {{-- EDUCATION SECTION --}}
            @if($profile->educations->isNotEmpty())
            <div class="to-card">
                <h2 class="to-section-title"><i class="fa fa-graduation-cap"></i> Education</h2>
                @foreach($profile->educations as $edu)
                    <div class="edu-item">
                        <h5 class="mb-0 fw-bold">{{ $edu->education->degree }}</h5>
                        <div class="text-primary fw-medium">{{ $edu->institute }}</div>
                        <small class="text-muted">{{ $edu->start_year }} - {{ $edu->end_year }}</small>
                    </div>
                @endforeach
            </div>
            @endif
        </div>

        <div class="col-lg-4">
            
            {{-- FEE CARD --}}
            <div class="to-card text-center">
                <span class="info-label">Fee / Hourly Rate</span>
                <div class="fee-box mt-2">
                    ${{ number_format($profile->min_price) }} - ${{ number_format($profile->max_price) }}
                </div>
                <div class="text-muted mb-3">per {{ $profile->charge_period }}</div>
                <hr>
                <div class="text-start">
                    <span class="info-label">Willing to travel</span>
                    <span class="info-value">{{ $profile->willing_to_travel ? "Yes ($profile->travel_km km)" : 'No / Online Only' }}</span>

                    <span class="info-label">Digital Pen</span>
                    <span class="info-value">{{ $profile->has_digital_pen ? 'Available' : 'No' }}</span>

                    <span class="info-label">Helps with homework</span>
                    <span class="info-value">{{ $profile->helps_homework ? 'Yes' : 'No' }}</span>
                </div>
            </div>

            {{-- CONTACT SIDEBAR --}}
            <div class="to-card">
                <h3 class="fs-6 fw-bold mb-3 border-bottom pb-2">Phone Details</h3>
                @foreach($profile->phones as $phone)
                    <div class="d-flex align-items-center mb-2">
                        <i class="fa fa-phone-alt text-success me-3"></i>
                        <span class="fw-bold">{{$phone->country_code }}-{{ $phone->phone }}</span>
                    </div>
                @endforeach
                <div class="mt-3 p-2 bg-light rounded small">
                    <i class="fa fa-shield-alt text-primary me-1"></i> Verified Teacher
                </div>
            </div>

            {{-- PERSONAL INFO --}}
            <div class="to-card">
                <span class="info-label">Gender</span>
                <span class="info-value">{{ ucfirst($profile->gender) }}</span>

                <span class="info-label">Experience Online</span>
                <span class="info-value">{{ $profile->years_online }} years</span>
            </div>

        </div>
    </div>
</div>
@endsection