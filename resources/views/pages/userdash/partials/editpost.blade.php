@extends('layouts.userdash')
@push('userdashstyles')
@endpush
@section('content')
    @php
        $teachersubjects = TeacherSubjects();
        $languages = Languages();
        $allSubjects = Subjects();
    @endphp

    <div class="form-card">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Edit Your Requirement</h2>
            <p class="text-muted">Update the details of your requirement</p>
        </div>

        <form action="{{ route('student.post.update', ['id' => $post->id]) }}" method="POST" id="studentPostForm"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">

            <h5 class="section-title"><i data-lucide="user"></i> Basic Information</h5>
            <div class="mb-4">
                <label class="form-label">Requirement Description</label>
                <textarea name="description" required rows="4" class="form-control"
                    placeholder="Example: Need help with O-Level Calculus and Algebra...">{{ $post->description }}</textarea>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Your Location</label>
                    <input type="text" name="location" class="form-control" placeholder="City or Area"
                        value="{{ $post->location }}">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input id="phone" type="tel" class="form-control" value="{{ $post->phone }}">
                    <input type="hidden" name="phone" value="{{ $post->phone }}">
                    <input type="hidden" name="country_code" value="{{ $post->country_code }}">
                    <div id="phoneError" class="text-danger small mt-1 d-none">Invalid number</div>
                </div>
            </div>

            <h5 class="section-title"><i data-lucide="book-open"></i> Academic Details</h5>
            <div class="mb-4">
                <label class="form-label">Subject (Select or type custom)</label>
                <select name="subjects" id="subjectsSelect" class="form-control">
                    <option value=""></option>
                    @foreach ($teachersubjects as $subject)
                        <option value="{{ $subject->subject->name }}" @if (in_array($subject->subject->name, json_decode($post->subjects))) selected @endif>
                            {{ $subject->subject->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row g-3 mb-4 align-items-end">
                <div class="col-md-4">
                    <label class="form-label">Grade</label>
                    <select id="gradeSelect" class="form-select">
                        <option value="">Select Grade</option>
                        @foreach (config('grades.grades') as $grade)
                            <option @if (str_contains($post->levelText, $grade)) selected @endif>{{ $grade }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Skill Level</label>
                    <select id="skillSelect" class="form-select">
                        <option value="">Select Level</option>
                        @foreach (config('grades.skills') as $skill)
                            <option @if (str_contains($post->levelText, $skill)) selected @endif>{{ $skill }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="text" name="levelText" id="finalLevelInput" class="form-control bg-light"
                        placeholder="Selected Level" readonly value="{{ $post->levelText }}">
                </div>
            </div>

            <h5 class="section-title"><i data-lucide="settings"></i> Preferences</h5>
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Preferred Languages (Tags)</label>
                    <select name="languages[]" id="languagesSelect" class="form-control" multiple>
                        @foreach ($languages ?? [] as $language)
                            <option value="{{ $language->name }}" @if (in_array($language->name, json_decode($post->language))) selected @endif>
                                {{ $language->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Tutor Gender</label>
                    <select name="genderPreference" class="form-select">
                        <option value="NO_PREFERENCE" @if ($post->genderPreference == 'NO_PREFERENCE') selected @endif>Any</option>
                        <option value="ONLY_MALE" @if ($post->genderPreference == 'ONLY_MALE') selected @endif>Only Male</option>
                        <option value="ONLY_FEMALE" @if ($post->genderPreference == 'ONLY_FEMALE') selected @endif>Only Female
                        </option>
                    </select>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Job Type</label>
                    <select name="jobType" class="form-select">
                        <option value="">Select Job Type</option>
                        <option value="Online" @if ($post->jobType == 'Online') selected @endif>Online</option>
                        <option value="In-Person" @if ($post->jobType == 'In-Person') selected @endif>In-Person</option>
                        <option value="Both" @if ($post->jobType == 'Both') selected @endif>Both</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Urgency</label>
                    <select name="needSomeone" class="form-select">
                        <option value="">How soon do you need a tutor?</option>
                        <option value="Urgently" @if ($post->needSomeone == 'Urgently') selected @endif>Urgently</option>
                        <option value="In a week" @if ($post->needSomeone == 'In a week') selected @endif>In a week</option>
                        <option value="In a month" @if ($post->needSomeone == 'In a month') selected @endif>In a month</option>
                        <option value="Flexible" @if ($post->needSomeone == 'Flexible') selected @endif>Flexible</option>
                    </select>
                </div>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <label class="form-label">Tutor Location Preference</label>
                    <select name="getutorfrom" class="form-select">
                        <option value="Anywhere" @if ($post->getutorfrom == 'Anywhere') selected @endif>Anywhere</option>
                        <option value="My city" @if ($post->getutorfrom == 'My city') selected @endif>From my city</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Travel Distance (km)</label>
                    <input type="number" name="travel_distance" class="form-control" placeholder="e.g., 10"
                        value="{{ $post->travel_distance }}">
                </div>
            </div>

            <div class="mb-4">
                <div class="form-check">
                    <input type="hidden" name="meeting_tutorplace" value="0">
                    <input class="form-check-input" type="checkbox" name="meeting_tutorplace" value="1"
                        id="meeting_tutorplace_check" @if ($post->meeting_tutorplace) checked @endif>
                    <label class="form-check-label" for="meeting_tutorplace_check">
                        Willing to meet at tutor's place
                    </label>
                </div>
            </div>

            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <label class="form-label">Budget & Type</label>
                    <div class="input-group">
                        <input type="number" name="budget" class="form-control" placeholder="Amount"
                            value="{{ $post->budget }}">
                        <select name="budgetType" class="form-select" style="max-width: 120px;">
                            <option value="Hourly" @if ($post->budgetType == 'Hourly') selected @endif>/ Hr</option>
                            <option value="Monthly" @if ($post->budgetType == 'Monthly') selected @endif>/ Mo</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <label class="form-label">Attachment</label>
                    <input type="file" name="files" class="form-control">
                    @if ($post->files)
                        <div class="mt-2">
                            Current file: <img src="{{ asset('storage/student_files/' . $post->files) }}"
                                target="_blank" style="width:200px; height: 150px; object-fit: contain;"></img>
                        </div>
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-submit w-100 text-white shadow">
                Update Requirement
            </button>
        </form>
    </div>
@endsection
@push('userdashjs')
@endpush