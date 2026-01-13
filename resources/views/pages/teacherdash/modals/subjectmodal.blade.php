{{-- =================== Subjects Modals =================== --}}
@foreach ($profile->subjects as $subject)
    <div class="modal fade" id="editSubjectModal{{ $subject->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Edit Subject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form class="ajaxForm"  data-url="{{ route('teacher.profile.subjects') }}" method="POST" data-id="{{ $profile->id }}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Subject Name</label>
                            <select name="subjects[{{ $subject->id }}][subject_id]" class="form-select select2-subject">
                                @foreach ($subjects as $sub)
                                    <option value="{{ $sub->id }}"
                                        {{ $sub->id == $subject->subject_id ? 'selected' : '' }}>
                                        {{ $sub->name }}
                                    </option>
                                @endforeach
                            </select>

                            {{-- <input type="text" name="subjects[{{ $subject->id }}][name]"
                                            class="form-control" value="{{ $subject->name }}"> --}}
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Level From</label>
                            <input type="text" name="subjects[{{ $subject->id }}][from_level]" class="form-control"
                                value="{{ $subject->from_level }}">
                        </div>
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Level To</label>
                            <input type="text" name="subjects[{{ $subject->id }}][to_level]" class="form-control"
                                value="{{ $subject->to_level }}">
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

{{-- Add Subject Modal --}}
<div class="modal fade" id="addSubjectModal{{ $profile->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Add Subject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form class="ajaxForm" data-url="{{ route('teacher.profile.subjects') }}" method="POST" data-id="{{ $profile->id }}">
                @csrf
                @method('PUT')

                <div class="modal-body pt-0">

                    {{-- Subject --}}
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">
                            Subject Name <span class="text-danger">*</span>
                        </label>

                        <select name="subjects[new][subject_name]"
                                class="form-select select2-subject"
                                data-placeholder="Search or type subject">
                            <option value=""></option>
                            @foreach ($subjects as $sub)
                                <option value="{{ $sub->name }}">{{ $sub->name }}</option>
                            @endforeach
                        </select>

                        <div class="form-text">
                            You can also add a custom subject
                        </div>
                    </div>

                    {{-- Level From --}}
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">
                            Level From <span class="text-danger">*</span>
                        </label>

                        <select name="subjects[new][from_level]"
                                class="form-select select2-level"
                                data-placeholder="Select starting level">
                            <option value=""></option>
                            <option>Primary School</option>
                            <option>Middle School</option>
                            <option>High School</option>
                            <option>O Level / IGCSE</option>
                            <option>A Level</option>
                            <option>Undergraduate</option>
                            <option>Masters / Professional</option>
                        </select>
                    </div>

                    {{-- Level To --}}
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">
                            Level To <span class="text-danger">*</span>
                        </label>

                        <select name="subjects[new][to_level]"
                                class="form-select select2-level"
                                data-placeholder="Select teaching level">
                            <option value=""></option>
                            <option>Beginner</option>
                            <option>Intermediate</option>
                            <option>Advanced / Expert</option>
                            <option>Exam Preparation</option>
                        </select>
                    </div>

                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary px-4">
                        Add Subject
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

@push('frontendscripts')
<script>
$(document).on('shown.bs.modal', function (e) {

    // Subject (allow typing)
    $(e.target).find('.select2-subject').each(function () {

        if ($(this).hasClass('select2-hidden-accessible')) {
            $(this).select2('destroy');
        }

        $(this).select2({
            dropdownParent: $(e.target),
            width: '100%',
            tags: true,
            placeholder: $(this).data('placeholder'),
            allowClear: true,
            tokenSeparators: [',']
        });
    });

    // Levels (fixed options)
    $(e.target).find('.select2-level').each(function () {

        if ($(this).hasClass('select2-hidden-accessible')) {
            $(this).select2('destroy');
        }

        $(this).select2({
            dropdownParent: $(e.target),
            width: '100%',
            placeholder: $(this).data('placeholder'),
            allowClear: true,
            minimumResultsForSearch: Infinity
        });
    });

});
</script>
@endpush


