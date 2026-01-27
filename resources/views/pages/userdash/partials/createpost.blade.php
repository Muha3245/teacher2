@extends('layouts.userdash')
@push('userdashstyles')
    
@endpush
@section('content')
@php
        $teachersubjects = TeacherSubjects();
        $languages = Languages();
        $allSubjects = Subjects();
        $yourposts = SingleStudentPost(auth()->id());
    @endphp

<div class="form-card">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Post Your Requirement</h2>
        <p class="text-muted">Fill in the details to find the best tutors near you</p>
    </div>

    <form action="{{ route('student.poststore') }}" method="POST" id="studentPostForm" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <h5 class="section-title"><i data-lucide="user"></i> Basic Information</h5>
        <div class="mb-4">
            <label class="form-label">Requirement Description</label>
            <textarea name="description" required rows="4" class="form-control"
                placeholder="Example: Need help with O-Level Calculus and Algebra..."></textarea>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label class="form-label">Your Location</label>
                <input type="text" name="location" class="form-control" placeholder="City or Area">
            </div>
            <div class="col-md-6">
                <label class="form-label">Phone Number</label>
                <input id="phone" type="tel" class="form-control">
                <input type="hidden" name="phone">
                <input type="hidden" name="country_code">
                <div id="phoneError" class="text-danger small mt-1 d-none">Invalid number</div>
            </div>
        </div>

        <h5 class="section-title"><i data-lucide="book-open"></i> Academic Details</h5>
        <div class="mb-4">
            <label class="form-label">Subject (Select or type custom)</label>
            <select name="subjects" id="subjectsSelect" class="form-control">
                <option value=""></option>
                @foreach ($teachersubjects as $subject)
                    <option value="{{ $subject->subject->name }}">{{ $subject->subject->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="row g-3 mb-4 align-items-end">
            <div class="col-md-4">
                <label class="form-label">Grade</label>
                <select id="gradeSelect" class="form-select">
                    <option value="">Select Grade</option>
                    @foreach (config('grades.grades') as $grade)
                        <option>{{ $grade }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Skill Level</label>
                <select id="skillSelect" class="form-select">
                    <option value="">Select Level</option>
                    @foreach (config('grades.skills') as $skill)
                        <option>{{ $skill }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <input type="text" name="levelText" id="finalLevelInput" class="form-control bg-light"
                    placeholder="Selected Level" readonly>
            </div>
        </div>

        <h5 class="section-title"><i data-lucide="settings"></i> Preferences</h5>
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label class="form-label">Preferred Languages (Tags)</label>
                <select name="languages[]" id="languagesSelect" class="form-control" multiple>
                    @foreach ($languages ?? [] as $language)
                        <option value="{{ $language->name }}">{{ $language->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Tutor Gender</label>
                <select name="genderPreference" class="form-select">
                    <option value="NO_PREFERENCE">Any</option>
                    <option value="ONLY_MALE">Only Male</option>
                    <option value="ONLY_FEMALE">Only Female</option>
                </select>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label class="form-label">Job Type</label>
                <select name="jobType" class="form-select">
                    <option value="">Select Job Type</option>
                    <option value="Online">Online</option>
                    <option value="In-Person">In-Person</option>
                    <option value="Both">Both</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Urgency</label>
                <select name="needSomeone" class="form-select">
                    <option value="">How soon do you need a tutor?</option>
                    <option value="Urgently">Urgently</option>
                    <option value="In a week">In a week</option>
                    <option value="In a month">In a month</option>
                    <option value="Flexible">Flexible</option>
                </select>
            </div>
        </div>

        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <label class="form-label">Tutor Location Preference</label>
                <select name="getutorfrom" class="form-select">
                    <option value="Anywhere">Anywhere</option>
                    <option value="My city">From my city</option>
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Travel Distance (km)</label>
                <input type="number" name="travel_distance" class="form-control" placeholder="e.g., 10">
            </div>
        </div>

        <div class="mb-4">
            <div class="form-check">
                <input type="hidden" name="meeting_tutorplace" value="0">
                <input class="form-check-input" type="checkbox" name="meeting_tutorplace" value="1" id="meeting_tutorplace_check">
                <label class="form-check-label" for="meeting_tutorplace_check">
                    Willing to meet at tutor's place
                </label>
            </div>
        </div>

        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <label class="form-label">Budget & Type</label>
                <div class="input-group">
                    <input type="number" name="budget" class="form-control" placeholder="Amount">
                    <select name="budgetType" class="form-select" style="max-width: 120px;">
                        <option value="Hourly">/ Hr</option>
                        <option value="Monthly">/ Mo</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Attachment</label>
                <input type="file" name="files" class="form-control">
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-submit w-100 text-white shadow">
            Post Requirement
        </button>
    </form>
</div>
@endsection
@push('userdashjs')
    
@endpush
