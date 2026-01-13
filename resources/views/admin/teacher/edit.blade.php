@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <form action="{{ route('admin.teacher.update', $teacher->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                        <div class="card-header bg-white py-3 border-bottom">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="mb-0 text-primary fw-bold">
                                        <i class="bi bi-pencil-square me-2"></i>Edit Teacher Profile
                                    </h4>
                                    <p class="text-muted small mb-0">Update teacher's details</p>
                                </div>
                                <button type="submit" class="btn btn-primary px-4 shadow-sm">
                                    <i class="bi bi-check-circle me-1"></i> Update Profile
                                </button>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="accordion accordion-flush" id="teacherAccordion">

                                {{-- 1. PERSONAL INFORMATION --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button fw-bold py-4" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#secPersonal">
                                            <span class="step-num me-3">1</span> Personal & Contact Details
                                        </button>
                                    </h2>
                                    <div id="secPersonal" class="accordion-collapse collapse show"
                                        data-bs-parent="#teacherAccordion">
                                        <div class="accordion-body bg-light-50">
                                            <div class="row g-4">
                                                <div class="col-md-3 text-center border-end">
                                                    <div class="profile-upload-wrapper mx-auto mb-2">
                                                        <img id="profilePreview"
                                                            src="{{ $teacher->profile_picture ? asset( $teacher->profile_picture) : 'https://ui-avatars.com/api/?name=' . urlencode($teacher->full_name) . '&background=0D6EFD&color=fff&size=200' }}"
                                                            class="profile-preview shadow-sm">
                                                        <label for="profile_image" class="profile-upload-btn"><i
                                                                class="bi bi-camera"></i></label>
                                                        <input type="file" name="profile_image" id="profile_image"
                                                            class="d-none" accept="image/*">
                                                    </div>
                                                    <small class="text-muted">Upload Photo</small>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <label class="form-label small fw-bold text-uppercase">Full Name
                                                                *</label>
                                                            <input type="text" name="full_name"
                                                                class="form-control bg-white" placeholder="Full Name"
                                                                value="{{ old('full_name', $teacher->full_name) }}">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="form-label small fw-bold text-uppercase">Country
                                                                Code</label>
                                                                <select name="country_code" class="form-select bg-white">
                                                                    <option value="">Select</option>
                                                                    <option value="+1" @if(optional($teacher->phones->first())->country_code == '+1') selected @endif>United States (+1)</option>
                                                                    <option value="+44" @if(optional($teacher->phones->first())->country_code == '+44') selected @endif>United Kingdom (+44)</option>
                                                                    <option value="+91" @if(optional($teacher->phones->first())->country_code == '+91') selected @endif>India (+91)</option>
                                                                    <option value="+61" @if(optional($teacher->phones->first())->country_code == '+61') selected @endif>Australia (+61)</option>
                                                                    <option value="+49" @if(optional($teacher->phones->first())->country_code == '+49') selected @endif>Germany (+49)</option>
                                                                    <option value="+33" @if(optional($teacher->phones->first())->country_code == '+33') selected @endif>France (+33)</option>
                                                                    <option value="+81" @if(optional($teacher->phones->first())->country_code == '+81') selected @endif>Japan (+81)</option>
                                                                    <option value="+86" @if(optional($teacher->phones->first())->country_code == '+86') selected @endif>China (+86)</option>
                                                                    <option value="+7" @if(optional($teacher->phones->first())->country_code == '+7') selected @endif>Russia (+7)</option>
                                                                    <option value="+39" @if(optional($teacher->phones->first())->country_code == '+39') selected @endif>Italy (+39)</option>
                                                                    <option value="+34" @if(optional($teacher->phones->first())->country_code == '+34') selected @endif>Spain (+34)</option>
                                                                    <option value="+55" @if(optional($teacher->phones->first())->country_code == '+55') selected @endif>Brazil (+55)</option>
                                                                    <option value="+27" @if(optional($teacher->phones->first())->country_code == '+27') selected @endif>South Africa (+27)</option>
                                                                    <option value="+64" @if(optional($teacher->phones->first())->country_code == '+64') selected @endif>New Zealand (+64)</option>
                                                                    <option value="+82" @if(optional($teacher->phones->first())->country_code == '+82') selected @endif>South Korea (+82)</option>
                                                                    <option value="+65" @if(optional($teacher->phones->first())->country_code == '+65') selected @endif>Singapore (+65)</option>
                                                                    <option value="+971" @if(optional($teacher->phones->first())->country_code == '+971') selected @endif>United Arab Emirates (+971)</option>
                                                                    <option value="+966" @if(optional($teacher->phones->first())->country_code == '+966') selected @endif>Saudi Arabia (+966)</option>
                                                                    <option value="+20" @if(optional($teacher->phones->first())->country_code == '+20') selected @endif>Egypt (+20)</option>
                                                                    <option value="+880" @if(optional($teacher->phones->first())->country_code == '+880') selected @endif>Bangladesh (+880)</option>
                                                                    <option value="+92" @if(optional($teacher->phones->first())->country_code == '+92') selected @endif>Pakistan (+92)</option>
                                                                    <option value="+234" @if(optional($teacher->phones->first())->country_code == '+234') selected @endif>Nigeria (+234)</option>
                                                                    <option value="+41" @if(optional($teacher->phones->first())->country_code == '+41') selected @endif>Switzerland (+41)</option>
                                                                    <option value="+46" @if(optional($teacher->phones->first())->country_code == '+46') selected @endif>Sweden (+46)</option>
                                                                    <option value="+31" @if(optional($teacher->phones->first())->country_code == '+31') selected @endif>Netherlands (+31)</option>
                                                                    <option value="+47" @if(optional($teacher->phones->first())->country_code == '+47') selected @endif>Norway (+47)</option>
                                                                    <option value="+351" @if(optional($teacher->phones->first())->country_code == '+351') selected @endif>Portugal (+351)</option>
                                                                    <option value="+48" @if(optional($teacher->phones->first())->country_code == '+48') selected @endif>Poland (+48)</option>
                                                                    <option value="+353" @if(optional($teacher->phones->first())->country_code == '+353') selected @endif>Ireland (+353)</option>
                                                                    <option value="+380" @if(optional($teacher->phones->first())->country_code == '+380') selected @endif>Ukraine (+380)</option>
                                                                    <option value="+43" @if(optional($teacher->phones->first())->country_code == '+43') selected @endif>Austria (+43)</option>
                                                                    <option value="+90" @if(optional($teacher->phones->first())->country_code == '+90') selected @endif>Turkey (+90)</option>
                                                                    <option value="+52" @if(optional($teacher->phones->first())->country_code == '+52') selected @endif>Mexico (+52)</option>
                                                                    <option value="+1-345" @if(optional($teacher->phones->first())->country_code == '+1-345') selected @endif>Cayman Islands (+1-345)</option>
                                                                    <option value="+1-246" @if(optional($teacher->phones->first())->country_code == '+1-246') selected @endif>Barbados (+1-246)</option>
                                                                    <option value="+1-242" @if(optional($teacher->phones->first())->country_code == '+1-242') selected @endif>Bahamas (+1-242)</option>
                                                                    <!-- Add more countries as needed -->
                                                                </select>
                                                        </div>

                                                        <div class="col-md-5">
                                                            <label class="form-label small fw-bold text-uppercase">Number
                                                            </label>
                                                            <input type="text" name="number"
                                                                class="form-control bg-white"
                                                                placeholder="phone number"
                                                                value="{{ old('number', optional($teacher->phones->first())->phone) }}">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label small fw-bold text-uppercase">Headline
                                                                / Tagline</label>
                                                            <input type="text" name="headline"
                                                                class="form-control bg-white"
                                                                placeholder="e.g. Expert Physics Tutor with 10+ years experience"
                                                                value="{{ old('headline', $teacher->headline) }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label
                                                                class="form-label small fw-bold text-uppercase">Gender</label>
                                                            <select name="gender" class="form-select bg-white">
                                                                <option value="">Select</option>
                                                                <option value="Male" @if (old('gender', $teacher->gender) == 'Male') selected @endif>Male</option>
                                                                <option value="Female" @if (old('gender', $teacher->gender) == 'Female') selected @endif>Female</option>
                                                                <option value="Other" @if (old('gender', $teacher->gender) == 'Other') selected @endif>Other</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label small fw-bold text-uppercase">Birth
                                                                Date</label>
                                                            <input type="date" name="birth_date"
                                                                class="form-control bg-white"
                                                                value="{{ old('birth_date', $teacher->birth_date) }}">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label
                                                                class="form-label small fw-bold text-uppercase">Location</label>
                                                            <select name="location_id" class="form-select bg-white">
                                                                <option value="">Select Location</option>
                                                                @foreach ($locations as $location)
                                                                    <option value="{{ $location->id }}" @if (old('location_id', $teacher->location_id) == $location->id) selected @endif>
                                                                        {{ $location->city }}, {{ $location->country }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- 2. SUBJECTS --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fw-bold py-4" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#secSubjects">
                                            <span class="step-num me-3">2</span> Subjects & Expertise
                                        </button>
                                    </h2>
                                    <div id="secSubjects" class="accordion-collapse collapse"
                                        data-bs-parent="#teacherAccordion">
                                        <div class="accordion-body">
                                            <div id="subject-wrapper">
                                                @forelse($teacher->subjects as $index => $sub)
                                                    <div
                                                        class="subject-item bg-light p-3 rounded-3 mb-3 border position-relative">
                                                        <span class="remove-btn"
                                                            onclick="this.parentElement.remove()"><i
                                                                class="bi bi-x"></i></span>
                                                        <div class="row g-3">
                                                            <div class="col-md-4">
                                                                <label class="form-label small fw-bold">Select
                                                                    Subject</label>
                                                                <select name="subjects[{{ $index }}][id]"
                                                                    class="form-select select2-init">
                                                                    <option value="">--Select--</option>
                                                                    @foreach ($subjects as $subject)
                                                                        <option value="{{ $subject->id }}" @if ($subject->id == $sub->id) selected @endif>
                                                                            {{ $subject->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label small fw-bold">Teaching
                                                                    From</label>
                                                                <select name="subjects[{{ $index }}][from]"
                                                                    class="form-select">
                                                                    <option @if($sub->from_level == 'Primary School') selected @endif>Primary School</option>
                                                                    <option @if($sub->from_level == 'Middle School') selected @endif>Middle School</option>
                                                                    <option @if($sub->from_level == 'High School') selected @endif>High School</option>
                                                                    <option @if($sub->from_level == 'O Level / IGCSE') selected @endif>O Level / IGCSE</option>
                                                                    <option @if($sub->from_level == 'A Level') selected @endif>A Level</option>
                                                                    <option @if($sub->from_level == 'Undergraduate') selected @endif>Undergraduate</option>
                                                                    <option @if($sub->from_level == 'Masters / Professional') selected @endif>Masters / Professional</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label small fw-bold">Teaching To</label>
                                                                <select name="subjects[{{ $index }}][to]"
                                                                    class="form-select">
                                                                    <option @if($sub->to_level == 'Beginner') selected @endif>Beginner</option>
                                                                    <option @if($sub->to_level == 'Intermediate') selected @endif>Intermediate</option>
                                                                    <option @if($sub->to_level == 'Advanced/Expert') selected @endif>Advanced/Expert</option>
                                                                    <option @if($sub->to_level == 'Exam Preparation') selected @endif>Exam Preparation</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div
                                                        class="subject-item bg-light p-3 rounded-3 mb-3 border position-relative">
                                                        <div class="row g-3">
                                                            <div class="col-md-4">
                                                                <label class="form-label small fw-bold">Select
                                                                    Subject</label>
                                                                <select name="subjects[0][id]"
                                                                    class="form-select select2-init">
                                                                    <option value="">--Select--</option>
                                                                    @foreach ($subjects as $subject)
                                                                        <option value="{{ $subject->id }}">
                                                                            {{ $subject->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label small fw-bold">Teaching
                                                                    From</label>
                                                                <select name="subjects[0][from]" class="form-select">
                                                                    <option>Primary School</option>
                                                                    <option>Middle School</option>
                                                                    <option>High School</option>
                                                                    <option>O Level / IGCSE</option>
                                                                    <option>A Level</option>
                                                                    <option>Undergraduate</option>
                                                                    <option>Masters / Professional</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label small fw-bold">Teaching To</label>
                                                                <select name="subjects[0][to]" class="form-select">
                                                                    <option>Beginner</option>
                                                                    <option>Intermediate</option>
                                                                    <option>Advanced/Expert</option>
                                                                    <option>Exam Preparation</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                            <button type="button"
                                                class="btn btn-outline-primary btn-sm rounded-pill mt-2"
                                                onclick="addSubject()">
                                                <i class="bi bi-plus-circle me-1"></i> Add Another Subject
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- 3. EDUCATION HISTORY --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fw-bold py-4" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#secEducation">
                                            <span class="step-num me-3">3</span> Education History
                                        </button>
                                    </h2>
                                    <div id="secEducation" class="accordion-collapse collapse"
                                        data-bs-parent="#teacherAccordion">
                                        <div class="accordion-body">
                                            <div id="education-wrapper">
                                                @forelse($teacher->educations as $index => $edu)
                                                    <div
                                                        class="edu-item border-start border-primary border-4 bg-light p-3 rounded-3 mb-3 shadow-sm position-relative">
                                                        <span class="remove-btn"
                                                            onclick="this.parentElement.remove()"><i
                                                                class="bi bi-x"></i></span>
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label small fw-bold">Institution /
                                                                    University</label>
                                                                <input type="text"
                                                                    name="edu[{{ $index }}][institution]"
                                                                    class="form-control bg-white"
                                                                    value="{{ $edu->institution }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label small fw-bold">Select
                                                                    education</label>
                                                                <select name="edu[{{ $index }}][edu]"
                                                                    class="form-select select2-init">
                                                                    <option value="">--Select--</option>
                                                                    @foreach ($educations as $e)
                                                                        <option value="{{ $e->id }}" @if ($edu->id == $e->id) selected @endif>
                                                                            {{ $e->degree }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label small fw-bold">Start Year</label>
                                                                <input type="number"
                                                                    name="edu[{{ $index }}][start]"
                                                                    class="form-control bg-white" placeholder="YYYY"
                                                                    value="{{ $edu->start_year }} ">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label small fw-bold">End Year (or
                                                                    Expected)</label>
                                                                <input type="number"
                                                                    name="edu[{{ $index }}][end]"
                                                                    class="form-control bg-white" placeholder="YYYY"
                                                                    value="{{ $edu->end_year }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div
                                                        class="edu-item border-start border-primary border-4 bg-light p-3 rounded-3 mb-3 shadow-sm position-relative">
                                                        <div class="row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label small fw-bold">Institution /
                                                                    University</label>
                                                                <input type="text" name="edu[0][institution]"
                                                                    class="form-control bg-white"
                                                                    placeholder="e.g. Oxford University">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label small fw-bold">Select
                                                                    education</label>
                                                                <select name="edu[0][edu]"
                                                                    class="form-select select2-init">
                                                                    <option value="">--Select--</option>
                                                                    @foreach ($educations as $edu)
                                                                        <option value="{{ $edu->id }}">
                                                                            {{ $edu->degree }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label small fw-bold">Start Year</label>
                                                                <input type="number" name="edu[0][start]"
                                                                    class="form-control bg-white" placeholder="YYYY">
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="form-label small fw-bold">End Year (or
                                                                    Expected)</label>
                                                                <input type="number" name="edu[0][end]"
                                                                    class="form-control bg-white" placeholder="YYYY">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforelse
                                            </div>
                                            <button type="button"
                                                class="btn btn-outline-primary btn-sm rounded-pill mt-2"
                                                onclick="addEducation()">
                                                <i class="bi bi-plus-circle me-1"></i> Add Education
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                {{-- 4. PRICING & TEACHING DETAILS --}}
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed fw-bold py-4" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#secPricing">
                                            <span class="step-num me-3">4</span> Pricing & Teaching Details
                                        </button>
                                    </h2>
                                    <div id="secPricing" class="accordion-collapse collapse"
                                        data-bs-parent="#teacherAccordion">
                                        <div class="accordion-body bg-light-50">
                                            <div class="row g-4 mb-4">
                                                <div class="col-md-4">
                                                    <label class="form-label small fw-bold text-uppercase">Charge
                                                        Period</label>
                                                    <select name="charge_period" class="form-select bg-white">
                                                        <option value="hourly" @if ($teacher->charge_period == 'hourly') selected @endif>Hourly</option>
                                                        <option value="monthly" @if ($teacher->charge_period == 'monthly') selected @endif>Monthly</option>
                                                        <option value="per_course" @if ($teacher->charge_period == 'per_course') selected @endif>Per Course</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label small fw-bold text-uppercase">Price Range (Min
                                                        - Max)</label>
                                                    <div class="input-group">
                                                        <input type="number" name="min_price"
                                                            class="form-control bg-white" placeholder="Min"
                                                            value="{{ old('min_price', $teacher->min_price) }}">
                                                        <span class="input-group-text">to</span>
                                                        <input type="number" name="max_price"
                                                            class="form-control bg-white" placeholder="Max"
                                                            value="{{ old('max_price', $teacher->max_price) }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="form-label small fw-bold text-uppercase">Teaching
                                                        Experience</label>
                                                    <div class="input-group">
                                                        <input type="number" name="years_teaching"
                                                            class="form-control bg-white" placeholder="Years"
                                                            value="{{ old('years_teaching', $teacher->years_teaching) }}">
                                                        <span class="input-group-text">Years</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row g-3 mb-4">
                                                <div class="col-md-4">
                                                    <div
                                                        class="form-check form-switch p-3 border rounded-3 bg-white shadow-sm h-100">
                                                        <input class="form-check-input ms-0 me-2" type="checkbox"
                                                            id="willing_to_travel" name="willing_to_travel" @if (old('willing_to_travel', $teacher->willing_to_travel)) checked @endif>
                                                        <label class="form-check-label fw-bold"
                                                            for="willing_to_travel">Willing to Travel?</label>

                                                        <div class="mt-2 travel_km_div" style="{{ old('willing_to_travel', $teacher->willing_to_travel) ? '' : 'display:none;' }}">
                                                            <div class="input-group input-group-sm">
                                                                <input type="number" name="travel_km"
                                                                    class="form-control" placeholder="Distance"
                                                                    value="{{ old('travel_km', $teacher->travel_km) }}">
                                                                <span class="input-group-text">KM Range</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div
                                                        class="form-check form-switch p-3 border rounded-3 bg-white shadow-sm h-100">
                                                        <input class="form-check-input ms-0 me-2" type="checkbox"
                                                            name="has_digital_pen" id="has_digital_pen" @if (old('has_digital_pen', $teacher->has_digital_pen)) checked @endif>
                                                        <label class="form-check-label fw-bold" for="has_digital_pen">I
                                                            have a Digital Pen</label>
                                                        <p class="text-muted small mb-0">For online whiteboarding</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div
                                                        class="form-check form-switch p-3 border rounded-3 bg-white shadow-sm h-100">
                                                        <input class="form-check-input ms-0 me-2" type="checkbox"
                                                            name="helps_homework" id="helps_homework" @if (old('helps_homework', $teacher->helps_homework)) checked @endif>
                                                        <label class="form-check-label fw-bold"
                                                            for="helps_homework">Homework Help</label>
                                                        <p class="text-muted small mb-0">Assisting with assignments</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                    <label class="form-label small fw-bold text-uppercase">Profile
                                                        Description</label>
                                                    <textarea name="profile_description" class="form-control bg-white" rows="4"
                                                        placeholder="Briefly describe your teaching style and approach...">{{ old('profile_description', $teacher->profile_description) }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('adminstyles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        :root {
            --bs-primary: #4361ee;
        }

        .bg-light-50 {
            background-color: #fcfdfe;
        }

        .accordion-button:not(.collapsed) {
            background: #f8faff;
            color: var(--bs-primary);
            box-shadow: none;
            border-left: 5px solid var(--bs-primary);
        }

        .step-num {
            width: 30px;
            height: 30px;
            background: #eef2ff;
            color: var(--bs-primary);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
        }

        .accordion-button:not(.collapsed) .step-num {
            background: var(--bs-primary);
            color: white;
        }

        .profile-upload-wrapper {
            width: 140px;
            height: 140px;
            position: relative;
        }

        .profile-preview {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #fff;
        }

        .profile-upload-btn {
            position: absolute;
            bottom: 5px;
            right: 5px;
            width: 35px;
            height: 35px;
            background: var(--bs-primary);
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: 0.2s;
            border: 3px solid #fff;
        }

        .profile-upload-btn:hover {
            transform: scale(1.1);
        }

        .subject-item,
        .edu-item {
            transition: 0.3s;
        }

        .subject-item:hover,
        .edu-item:hover {
            border-color: var(--bs-primary) !important;
        }

        .remove-btn {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ff4d4d;
            color: white;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 2px solid #fff;
            font-size: 0.7rem;
        }
    </style>
@endpush

@push('adminscripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-init').select2({
                width: '100%'
            });

            // Profile Preview
            $('#profile_image').on('change', function(e) {
                const reader = new FileReader();
                reader.onload = () => $('#profilePreview').attr('src', reader.result);
                reader.readAsDataURL(e.target.files[0]);
            });

            // TRAVEL KM TOGGLE
            $('#willing_to_travel').on('change', function() {
                if (this.checked) {
                    $('.travel_km_div').slideDown(200);
                } else {
                    $('.travel_km_div').slideUp(200);
                    $('.travel_km_div input').val('');
                }
            }).trigger('change');
        });

        let subCount = {{ $teacher->subjects->count() > 0 ? $teacher->subjects->count() : 1 }};
        let eduCount = {{ $teacher->educations->count() > 0 ? $teacher->educations->count() : 1 }};

        function addSubject() {
            let html = `
    <div class="subject-item bg-light p-3 rounded-3 mb-3 border position-relative">
        <span class="remove-btn" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></span>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label small fw-bold">Select Subject</label>
                <select name="subjects[${subCount}][id]" class="form-select select2-init">
                    <option value="">--Select--</option>
                    @foreach ($subjects as $subject) <option value="{{ $subject->id }}">{{ $subject->name }}</option> @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">Teaching From</label>
                <select name="subjects[${subCount}][from]" class="form-select">
                    <option>Primary School</option><option>Middle School</option><option>High School</option>
                    <option>O Level / IGCSE</option><option>A Level</option><option>Undergraduate</option><option>Masters / Professional</option>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">Teaching To</label>
                <select name="subjects[${subCount}][to]" class="form-select">
                    <option>Beginner</option><option>Intermediate</option><option>Advanced/Expert</option><option>Exam Preparation</option>
                </select>
            </div>
        </div>
    </div>`;
            $('#subject-wrapper').append(html);
            // Re-initialize select2 on the new element
            $(`select[name="subjects[${subCount}][id]"]`).select2({
                width: '100%'
            });
            subCount++;
        }

        function addEducation() {
            let html = `
    <div class="edu-item border-start border-primary border-4 bg-light p-3 rounded-3 mb-3 shadow-sm position-relative">
        <span class="remove-btn" onclick="this.parentElement.remove()"><i class="bi bi-x"></i></span>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label small fw-bold">Institution / University</label>
                <input type="text" name="edu[${eduCount}][institution]" class="form-control bg-white" placeholder="e.g. Oxford University">
            </div>
            <div class="col-md-6">
                <label class="form-label small fw-bold">Select education</label>
                <select name="edu[${eduCount}][edu]" class="form-select select2-init">
                    <option value="">--Select--</option>
                    @foreach ($educations as $edu)
                        <option value="{{ $edu->id }}">{{ $edu->degree }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">Start Year</label>
                <input type="number" name="edu[${eduCount}][start]" class="form-control bg-white" placeholder="YYYY">
            </div>
            <div class="col-md-4">
                <label class="form-label small fw-bold">End Year (or Expected)</label>
                <input type="number" name="edu[${eduCount}][end]" class="form-control bg-white" placeholder="YYYY">
            </div>
        </div>
    </div>`;
            $('#education-wrapper').append(html);
            // Re-initialize select2 on the new element
            $(`select[name="edu[${eduCount}][edu]"]`).select2({
                width: '100%'
            });
            eduCount++;
        }
    </script>
@endpush