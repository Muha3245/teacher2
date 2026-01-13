{{-- =================== Education Modals =================== --}}
@foreach ($profile->educations as $education)
    <div class="modal fade" id="editEduModal{{ $education->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content border-0 shadow-lg rounded-4">

                <div class="modal-header border-0">
                    <h5 class="modal-title fw-bold">Edit Education</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form class="ajaxForm" data-url="{{ route('teacher.profile.educations') }}" method="POST" data-id="{{ $profile->id }}">
                    @csrf
                    @method('PUT')

                    <div class="modal-body pt-0">

                        {{-- Degree --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">
                                Degree Name <span class="text-danger">*</span>
                            </label>

                            <select name="educations[{{ $education->id }}][degree_name]"
                                class="form-select select2-degree" data-placeholder="Search or type degree">
                                <option value=""></option>
                                @foreach ($educations as $edu)
                                    <option value="{{ $edu->id }}"
                                        {{ $edu->id == $education->education_id ? 'selected' : '' }}>
                                        {{ $edu->degree }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Institution --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">
                                Institution <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="educations[{{ $education->id }}][institution]"
                                class="form-control" value="{{ $education->institution }}">
                        </div>

                        {{-- Year --}}
                        <div class="mb-3">
                            <label class="form-label small fw-semibold">
                                Year Completed <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="educations[{{ $education->id }}][year_completed]"
                                class="form-control" value="{{ $education->year_completed }}" placeholder="e.g. 2023">
                        </div>

                    </div>

                    <div class="modal-footer border-0 pt-0">
                        <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary px-4">
                            Save Changes
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endforeach


{{-- Add Education Modal --}}
<div class="modal fade" id="addEduModal{{ $profile->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-lg rounded-4">

            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Add Education</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form class="ajaxForm" data-url="{{ route('teacher.profile.educations') }}" method="POST" data-id="{{ $profile->id }}">
                @csrf
                @method('PUT')

                <div class="modal-body pt-0">

                    {{-- Degree --}}
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">
                            Degree Name <span class="text-danger">*</span>
                        </label>

                        <select name="educations[new][degree_name]" class="form-select select2-degree"
                            data-placeholder="Search or type degree">
                            <option value=""></option>
                            @foreach ($educations as $edu)
                                <option value="{{ $edu->id }}">{{ $edu->degree }}</option>
                            @endforeach
                        </select>

                        <div class="form-text">
                            You can also add a custom degree
                        </div>
                    </div>

                    {{-- Institution --}}
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">
                            Institution <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="educations[new][institution]" class="form-control">
                    </div>

                    {{-- Year --}}
                    <div class="mb-3">
                        <label class="form-label small fw-semibold">
                            Year Completed <span class="text-danger">*</span>
                        </label>
                        <input type="text" name="educations[new][year_completed]" class="form-control"
                            placeholder="e.g. 2024">
                    </div>

                </div>

                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-primary px-4">
                        Add Education
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@push('frontendscripts')
    <script>
        $(document).on('shown.bs.modal', function(e) {

            $(e.target).find('.select2-degree').each(function() {

                if ($(this).hasClass('select2-hidden-accessible')) {
                    $(this).select2('destroy');
                }

                $(this).select2({
                    dropdownParent: $(e.target),
                    width: '100%',
                    tags: true, // allow custom degree
                    placeholder: $(this).data('placeholder'),
                    allowClear: true,
                    tokenSeparators: [',']
                });
            });

        });
    </script>
@endpush
