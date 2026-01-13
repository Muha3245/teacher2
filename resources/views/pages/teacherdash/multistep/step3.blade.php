<form id="step3Form">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Expert Subjects</h5>
    </div>

    <!-- Input row for new/edit -->
    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <label class="form-label">Subject ID</label>
            <input type="text" id="subject_id_input" name="subject_id" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">From Level</label>
            <input type="text" id="from_level_input" name="from_level" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">To Level</label>
            <input type="text" id="to_level_input" name="to_level" class="form-control">
        </div>
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary fw-bold mb-3" id="add-subject">+ Add Subject</button>

    <!-- Display added subjects -->
    <div id="subjects-list"></div>
</form>

@push('multistepteacherdashscripts')
    <script>
        let subjects = JSON.parse(localStorage.getItem('step_2') || '{"subjects": []}').subjects;

        // Initialize jQuery Validate
        if (subjects.length === 0) {
            $('#step3Form').validate({
                rules: {
                    subject_id: {
                        required: true,
                        minlength: 3
                    },
                    from_level: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    to_level: {
                        required: true,
                        number: true,
                        min: function() {
                            return parseInt($('#from_level_input').val()) || 1;
                        }
                    }
                },
                messages: {
                    subject_id: {
                        required: "Subject is required",
                        minlength: "Must be at least 3 characters"
                    },
                    from_level: {
                        required: "From Level is required",
                        number: "Enter a valid number",
                        min: "Minimum is 1"
                    },
                    to_level: {
                        required: "To Level is required",
                        number: "Enter a valid number",
                        min: "Must be >= From Level"
                    }
                },
                errorElement: 'small',
                errorClass: 'text-danger',
                highlight: function(el) {
                    $(el).addClass('is-invalid');
                },
                unhighlight: function(el) {
                    $(el).removeClass('is-invalid');
                }
            });
        }


        // Render subjects
        function renderSubjects() {
            $('#subjects-list').empty();
            subjects.forEach((s, i) => {
                $('#subjects-list').append(`
            <div class="subject-box bg-warning bg-opacity-25 rounded-3 p-2 mb-2 d-flex justify-content-between align-items-center">
                <span>${s.subject_id} | ${s.from_level} → ${s.to_level}</span>
                <div>
                    <i class="bi bi-pencil-square text-dark me-2 edit-subject" data-index="${i}" style="cursor:pointer"></i>
                    <i class="bi bi-x-circle text-danger delete-subject" data-index="${i}" style="cursor:pointer"></i>
                </div>
            </div>
        `);
            });
            localStorage.setItem('step_2', JSON.stringify({
                subjects
            }));
        }

        // Add or update subject
        $('#add-subject').click(function() {
            // Validate inputs first
            if (!$('#step3Form').valid()) return;

            const subject_id = $('#subject_id_input').val().trim();
            const from_level = $('#from_level_input').val().trim();
            const to_level = $('#to_level_input').val().trim();

            const editIndex = $(this).data('editIndex');
            if (editIndex !== undefined) {
                subjects[editIndex] = {
                    subject_id,
                    from_level,
                    to_level
                };
                $(this).removeData('editIndex').text('+ Add Subject');
            } else {
                subjects.push({
                    subject_id,
                    from_level,
                    to_level
                });
            }

            // Reset inputs
            $('#subject_id_input').val('');
            $('#from_level_input').val('');
            $('#to_level_input').val('');
            

            renderSubjects();
        });

        // Edit subject
        $(document).on('click', '.edit-subject', function() {
            const i = $(this).data('index');
            const s = subjects[i];
            $('#subject_id_input').val(s.subject_id);
            $('#from_level_input').val(s.from_level);
            $('#to_level_input').val(s.to_level);
            $('#add-subject').data('editIndex', i).text('Update Subject');
        });

        // Delete subject
        $(document).on('click', '.delete-subject', function() {
            const i = $(this).data('index');
            subjects.splice(i, 1);
            renderSubjects();
        });

        // Next button click
        console.log(subjects.length)


        renderSubjects();
    </script>
@endpush
