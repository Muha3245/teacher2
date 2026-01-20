<form id="step4Form">
    @csrf <input type="hidden" id="editing_id" value="">
    <div class="d-flex justify-content-between align-items-center mb-3 mt-5">
        <h5 class="fw-bold mb-0">Education History</h5>
    </div>

    <div class="row g-3 mb-3">
        <div class="col-md-3">
            <label class="form-label">Education ID</label>
            <select class="form-select selectsubject" id="education_id_input" name="education_id">
                <option value="">Select Subject</option>
                @foreach ($educations as $edu)
                    <option value="{{ $edu->id }}">{{ $edu->degree }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label class="form-label">Field of Study</label>
            <input type="text" id="field_input" name="field" class="form-control">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        </div>
        <div class="col-md-3">
            <label class="form-label">Institution</label>
            <input type="text" id="institution_input" name="institution" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">Start Year</label>
            <input type="number" id="start_year" name="start_year" class="form-control">
        </div>
        <div class="col-md-3">
            <label class="form-label">End Year</label>
            <input type="number" id="end_year" name="end_year" class="form-control">
        </div>
    </div>

    <button type="button" class="btn btn-sm btn-outline-primary fw-bold mb-3" id="add-education">+ Add
        Education</button>

    <div id="educations-list">
        @if (!empty($singleprofile) && $singleprofile->educations->count())
            @foreach ($singleprofile->educations as $edu)
                <div class="education-box bg-info bg-opacity-25 rounded-3 p-2 mb-2 d-flex justify-content-between align-items-center"
                    data-id="{{ $edu->id }}" data-edu-id="{{ $edu->education_id }}"
                    data-edu-name="{{ $edu->education->degree }}" data-field="{{ $edu->field }}"
                    data-inst="{{ $edu->institution }}" data-start="{{ $edu->start_year }}"
                    data-end="{{ $edu->end_year }}">

                    <span>{{ $edu->education->degree }} | {{ $edu->field }} | {{ $edu->institution }}
                        ({{ $edu->start_year }} - {{ $edu->end_year }})</span>
                    <div>
                        <i class="bi bi-pencil-square text-dark me-2 edit-education" style="cursor:pointer"></i>
                        <i class="bi bi-x-circle text-danger delete-education" style="cursor:pointer"></i>
                    </div>
                </div>
            @endforeach
        @endif

        <div
            class="text-muted empty-msg {{ !empty($singleprofile) && $singleprofile->educations->count() ? 'd-none' : '' }}">
            No education added yet.
        </div>
    </div>
</form>
@push('multistepteacherdashscripts')
    <script>
        // Initialize Select2
        $('#education_id_input').select2({
            tags: true,
            placeholder: 'Select or add education',
            width: '100%'
        });

        // Reset helper
        function resetEducationForm() {
            $('#step4Form')[0].reset();
            $('#editing_id').val('');
            $('#education_id_input').val(null).trigger('change');
            $('#add-education').text('+ Add Education').removeClass('btn-success').addClass('btn-outline-primary');
        }

        // CREATE OR UPDATE
        $('#add-education').on('click', function() {
            const editingId = $('#editing_id').val();

            const payload = {
                education_id: $('#education_id_input').val(),
                field: $('#field_input').val(),
                institution: $('#institution_input').val(),
                start_year: $('#start_year').val(),
                end_year: $('#end_year').val(),
                user_id: $('input[name="user_id"]').val(),
                education_profile_id: editingId,
                edit: editingId ? true : false,
                _token: '{{ csrf_token() }}'
            };

            if (!payload.education_id || !payload.field || !payload.institution) {
                toastr.error('Please fill required fields');
                return;
            }

            $.ajax({
                url: '/api/stepfour',
                type: 'POST',
                data: payload,
                dataType: 'json',
                success: function(res) {
                    if (!res.status) return;

                    toastr.success(res.message);
                    $('.empty-msg').remove();

                    // Build HTML using data attributes for clean "Edit" functionality
                    const html = `
                    <div class="education-box bg-info bg-opacity-25 rounded-3 p-2 mb-2 d-flex justify-content-between align-items-center"
                        data-id="${res.education_profile_id}"
                        data-edu-id="${res.education_id}"
                        data-edu-name="${res.education_name}"
                        data-field="${res.field}"
                        data-inst="${res.institution}"
                        data-start="${res.start_year}"
                        data-end="${res.end_year}">
                        <span>${res.education_name} | ${res.field} | ${res.institution} (${res.start_year} - ${res.end_year})</span>
                        <div>
                            <i class="bi bi-pencil-square text-dark me-2 edit-education" style="cursor:pointer"></i>
                            <i class="bi bi-x-circle text-danger delete-education" style="cursor:pointer"></i>
                        </div>
                    </div>`;

                    if (payload.edit) {
                        $(`.education-box[data-id="${res.education_profile_id}"]`).replaceWith(html);
                    } else {
                        $('#educations-list').append(html);
                    }

                    resetEducationForm();
                },
                error: function(xhr) {
                    toastr.error('An error occurred. Please try again.');
                }
            });
        });

        // EDIT - Load data from attributes back into form
        $(document).on('click', '.edit-education', function() {
            const box = $(this).closest('.education-box');

            $('#editing_id').val(box.data('id'));
            $('#field_input').val(box.data('field'));
            $('#institution_input').val(box.data('inst'));
            $('#start_year').val(box.data('start'));
            $('#end_year').val(box.data('end'));

            // Handle Select2
            const eduId = box.data('edu-id');
            const eduName = box.data('edu-name');

            if ($('#education_id_input option[value="' + eduId + '"]').length) {
                $('#education_id_input').val(eduId).trigger('change');
            } else {
                const newOption = new Option(eduName, eduId, true, true);
                $('#education_id_input').append(newOption).trigger('change');
            }

            $('#add-education').text('Update Education').removeClass('btn-outline-primary').addClass('btn-success');
        });

        // DELETE
        $(document).on('click', '.delete-education', function() {
            const box = $(this).closest('.education-box');
            if (!confirm('Are you sure?')) return;

            $.ajax({
                url: '/api/stepfour/delete',
                type: 'POST',
                data: {
                    education_profile_id: box.data('id'),
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        box.remove();
                        if ($('.education-box').length === 0) {
                            $('#educations-list').html(
                                '<div class="text-muted empty-msg">No education added yet.</div>');
                        }
                    }
                }
            });
        });
    </script>
@endpush
