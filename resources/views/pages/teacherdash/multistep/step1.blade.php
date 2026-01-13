<form id="step1Form">
    <div class="text-center mb-4">
        <div class="profile-pic-wrapper" onclick="document.getElementById('profile_picture').click()">
            <img id="imgPreview" src="#" alt="Preview" class="d-none">
            <div id="uploadPlaceholder">
                <i class="bi bi-person-bounding-box fs-1 text-muted"></i>
                <span class="d-block small fw-bold">Add Photo</span>
            </div>
            <input type="file" id="profile_picture" name="profile_picture" class="d-none" accept="image/*">
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <label class="form-label">Full Name</label>
            <input type="text" name="full_name" class="form-control" placeholder="John Doe">
        </div>
        <div class="col-md-6">
            <label class="form-label">Gender</label>
            <select name="gender" class="form-select select-2">
                <option value="">Select Gender</option>
                <option>Male</option>
                <option>Female</option>
                <option>Prefer not to say</option>
            </select>
        </div>
        <div class="col-md-6">
            <label class="form-label">Birth Date</label>
            <input type="date" name="birth_date" class="form-control">
        </div>
        <div class="col-md-6">
            <label class="form-label">Location ID (City/Region)</label>
            <input type="text" name="location_id" class="form-control" placeholder="e.g., 101">
        </div>
        <div class="col-12">
            <label class="form-label">Full Residential Address</label>
            <input type="text" name="address" class="form-control" placeholder="Apartment, Street, City">
        </div>
    </div>
</form>

@push('multistepteacherdashscripts')
    <script>
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
        $('#step1Form').validate({
            rules: {
                full_name: {
                    required: true,
                    minlength: 3
                },
                gender: {
                    required: true
                },
                birth_date: {
                    required: true,
                    date: true
                },
                location_id: {
                    required: true
                },
                address: {
                    required: true,
                    minlength: 10
                },
                profile_picture: {
                    required: true
                }
            },
            messages: {
                full_name: {
                    required: "Full name is required",
                    minlength: "Name must be at least 3 characters"
                },
                gender: {
                    required: "Please select gender"
                },
                birth_date: {
                    required: "Birth date is required"
                },
                location_id: {
                    required: "Location is required"
                },
                address: {
                    required: "Address is required",
                    minlength: "Address must be at least 10 characters"
                },
                profile_picture: {
                    required: "Profile picture is required"
                }
            },
            errorElement: 'small',
            errorClass: 'text-danger',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            }

        });
        $('#nextBtn').click(function() {
            // Only save if this is Step 1
            if (currentStep === 0 && $('#step1Form').valid()) {
                const step1Data = {
                    full_name: $('input[name="full_name"]').val(),
                    gender: $('select[name="gender"]').val(),
                    birth_date: $('input[name="birth_date"]').val(),
                    location_id: $('input[name="location_id"]').val(),
                    address: $('input[name="address"]').val(),
                    // Save the file name (actual file will be submitted at final step)
                    profile_picture: $('#profile_picture')[0].files[0] ? $('#profile_picture')[0].files[
                        0].name : ''
                };
                localStorage.setItem('step_0', JSON.stringify(step1Data));
            }
        });
    </script>
@endpush
