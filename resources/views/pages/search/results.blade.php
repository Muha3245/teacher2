@extends('layouts.frontend')

@push('frontendstyles')
    <style>
        /* SEARCH BAR */
        .search-bar-wrapper {
            width: 100%;
            max-width: 700px;
            margin: 0 auto 2rem;
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
            color: #374151;
        }

        .search-input.left {
            border-radius: 999px 0 0 999px;
        }

        .search-input.right {
            border-radius: 0 999px 999px 0;
        }

        .search-bar select {
            appearance: none;
            background: transparent;
            width: 100%;
            cursor: pointer;
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

        /* TEACHER CARD */
        .teacher-card {
            background: #fff;
            border-radius: 15px;
            border: 1px solid #e5e7eb;
            padding: 20px;
            display: flex;
            gap: 20px;
            transition: all 0.3s;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        .teacher-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
        }

        .teacher-card .profile-pic {
            flex-shrink: 0;
            width: 120px;
            height: 120px;
            border-radius: 12px;
            object-fit: cover;
        }

        .teacher-info {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .teacher-info h5 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: #1e3a8a;
        }

        .teacher-info .subjects {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            margin-bottom: 10px;
        }

        .teacher-info .subjects span {
            background: #f3f4f6;
            color: #374151;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 0.75rem;
        }

        .teacher-info p.description {
            font-size: 0.875rem;
            color: #4b5563;
            line-height: 1.4;
            margin-bottom: 12px;
        }

        .teacher-info .details {
            display: flex;
            gap: 15px;
            font-size: 0.85rem;
            color: #6b7280;
            align-items: center;
            flex-wrap: wrap;
        }

        .teacher-info .details i {
            margin-right: 4px;
            color: #6366f1;
        }

        .teacher-info .view-profile-btn {
            margin-top: 10px;
            align-self: flex-start;
            padding: 6px 16px;
            font-size: 0.85rem;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            background: #6366f1;
            color: #fff;
            cursor: pointer;
            transition: 0.2s;
        }

        .teacher-info .view-profile-btn:hover {
            background: #4f46e5;
        }

        @media (max-width: 768px) {
            .teacher-card {
                flex-direction: column;
                align-items: center;
                text-align: center;
            }

            .teacher-info .details {
                justify-content: center;
            }

            .teacher-info .view-profile-btn {
                align-self: center;
            }
        }
    </style>
@endpush

@section('content')
    <x-frontend.navbar />
    @php
        $teacherprofile = TeacherProfile();
        $teachersubjects = TeacherSubjects();
    @endphp

    <div class="container py-5">

        {{-- SEARCH BAR --}}
        <form action="{{ route('search.teachers') }}" method="GET" class="search-bar-wrapper">
            <div class="search-bar">
                <select name="subject" class="search-input left">
                    <option value="">Select Subject</option>
                    @foreach ($teachersubjects as $subject)
                        <option value="{{ $subject->subject->name }}"
                            {{ request('subject') == $subject->subject->name ? 'selected' : '' }}>
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

        {{-- TEACHERS LIST --}}
        @if ($teachers->count())
            <div class="row g-4">
                @foreach ($teachers as $teacher)
                    <div class="col-md-8">
                        <div class="teacher-card">
                            {{-- Profile Picture --}}
                            <img src="{{ $teacher->profile_picture ?? '' }}" alt="{{ $teacher->full_name }}"
                                class="profile-pic"
                                onerror="this.onerror=null;this.src='https://randomuser.me/api/portraits/{{ rand(0, 1) == 0 ? 'men' : 'women' }}/{{ rand(1, 99) }}.jpg';">


                            {{-- Info --}}
                            <div class="teacher-info">
                                <h5>{{ $teacher->full_name }}</h5>

                                {{-- Subjects --}}
                                <div class="subjects">
                                    @foreach ($teacher->subjects as $sub)
                                        <span>{{ $sub->subject->name ?? '' }}</span>
                                    @endforeach
                                </div>

                                {{-- Description --}}
                                <p class="description">
                                    {{ Str::limit($teacher->profile_description, 150) }}
                                </p>

                                {{-- Details: location, price, experience --}}
                                <div class="details">
                                    <span><i class="bi bi-geo-alt"></i> {{ $teacher->location }}</span>
                                    <span><i class="bi bi-currency-dollar"></i>
                                        ${{ $teacher->min_price }}–{{ $teacher->max_price }}/hour</span>
                                    <span><i class="bi bi-laptop"></i> {{ $teacher->years_online ?? 0 }} yr.</span>
                                    <span><i class="bi bi-people-fill"></i> {{ $teacher->years_teaching ?? 0 }} yr.</span>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            <div class="d-flex justify-content-center mt-4">
                {{ $teachers->withQueryString()->links() }}
            </div>
        @else
            <p class="text-center text-muted mt-5">No teachers found</p>
        @endif
    </div>
@endsection
