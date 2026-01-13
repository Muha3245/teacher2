<form id="step5Form">
    <div class="mb-4">
        <label class="form-label">Opportunity Preference</label>
        <input type="text" name="opportunity" class="form-control"
            placeholder="e.g., Looking for private coaching or school contracts">
    </div>
    <div class="mb-3">
        <label class="form-label">Full Profile Description</label>
        <textarea name="profile_description" class="form-control" rows="8"
            placeholder="Tell students about your teaching methodology, success stories, and what makes you unique..."></textarea>
    </div>
</form>
@push('multistepteacherdashscripts')
    <script>
        $(document).ready(function() {

            /* ===============================
               Step 5 Validation
            =============================== */
            $('#step5Form').validate({
                rules: {
                    opportunity: {
                        required: true,
                        minlength: 5
                    },
                    profile_description: {
                        required: true,
                        minlength: 20
                    }
                },
                messages: {
                    opportunity: {
                        required: "Opportunity Preference is required",
                        minlength: "Please enter at least 5 characters"
                    },
                    profile_description: {
                        required: "Profile Description is required",
                        minlength: "Please enter at least 20 characters"
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

            /* ===============================
               Submit Button Click
            =============================== */
            $('#submitBtn').on('click', function() {

                // Validate step 5
                if (!$('#step5Form').valid()) {
                    return;
                }

                /* ===============================
                   Save Step 5 to localStorage
                =============================== */
                const step5Data = {
                    opportunity: $('input[name="opportunity"]').val(),
                    profile_description: $('textarea[name="profile_description"]').val()
                };
                localStorage.setItem('step_4', JSON.stringify(step5Data));

                /* ===============================
                   Collect ALL Steps
                =============================== */
                const allStepsData = {};
                for (let i = 0; i < 5; i++) {
                    allStepsData['step' + (i + 1)] =
                        JSON.parse(localStorage.getItem('step_' + i) || '{}');
                }

                console.log('Final Payload:', allStepsData);

                // console.log(auth()->id());
                /* ===============================
                   Send Data via AJAX (Fetch)
                =============================== */
                let formData = new FormData();

                // Append the profile picture
                let fileInput = document.querySelector('#profile_picture');
                if (fileInput.files.length > 0) {
                    formData.append('profile_picture', fileInput.files[0]);
                }

                // Append all your steps as JSON strings
                formData.append('step1', JSON.stringify(allStepsData.step1));
                formData.append('step2', JSON.stringify(allStepsData.step2));
                formData.append('step3', JSON.stringify(allStepsData.step3));
                formData.append('step4', JSON.stringify(allStepsData.step4));
                formData.append('step5', JSON.stringify(allStepsData.step5));
                formData.append('user_id', userid);
                $.ajax({
                    url: '/api/multistep-profile', // Your API route
                    type: 'POST',
                    credentials: 'include',
                    data:  formData, // Your data object
                    contentType: false,
                    processData: false,
                    dataType: 'json', // Expect JSON response
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // CSRF token
                    },
                    success: function(res) {
                        console.log('Success:', res);
                        alert('Profile saved successfully!');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', xhr.responseText);
                        alert('Something went wrong!');
                    }
                });



            });
        });
    </script>
@endpush
