@extends('layouts.userdash')

@push('userdashstyles')
<style>
:root {
    --primary-color: #6366f1;
    --primary-hover: #4f46e5;
    --bg-light: #f8fafc;
    --border-radius: 12px;
}

body {
    font-family: 'Plus Jakarta Sans', sans-serif;
    background-color: var(--bg-light);
    color: #1e293b;
}

.card {
    border-radius: 20px;
    transition: all 0.3s ease;
}
.card:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.1);
}

.badge {
    font-size: 0.75rem;
    font-weight: 600;
}

.btn-primary {
    background-color: var(--primary-color);
    border: none;
    transition: all 0.3s;
}
.btn-primary:hover {
    background-color: var(--primary-hover);
    transform: translateY(-2px);
}

.btn-outline-primary {
    border-radius: 12px;
}

.btn-outline-secondary {
    border-radius: 12px;
}
</style>

@endpush

@section('content')
@php
    $teachersubjects = TeacherSubjects();
    $languages = Languages();
    $allSubjects = Subjects();
    $yourposts = SingleStudentPost(auth()->id());
@endphp

<div class="row justify-content-center">
    <div class="col-lg-10">

        {{-- Success Message --}}
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        {{-- Validation Errors --}}
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- Create Post --}}
        @if($yourposts->isEmpty())
            @include('pages.userdash.partials.createpost')
        @else
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="text-primary fw-bold">Your Posts</h3>
                <a href="{{ route('user.createpost') }}" class="btn btn-primary d-flex align-items-center">
                    <i data-lucide="add-circle" class="icon-sm me-2"></i> Add New
                </a>
            </div>

            <div class="row g-4">
                @foreach($yourposts as $post)
                <div class="col-md-12">
                    <div class="card shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body position-relative p-4">

                            {{-- Edit Button --}}
                            <a href="{{ route('student.post.edit', $post->id) }}" class="btn btn-sm btn-outline-primary position-absolute top-0 end-0 m-3">
                                <i data-lucide="edit-3" class="icon-sm"></i>
                            </a>

                            <h5 class="card-title fw-bold text-dark mb-2">{{ Str::limit($post->description, 80) }}</h5>

                            {{-- Subjects --}}
                            <div class="mb-2">
                                <strong class="text-muted">Subjects:</strong>
                                @foreach(json_decode($post->subjects ?? '[]') as $subject)
                                <span class="badge bg-primary me-1">{{ $subject }}</span>
                                @endforeach
                            </div>

                            {{-- Level --}}
                            <p class="mb-1"><strong class="text-muted">Level:</strong> {{ $post->levelText ?? 'N/A' }}</p>

                            {{-- Languages --}}
                            <div class="mb-2">
                                <strong class="text-muted">Languages:</strong>
                                @foreach(json_decode($post->language ?? '[]') as $lang)
                                <span class="badge bg-success me-1">{{ $lang }}</span>
                                @endforeach
                            </div>

                            {{-- Location & Phone --}}
                            <p class="mb-1"><strong class="text-muted">Location:</strong> {{ $post->location ?? 'N/A' }}</p>
                            <p class="mb-1"><strong class="text-muted">Phone:</strong> {{ $post->country_code ?? '' }} {{ $post->phone ?? 'N/A' }}</p>

                            {{-- Tutor Preferences --}}
                            <p class="mb-1"><strong class="text-muted">Gender Preference:</strong> {{ $post->genderPreference ?? 'Any' }}</p>
                            <p class="mb-1"><strong class="text-muted">Need Tutor:</strong> {{ $post->needSomeone ?? 'Flexible' }}</p>
                            <p class="mb-1"><strong class="text-muted">Job Type:</strong> {{ $post->jobType ?? 'N/A' }}</p>
                            <p class="mb-1"><strong class="text-muted">Tutor Location:</strong> {{ $post->getutorfrom ?? 'Anywhere' }}</p>
                            <p class="mb-1"><strong class="text-muted">Travel Distance:</strong> {{ $post->travel_distance ?? 0 }} km</p>
                            <p class="mb-1"><strong class="text-muted">Meeting at Tutor's Place:</strong> {{ $post->meeting_tutorplace ? 'Yes' : 'No' }}</p>

                            {{-- Budget --}}
                            <p class="mb-2"><strong class="text-muted">Budget:</strong> {{ $post->budget ?? 0 }} / {{ $post->budgetType ?? 'N/A' }}</p>

                            {{-- File --}}
                            @if($post->files)
                                <a href="{{ asset('storage/student_files/'.$post->files) }}" target="_blank" class="btn btn-outline-secondary btn-sm">
                                    <i data-lucide="file-text" class="icon-sm me-1"></i> View Attachment
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection

@push('userdashjs')
@endpush
