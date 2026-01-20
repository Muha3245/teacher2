<form id="step3Form">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Expert Subjects</h5>
    </div>

    <!-- Input row for new/edit -->
    <div class="row g-3 mb-3">
        <div class="col-md-4">
            <label class="form-label">Subject ID</label>
            <select class="form-select selectsubject" id="subject_id_input" name="subject_id">
                <option value="">Select Subject</option>
                @foreach ($subjects as $sub)
                    <option value="{{ $sub->id }}">{{ $sub->name }}</option>
                @endforeach
            </select>
            {{-- <input type="text" id="subject_id_input" name="subject_id" class="form-control"> --}}
        </div>
        <div class="col-md-4">
            <label class="form-label">From Level</label>
            <input type="text" id="from_level_input" name="from_level" class="form-control">
        </div>
        <div class="col-md-4">
            <label class="form-label">To Level</label>
            <input type="text" id="to_level_input" name="to_level" class="form-control">
        </div>
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
    </div>
    <button type="button" class="btn btn-sm btn-outline-primary fw-bold mb-3" id="add-subject">+ Add Subject</button>

    <!-- Display added subjects -->
    <div id="subjects-list">
        @if (!empty($singleprofile) && $singleprofile->subjects->count())
            @foreach ($singleprofile->subjects as $i => $s)
                <div class="subject-box bg-warning bg-opacity-25 rounded-3 p-2 mb-2 d-flex justify-content-between align-items-center"
                    data-id="{{ $s->id }}" data-subject-id="{{ $s->subject_id }}">

                    <span>{{ $s->subject->name ?? 'Unknown Subject' }} | {{ $s->from_level }} →
                        {{ $s->to_level }}</span>
                    <div>
                        <i class="bi bi-pencil-square text-dark me-2 edit-subject" style="cursor:pointer"></i>
                        <i class="bi bi-x-circle text-danger delete-subject" style="cursor:pointer"></i>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-muted">No subjects added yet.</div>
        @endif
    </div>

</form>

@push('multistepteacherdashscripts')
    <script>
        let editIndex = null; // store editing subject-box index

        $('#subject_id_input').select2({
            tags: true,
            placeholder: 'Select or add subject',
            width: '100%',
            tokenSeparators: [','],
        });

        // Add or Update Subject
        $('#add-subject').on('click', function(e) {
            e.preventDefault();

            let user_id = $('input[name="user_id"]').val();
            let subject_id = $('#subject_id_input').val();
            let from_level = $('#from_level_input').val();
            let to_level = $('#to_level_input').val();

            if (!subject_id || !from_level || !to_level) {
                toastr.error('Please fill all fields to add a subject');
                return;
            }

            let url = '/api/stepthree';
            let data = {
                user_id: user_id,
                subject_id: subject_id,
                from_level: from_level,
                to_level: to_level
            };

            // If we are editing, pass edit flag and existing subject-profile-id
            if (editIndex !== null) {
                const box = $('#subjects-list .subject-box').eq(editIndex);
                data.edit = true;
                data.subject_profile_id = box.data('id'); // store subject_profile_id in box data-id
            }

            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);

                        // Remove placeholder if exists
                        $('#subjects-list .text-muted').remove();

                        if (editIndex !== null) {
                            // Update existing box
                            const box = $('#subjects-list .subject-box').eq(editIndex);
                            box.html(`
                        <span>${res.subject_name} | ${res.from_level} → ${res.to_level}</span>
                        <div>
                            <i class="bi bi-pencil-square text-dark me-2 edit-subject" style="cursor:pointer"></i>
                            <i class="bi bi-x-circle text-danger delete-subject"  style="cursor:pointer"></i>
                        </div>
                    `);
                            box.data('id', res.subject_profile_id);

                            // Reset button & index
                            $('#add-subject').text('+ Add Subject');
                            editIndex = null;
                        } else {
                            // Add new box
                            const i = $('#subjects-list .subject-box').length;
                            const newHtml = $(`
                        <div class="subject-box bg-warning bg-opacity-25 rounded-3 p-2 mb-2 d-flex justify-content-between align-items-center" data-id="${res.subject_profile_id}" data-subject-id="${res.subject_id}">
                            <span>${res.subject_name} | ${res.from_level} → ${res.to_level}</span>
                            <div>
                                <i class="bi bi-pencil-square text-dark me-2 edit-subject" style="cursor:pointer"></i>
                                <i class="bi bi-x-circle text-danger delete-subject" style="cursor:pointer"></i>
                            </div>
                        </div>
                    `);
                            $('#subjects-list').append(newHtml);
                        }

                        // Clear inputs
                        $('#subject_id_input').val(null).trigger('change');
                        $('#from_level_input').val('');
                        $('#to_level_input').val('');
                    }
                },
                error: function(err) {
                    toastr.error('Something went wrong!');
                }
            });
        });

        // Edit Subject
        $(document).on('click', '.edit-subject', function() {
            const box = $(this).closest('.subject-box');
            editIndex = box.index(); // store index for update

            const text = box.find('span').text(); // format: "subject_name | from → to"
            const parts = text.split('|');
            const subjectName = parts[0].trim();
            const levels = parts[1].split('→');
            const from = levels[0].trim();
            const to = levels[1].trim();

            // If exists in select2, select it; if new, add tag
            if ($('#subject_id_input option').filter(function() {
                    return $(this).text() == subjectName;
                }).length === 0) {
                const newOption = new Option(subjectName, subjectName, true, true);
                $('#subject_id_input').append(newOption).trigger('change');
            } else {
                $('#subject_id_input').val($('#subject_id_input option').filter(function() {
                    return $(this).text() == subjectName;
                }).val()).trigger('change');
            }

            $('#from_level_input').val(from);
            $('#to_level_input').val(to);

            $('#add-subject').text('Update Subject');
        });

        // Delete Subject
        $(document).on('click', '.delete-subject', function() {
            const box = $(this).closest('.subject-box');
            const subjectProfileId = box.data('id');

            if (!subjectProfileId) {
                toastr.warning('This subject is not saved yet.');
                return;
            }

            if (confirm('Are you sure you want to delete this subject?')) {
                $.ajax({
                    url: '/api/stepthree/delete', // create API route for deleting
                    type: 'POST',
                    data: {
                        subject_profile_id: subjectProfileId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(res) {
                        if (res.status) {
                            toastr.success(res.message);
                            box.remove();
                            if ($('#subjects-list .subject-box').length === 0) {
                                $('#subjects-list').html(
                                    '<div class="text-muted">No subjects added yet.</div>');
                            }
                        }
                    },
                    error: function(err) {
                        toastr.error('Could not delete subject');
                    }
                });
            }
        });
    </script>
@endpush
