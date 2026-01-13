<form id="step4Form">
    <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
        <h5 class="fw-bold mb-0">Education History</h5>
    </div>

    <!-- Input row for new/edit -->
    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <label class="form-label">Education ID</label>
            <input type="text" id="education_id_input" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Field of Study</label>
            <input type="text" id="field_input" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Institution</label>
            <input type="text" id="institution_input" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Year Completed</label>
            <input type="number" id="year_completed_input" class="form-control">
        </div>
    </div>

    <button type="button" class="btn btn-sm btn-outline-primary fw-bold mb-3" id="add-education">+ Add
        Education</button>

    <!-- Display added educations -->
    <div id="educations-list"></div>
</form>

@push('multistepteacherdashscripts')
    <script>
        // Load educations from localStorage
        // Load educations from localStorage
        let educations = JSON.parse(localStorage.getItem('step_3') || '{"educations": []}').educations;

        // Initialize jQuery Validate for dynamic input
        $('#step4Form').validate({
            rules: {
                education_id_input: {
                    required: true,
                    minlength: 2
                },
                field_input: {
                    required: true,
                    minlength: 3
                },
                institution_input: {
                    required: true,
                    minlength: 3
                },
                year_completed_input: {
                    required: true,
                    digits: true,
                    min: 1900,
                    max: new Date().getFullYear()
                }
            },
            messages: {
                education_id_input: {
                    required: "Education ID is required",
                    minlength: "Education ID must be at least 2 characters"
                },
                field_input: {
                    required: "Field of Study is required",
                    minlength: "Field must be at least 3 characters"
                },
                institution_input: {
                    required: "Institution is required",
                    minlength: "Institution must be at least 3 characters"
                },
                year_completed_input: {
                    required: "Year Completed is required",
                    digits: "Enter a valid year",
                    min: "Year cannot be before 1900",
                    max: `Year cannot be after ${new Date().getFullYear()}`
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

        // Render education boxes
        function renderEducations() {
            $('#educations-list').empty();
            educations.forEach((edu, index) => {
                $('#educations-list').append(`
        <div class="education-box bg-warning bg-opacity-25 rounded-3 p-2 mb-2 d-flex justify-content-between align-items-center">
            <span>${edu.education_id} | ${edu.field} | ${edu.institution} | ${edu.year_completed}</span>
            <div>
                <i class="bi bi-pencil-square text-dark me-2 edit-education" data-index="${index}" style="cursor:pointer"></i>
                <i class="bi bi-x-circle text-danger delete-education" data-index="${index}" style="cursor:pointer"></i>
            </div>
        </div>`);
            });
            localStorage.setItem('step_3', JSON.stringify({
                educations
            }));
        }

        // Add or Update Education
        $('#add-education').click(function() {
            if (!$('#step4Form').valid()) {
                return;
            }
            

            const education = {
                education_id: $('#education_id_input').val().trim(),
                field: $('#field_input').val().trim(),
                institution: $('#institution_input').val().trim(),
                year_completed: $('#year_completed_input').val().trim()
            };

            const editIndex = $(this).data('editIndex');
            if (editIndex !== undefined) {
                educations[editIndex] = education;
                $(this).removeData('editIndex').text('+ Add Education');
            } else {
                educations.push(education);
            }

            // Reset form
            $('#education_id_input').val('');
            $('#field_input').val('');
            $('#institution_input').val('');
            $('#year_completed_input').val('');

            renderEducations();
        });

        // Edit education
        $(document).on('click', '.edit-education', function() {
            const index = $(this).data('index');
            const edu = educations[index];
            $('#education_id_input').val(edu.education_id);
            $('#field_input').val(edu.field);
            $('#institution_input').val(edu.institution);
            $('#year_completed_input').val(edu.year_completed);
            $('#add-education').data('editIndex', index).text('Update Education');
            
        });

        // Delete education
        $(document).on('click', '.delete-education', function() {
            const index = $(this).data('index');
            educations.splice(index, 1);
            renderEducations();
        });

       

        // Initial render
        renderEducations();
    </script>
@endpush
