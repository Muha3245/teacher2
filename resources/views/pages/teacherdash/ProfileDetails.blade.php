@extends('layouts.teacherdash')

@section('content')
    <div id="page-content">
        <div class="container-fluid px-4">
            <div class="d-flex align-items-center justify-content-between">
                <h3 class="mt-4 mb-3 fw-bold">My Profile</h3>
                <button class="btn btn-primary btn-sm rounded-pill px-3"><i class="fas fa-eye me-1"></i> Public View</button>
            </div>

            {{-- @dd($profile) --}}
            @if ($profile)
                
                    <div class="row">
                        <div class="col-xl-3 col-lg-4">
                            <div class="card shadow-sm border-0 text-center p-4 mb-4">
                                <div class="position-relative d-inline-block mx-auto">
                                    <img src="{{ asset($profile->profile_picture) }}"
                                        class="rounded-circle border p-1"
                                        style="width: 120px; height: 120px; object-fit: cover;">
                                    <button
                                        class="btn btn-sm btn-light position-absolute bottom-0 end-0 rounded-circle shadow-sm"
                                        data-bs-toggle="modal" data-bs-target="#editPhotoModal{{ $profile->id }}">
                                        <i class="fas fa-camera text-primary"></i>
                                    </button>
                                </div>
                                <h5 class="fw-bold mt-3 mb-0">{{ $profile->full_name }}</h5>
                                <p class="text-muted small">{{ $profile->headline }}</p>
                                <hr>
                                <div class="text-start small">
                                    <form class="ajaxForm"
                                        data-url="{{ route('teacher.profile.preferences') }}"data-id="{{ $profile->id }}">
                                        @csrf
                                        @method('PUT')

                                        {{-- Willing to travel --}}
                                        {{-- <input type="hidden" name="willing_to_travel" value="0"> --}}

                                        <input type="checkbox" class="form-check-input ms-0 me-2" id="willing_to_travel"
                                            name="willing_to_travel" value="1"
                                            {{ old('willing_to_travel', $profile->willing_to_travel) ? 'checked' : '' }}>

                                        <label class="form-check-label" for="willing_to_travel">
                                            Willing to Travel
                                        </label>

                                        {{-- Travel KM --}}
                                        <input type="number" class="form-control mt-2" id="travelkm" name="travel_km"
                                            value="{{ $profile->travel_km }}" placeholder="Traveling KM">

                                        <hr>

                                        {{-- Digital Pen --}}
                                        {{-- <input type="hidden" name="has_digital_pen" value="0"> --}}
                                        <input type="checkbox" class="form-check-input ms-0 me-2" id="has_digital_pen"
                                            name="has_digital_pen" value="1"
                                            {{ old('has_digital_pen', $profile->has_digital_pen) ? 'checked' : '' }}>

                                        <label class="form-check-label" for="has_digital_pen">Digital Pen</label>
                                        <br>

                                        {{-- Helps Homework --}}
                                        {{-- <input type="hidden" name="helps_homework" value="0"> --}}
                                        <input type="checkbox" class="form-check-input ms-0 me-2" id="helps_homework"
                                            name="helps_homework" value="1"
                                            {{ old('helps_homework', $profile->helps_homework) ? 'checked' : '' }}>

                                        <label class="form-check-label" for="helps_homework">Helps Homework</label>
                                    </form>


                                    <p class="mb-1"><i class="fas fa-map-marker-alt me-2 text-primary"></i>
                                        {{ $profile->location ?? 'N/A' }}</p>
                                    <p class="mb-0"><i class="fas fa-calendar-alt me-2 text-primary"></i> Joined
                                        {{ $profile->created_at->format('M Y') }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-9 col-lg-8">
                            <div class="card shadow-sm border-0 mb-4">
                                <div
                                    class="card-header bg-white border-0 p-0 d-flex justify-content-between align-items-center pe-3">
                                    <ul class="nav nav-tabs profile-tabs border-bottom-0" id="profileTab" role="tablist">
                                        <li class="nav-item"><button class="nav-link active" id="personal-tab"
                                                data-bs-toggle="tab" data-bs-target="#personal{{ $profile->id }}"
                                                type="button">Personal
                                                Info</button></li>
                                        <li class="nav-item"><button class="nav-link" id="subjects-tab" data-bs-toggle="tab"
                                                data-bs-target="#subjects{{ $profile->id }}"
                                                type="button">Subjects</button></li>
                                        <li class="nav-item"><button class="nav-link" id="edu-tab" data-bs-toggle="tab"
                                                data-bs-target="#edu{{ $profile->id }}"
                                                type="button">Education</button>
                                        </li>
                                        <li class="nav-item"><button class="nav-link" id="other-tab" data-bs-toggle="tab"
                                                data-bs-target="#other{{ $profile->id }}" type="button">Other
                                                Details</button></li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="tab-content" id="profileTabContent">

                                        <!-- Personal Info Tab -->
                                        <div class="tab-pane fade show active" id="personal{{ $profile->id }}"
                                            role="tabpanel">
                                            <div class="d-flex justify-content-between mb-3">
                                                <h6 class="fw-bold">Basic Information</h6>
                                                <button class="btn btn-sm btn-outline-primary border-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editPersonalModal{{ $profile->id }}"><i
                                                        class="fas fa-edit"></i>
                                                    Edit</button>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-6">
                                                    <label class="text-muted small fw-bold">Gender</label>
                                                    <p class="fw-bold text-dark">{{ $profile->gender }}</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="text-muted small fw-bold">Birth Date</label>
                                                    <p class="fw-bold text-dark">
                                                        {{ \Carbon\Carbon::parse($profile->birth_date)->format('F j, Y') }}
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="text-muted small fw-bold">Teaching Experience</label>
                                                    <p class="fw-bold text-dark">{{ $profile->years_teaching }}
                                                        Years
                                                    </p>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="text-muted small fw-bold">Hourly Rate</label>
                                                    <p class="fw-bold text-dark">${{ $profile->min_price }} -
                                                        ${{ $profile->max_price }}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Subjects Tab -->
                                        <div class="tab-pane fade" id="subjects{{ $profile->id }}"
                                            role="tabpanel">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="fw-bold mb-0">Teaching Subjects</h6>
                                                <button class="btn btn-primary btn-sm rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addSubjectModal{{ $profile->id }}"><i
                                                        class="fas fa-plus"></i> Add
                                                    New</button>
                                            </div>
                                            @foreach ($profile->subjects as $subject)
                                                {{-- @dd($subject) --}}
                                                <div class="item-card d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <span
                                                            class="fw-bold text-dark">{{ $subject->subject->name }}</span>
                                                        <span
                                                            class="badge bg-light text-primary ms-2">{{ $subject->from_level }}
                                                            - {{ $subject->to_level }}</span>
                                                    </div>
                                                    <button class="btn btn-sm edit-btn" data-bs-toggle="modal"
                                                        data-bs-target="#editSubjectModal{{ $subject->id }}">
                                                        <i class="fas fa-edit text-primary"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Education Tab -->
                                        <div class="tab-pane fade" id="edu{{ $profile->id }}" role="tabpanel">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="fw-bold mb-0">Academic Background</h6>
                                                <button class="btn btn-primary btn-sm rounded-pill px-3"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#addEduModal{{ $profile->id }}"><i
                                                        class="fas fa-plus"></i> Add New</button>
                                            </div>
                                            @foreach ($profile->educations as $education)
                                                <div class="item-card d-flex justify-content-between">
                                                    <div>
                                                        <p class="fw-bold mb-0 text-primary">{{ $education->degree_name }}
                                                        </p>
                                                        <p class="mb-0 small text-dark">{{ $education->institution }}
                                                        </p>
                                                        <small class="text-muted">start Year:
                                                            {{ $education->start_year }} - end Year:
                                                            {{ $education->end_year}}</small>
                                                    </div>
                                                    <button class="btn btn-sm edit-btn" data-bs-toggle="modal"
                                                        data-bs-target="#editEduModal{{ $education->id }}">
                                                        <i class="fas fa-edit text-primary"></i>
                                                    </button>
                                                </div>
                                            @endforeach
                                        </div>

                                        <!-- Other Details Tab -->
                                        <div class="tab-pane fade" id="other{{ $profile->id }}" role="tabpanel">
                                            <div class="d-flex justify-content-between mb-3">
                                                <h6 class="fw-bold">Contact Details</h6>
                                                <button class="btn btn-sm btn-outline-primary border-0"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editOtherModal{{ $profile->id }}"><i
                                                        class="fas fa-edit"></i> Edit</button>
                                            </div>
                                            @foreach ($profile->phones as $phone)
                                                <div class="item-card d-flex align-items-center">
                                                    <i class="fas fa-phone-alt text-muted me-3"></i>
                                                    <div>
                                                        <p class="mb-0 fw-bold">{{ $phone->country_code }}
                                                            {{ $phone->phone }}</p>
                                                        @if ($phone->is_primary)
                                                            <span class="badge bg-success small">Primary</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                                <div class="item-card d-flex align-items-center">
                                                    <i class="fas fa-coins text-muted me-3"></i>
                                                    <div>
                                                        <p class="mb-0 fw-bold">{{ $profile->charge_period }}
                                                            (min{{ $profile->min_price }}-max{{ $profile->max_price }})
                                                        </p>
                                                        
                                                    </div>
                                                </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- =================== ALL MODALS =================== --}}
                    @php
                        $teacherId = $profile->id;
                    @endphp

                    {{-- Edit Photo Modal --}}
                    <div class="modal fade" id="editPhotoModal{{ $teacherId }}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Edit Profile Photo</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form class="ajaxForm" data-url="{{ route('teacher.profile.photo') }}" method="POST" enctype="multipart/form-data"
                                    data-id="{{ $teacherId }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <input type="file" value="{{asset($profile->profile_picture)}}" name="profile_picture" class="form-control">
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    {{-- Edit Personal Modal --}}
                    <div class="modal fade" id="editPersonalModal{{ $teacherId }}" tabindex="-1"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content border-0 shadow">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Edit Personal Info</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <form class="ajaxForm" data-url="{{ route('teacher.profile.info') }}"
                                    data-id="{{ $teacherId }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body">
                                        <div class="row g-3">
                                            <div class="col-12">
                                                <label class="form-label small fw-bold">full name</label>
                                                <input type="text" name="full_name" class="form-control"
                                                    value="{{ $profile->full_name }}">
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label small fw-bold">Headline</label>
                                                <input type="text" name="headline" class="form-control"
                                                    value="{{ $profile->headline }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold">Gender</label>
                                                <select name="gender" class="form-select">
                                                    <option value="N/A"
                                                        {{ $profile->gender == 'N/A' ? 'selected' : '' }}>N/A
                                                    </option>
                                                    <option value="Male"
                                                        {{ $profile->gender == 'male' ? 'selected' : '' }}>Male
                                                    </option>
                                                    <option value="Female"
                                                        {{ $profile->gender == 'female' ? 'selected' : '' }}>Female
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label small fw-bold">Experience (Years)</label>
                                                <input type="number" name="years_teaching" class="form-control"
                                                    value="{{ $profile->years_teaching }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer border-0">
                                        <button type="button" class="btn btn-light"
                                            data-bs-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @include('pages.teacherdash.modals.subjectmodal')
                    @include('pages.teacherdash.modals.educationmodal' )
                    @include('pages.teacherdash.modals.phonesmodal')
            @endif
        </div>

        @push('frontendscripts')
            {{-- AJAX Script for all forms --}}
            <script>
                $(document).on('submit', '.ajaxForm', function(e) {
                    e.preventDefault();

                    let form = $(this);
                    let url = form.data('url');
                    let data = new FormData(this);

                    Swal.showLoading();

                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: data,
                        processData: false,
                        contentType: false,

                        success: res => {
                            Swal.fire({
                                icon: 'success',
                                text: res.message,
                                timer: 2000,
                                showConfirmButton: false
                            });
                            $('.modal.show').modal('hide');
                            location.reload();
                        },

                        error: xhr => {
                            // Swal.fire({
                            //     icon: 'error',
                            //     text: xhr.responseJSON?.message || 'Error'
                            // });
                            alert(xhr.responseJSON?.message || 'Error');
                        }
                    });
                });
            </script>
            <script>
                $(function() {
                    function toggleTravelKm() {
                        if ($('#willing_to_travel').is(':checked')) {
                            $('#travelkm').show().prop('required', true);
                        } else {
                            $('#travelkm').hide().val('').prop('required', false);
                        }
                    }

                    toggleTravelKm();

                    $('#willing_to_travel').on('change', function() {
                        toggleTravelKm();
                        $(this).closest('form').trigger('submit');
                    });

                    $(' #has_digital_pen, #helps_homework').on('change', function() {
                       $(this).closest('form').trigger('submit');
                    });

                    $('.select2-subject').select2({
                        width: '100%',
                        tags: true,
                        placeholder: 'Search or type subject',
                        allowClear: true,
                        tokenSeparators: [',']
                    });
                });
            </script>
        @endpush

    </div>
@endsection
