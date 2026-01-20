<form id="step1Form" method="post" enctype="multipart/form-data">
    <div class="text-center mb-4">
        <div class="profile-pic-wrapper" onclick="document.getElementById('profile_picture').click()">
            @if (!empty($singleprofile->profile_picture))
                <img id="imgPreview" src="{{ $singleprofile->profile_picture }}" alt="Preview">
            @else
                <img id="imgPreview" src="#" alt="Preview" class="d-none">
            @endif
            <img id="imgPreview" src="#" alt="Preview" class="d-none">
            <div id="uploadPlaceholder">
                <i class="bi bi-person-bounding-box fs-1 text-muted"></i>
                <span class="d-block small fw-bold">Add Photo</span>
            </div>
            <input type="file" id="profile_picture" name="profile_picture" class="d-none" accept="image/*">
            <input type="hidden" id="" name="user_id" value='{{ auth()->id() }}'>

        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" value="{{ old('full_name', optional($singleprofile)->full_name) }}"
                class="form-control" placeholder="John Doe">
        </div>

        <div class="col-md-6">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select select-2">
                <option value="">Select Gender</option>
                <option value="male"
                    {{ old('gender', optional($singleprofile)->gender) == 'male' ? 'selected' : '' }}>Male</option>
                <option value="female"
                    {{ old('gender', optional($singleprofile)->gender) == 'female' ? 'selected' : '' }}>Female</option>
                <optio value="other"
                    {{ old('gender', optional($singleprofile)->gender) == 'other' ? 'selected' : '' }}>Prefer not to say
                    </option>
            </select>
        </div>

        <div class="col-md-6">
            <label class="form-label">Birth Date</label>
            <input type="date" name="birth_date"
                value="{{ old('birth_date', optional($singleprofile)->birth_date ?? '') }}" class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">Location ID (City/Region)</label>
            <input type="text" name="location" value="{{ old('location', optional($singleprofile)->location) }}"
                class="form-control" placeholder="e.g., 101">
        </div>

        <div class="col-12">
            <label class="form-label">Full Residential Address</label>
            <input type="text" name="address" value="{{ old('address', optional($singleprofile)->address) }}"
                class="form-control" placeholder="Apartment, Street, City">
        </div>
    </div>
</form>
@push('multistepteacherdashscripts')
    <script>
        // Preview profile picture
        $('#profile_picture').change(function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    $('#imgPreview').attr('src', event.target.result).removeClass('d-none');
                    $('#uploadPlaceholder').addClass('d-none');
                }
                reader.readAsDataURL(file);
            }
        });

        function step1ajax(e) {
            e.preventDefault();
            let formData = new FormData($('#step1Form')[0]);
            $.ajax({
                url: '/api/stepone',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        currentStep++;
                        showStep(currentStep);

                        // Option 3: Update form fields / preview
                        console.log(res.profile);
                    }
                },
                error: function(err) {
                    if (err.responseJSON && err.responseJSON.errors) {
                        // Show first validation error
                        let errors = err.responseJSON.errors;
                        for (let key in errors) {
                            toastr.error(errors[key][0]);
                            break;
                        }
                    } else {
                        toastr.error('Something went wrong!');
                    }
                }
            });

        }
    </script>
@endpush
