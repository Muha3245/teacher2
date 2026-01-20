<form id="step6Form">
    @csrf
    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

    <div class="mb-4">
        <label class="form-label fw-bold">Opportunity Preference</label>
        <select name="opportunity" id="opportunity" class="form-select">
            <option value="">Select Preference</option>
            <option value="full_time"
                {{ isset($singleprofile) && $singleprofile->opportunity == 'full_time' ? 'selected' : '' }}>Full Time
            </option>
            <option value="part_time"
                {{ isset($singleprofile) && $singleprofile->opportunity == 'part_time' ? 'selected' : '' }}>Part Time
            </option>
            <option value="both"
                {{ isset($singleprofile) && $singleprofile->opportunity == 'both' ? 'selected' : '' }}>Both (Full &
                Part Time)</option>
        </select>
        <small class="text-danger d-none" id="error-opportunity"></small>
    </div>

    <div class="mb-3">
        <label class="form-label fw-bold">Full Profile Description</label>
        <textarea name="profile_description" id="profile_description" class="form-control" rows="8"
            placeholder="Tell students about your teaching methodology, success stories, and what makes you unique...">{{ $singleprofile->profile_description ?? '' }}</textarea>
        <small class="text-danger d-none" id="error-profile_description"></small>
        <div class="text-muted small mt-1">Minimum 50 characters recommended.</div>
    </div>
</form>
@push('multistepteacherdashscripts')
    <script>
        function step6Form(e) {
            e.preventDefault();
            let opportunity = $('#opportunity').val().trim();
            let description = $('#profile_description').val().trim();
            let isValid = true;

            // Reset errors
            $('.text-danger').addClass('d-none').text('');

            if (opportunity === "") {
                $('#error-opportunity').removeClass('d-none').text('Please enter your preference.');
                isValid = false;
            }

            if (description.length < 20) {
                $('#error-profile_description').removeClass('d-none').text('Description should be at least 20 characters.');
                isValid = false;
            }

            if (!isValid) return;

            // 2. Prepare Payload
            const payload = {
                opportunity: opportunity,
                profile_description: description,
                user_id: $('input[name="user_id"]').val(),
                _token: '{{ csrf_token() }}'
            };

            // 3. AJAX Request
            $.ajax({
                url: '/api/stepsix', // Your route
                type: 'POST',
                data: payload,
                beforeSend: function() {
                    $('#save-step-6').prop('disabled', true).html(
                        '<span class="spinner-border spinner-border-sm"></span> Saving...');
                },
                success: function(res) {
                    if (res.status) {
                        toastr.success('Profile completed successfully!');
                        // Optionally redirect to dashboard or next view
                        // window.location.href = "/teacher/dashboard";
                    } else {
                        toastr.error(res.message || 'Something went wrong');
                    }
                },
                error: function(xhr) {
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        if (errors.opportunity) $('#error-opportunity').removeClass('d-none').text(errors
                            .opportunity[0]);
                        if (errors.profile_description) $('#error-profile_description').removeClass('d-none')
                            .text(errors.profile_description[0]);
                    } else {
                        toastr.error('Server error. Please try again.');
                    }
                },
                complete: function() {
                    $('#save-step-6').prop('disabled', false).text('Save & Finish');
                }
            });
        }
    </script>
@endpush
