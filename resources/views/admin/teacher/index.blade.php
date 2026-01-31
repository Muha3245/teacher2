@extends('layouts.admin')

@section('content')
    <div class="container-fluid mt-4">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0"><i class="fa-solid fa-chalkboard-user me-2"></i> All Teachers</h5>
                <a href="{{ route('admin.teacher.create') }}" class="btn btn-light btn-sm d-flex align-items-center fw-bold">
                    <i class="fa-solid fa-plus-circle me-1"></i> Add Teacher
                </a>
            </div>

            <div class="card-body box-body bg-white">
                <div class="table-responsive">
                    <table id="teacherprofiletable" class="table table-hover align-middle border">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Headline</th>
                                <th>Quick Overview</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($teachers as $index => $teacher)
                                <tr class="{{ $teacher->is_blocked ? 'table-danger' : '' }}">
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        <div class="fw-bold">{{ $teacher->full_name }}</div>
                                        {{-- <small class="text-muted">{{ $teacher->user->email ?? '' }}</small> --}}
                                    </td>
                                    <td><span class="text-truncate d-inline-block"
                                            style="max-width: 150px;">{{ $teacher->headline ?? '-' }}</span></td>

                                    {{-- Summary Badges in Main Table --}}
                                    <td class="d-flex gap-2">
                                        <span class="badge bg-info-subtle text-info border border-info mb-1">
                                            {{ $teacher->subjects->count() }} Subjects
                                        </span><br>
                                        <span class="badge bg-success-subtle text-success border border-success">
                                            {{ $teacher->educations->count() }} Degrees
                                        </span>
                                    </td>

                                    <td>{{ $teacher->location ?? 'N/A' }}</td>
                                    <td>
                                        @if ($teacher->is_blocked)
                                            <span
                                                class="badge rounded-pill bg-danger-subtle text-danger border border-danger">Blocked</span>
                                        @else
                                            <span
                                                class="badge rounded-pill bg-success-subtle text-success border border-success">Active</span>
                                        @endif
                                    </td>

                                    <td class="text-center">
                                        <div class="btn-group shadow-sm">
                                            <button class="btn btn-white btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#teacherModal{{ $teacher->id }}">
                                                <i class="bi bi-eye text-primary"></i>
                                            </button>
                                            <a href="{{ route('admin.teacher.edit', $teacher->id) }}"
                                                class="btn btn-white btn-sm">
                                                <i class="bi bi-pencil-square text-warning"></i>
                                            </a>
                                            <form action="{{ route('admin.teacher.delete', $teacher->id) }}" method="post"
                                                class="d-inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-white btn-sm"
                                                    onclick="return confirm('Are you sure?')">
                                                    <i class="bi bi-trash text-danger"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>

                                    {{-- --- MODAL START --- --}}
                                    <div class="modal fade text-start" id="teacherModal{{ $teacher->id }}" tabindex="-1"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-scrollable">
                                            <div class="modal-content border-0 shadow">
                                                <div class="modal-header bg-primary text-white">
                                                    <h5 class="modal-title"><i class="fa-solid fa-id-card me-2"></i>
                                                        {{ $teacher->name }}'s Detailed Profile</h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body p-4">
                                                    <div class="row g-4">
                                                        {{-- Left Column: Avatar & Quick Info --}}
                                                        <div class="col-md-3 border-end text-center">
                                                            <img src="{{ asset($teacher->profile_picture) ?? 'https://ui-avatars.com/api/?name=' . urlencode($teacher->name) . '&background=0D6EFD&color=fff' }}"
                                                                class="rounded-circle mb-3 border border-4 border-primary-subtle shadow-sm"
                                                                width="160" height="160" alt="Profile">
                                                            <h5 class="fw-bold mb-0">{{ $teacher->name }}</h5>
                                                            <p class="text-muted small">{{ $teacher->headline }}</p>
                                                            <hr>
                                                            <div class="text-start small">
                                                                <p class="mb-1"><strong><i
                                                                            class="fa-solid fa-envelope me-2 text-primary"></i></strong>
                                                                    {{ $teacher->user->email ?? 'N/A' }}</p>
                                                                <p class="mb-1"><strong><i
                                                                            class="fa-solid fa-location-dot me-2 text-primary"></i></strong>
                                                                    {{ $teacher->location->city ?? '-' }},
                                                                    {{ $teacher->location->state ?? '' }}</p>
                                                                <p class="mb-1"><strong><i
                                                                            class="fa-solid fa-calendar-check me-2 text-primary"></i></strong>
                                                                    Joined: {{ $teacher->created_at->format('M Y') }}
                                                                </p>
                                                            </div>
                                                        </div>

                                                        {{-- Right Column: Detailed Stats, Subjects & Education --}}
                                                        <div class="col-md-9">
                                                            {{-- Bio Section --}}
                                                            <div class="mb-4">
                                                                <h6
                                                                    class="fw-bold text-uppercase text-primary border-bottom pb-2">
                                                                    About & Experience</h6>
                                                                <p class="text-muted small">
                                                                    {{ $teacher->profile_description ?? 'No description provided.' }}
                                                                </p>
                                                                <div class="row g-2 mt-2">
                                                                    <div class="col-6 col-md-3"><strong>Exp:</strong>
                                                                        {{ $teacher->years_teaching }} Years</div>
                                                                    <div class="col-6 col-md-3"><strong>Online:</strong>
                                                                        {{ $teacher->years_online }} Years</div>
                                                                    <div class="col-6 col-md-3"><strong>Travel:</strong>
                                                                        {{ $teacher->willing_to_travel ? 'Yes' : 'No' }}
                                                                    </div>
                                                                    <div class="col-6 col-md-3"><strong>Price:</strong>
                                                                        {{ $teacher->min_price }}-{{ $teacher->max_price }}
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Subjects Grid --}}
                                                            <div class="mb-4">
                                                                <h6
                                                                    class="fw-bold text-uppercase text-info border-bottom pb-2">
                                                                    <i class="fa-solid fa-book me-2"></i> Subjects &
                                                                    Expertise Levels
                                                                </h6>
                                                                <div class="row row-cols-1 row-cols-md-3 g-3">
                                                                    @forelse($teacher->subjects as $subject)
                                                                        <div class="col">
                                                                            <div
                                                                                class="card h-100 border-info-subtle bg-light-subtle shadow-sm">
                                                                                <div class="card-body py-2 px-3">
                                                                                    <div class="fw-bold text-info">
                                                                                        {{ $subject->subject->name }}
                                                                                    </div>
                                                                                    <div class="small">
                                                                                        <span
                                                                                            class="text-muted small">Level:</span>
                                                                                        <span
                                                                                            class="badge bg-info text-dark">{{ $subject->from_level }}</span>
                                                                                        <i
                                                                                            class="fa-solid fa-arrow-right mx-1 small"></i>
                                                                                        <span
                                                                                            class="badge bg-info text-dark">{{ $subject->to_level }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @empty
                                                                        <div class="col-12 text-muted small">No subjects
                                                                            listed.</div>
                                                                    @endforelse
                                                                </div>
                                                            </div>

                                                            {{-- Education List --}}
                                                            <div>
                                                                <h6
                                                                    class="fw-bold text-uppercase text-success border-bottom pb-2">
                                                                    <i class="fa-solid fa-graduation-cap me-2"></i>
                                                                    Education & Certification
                                                                </h6>
                                                                <div class="row g-3">
                                                                    @forelse($teacher->educations as $edu)
                                                                        <div class="col-md-6">
                                                                            <div
                                                                                class="card h-100 border-success-subtle shadow-sm border-start border-4 border-success">
                                                                                <div class="card-body p-2">
                                                                                    <div class="fw-bold">
                                                                                        {{ $edu->degree }}</div>
                                                                                    <div class="small text-muted">
                                                                                        {{ $edu->field }}</div>
                                                                                    <div
                                                                                        class="d-flex justify-content-between mt-1 border-top pt-1">
                                                                                        <span
                                                                                            class="small fw-semibold text-truncate"
                                                                                            style="max-width: 150px;">{{ $edu->institution }}</span>
                                                                                        <span
                                                                                            class="badge bg-secondary">{{ $edu->start_year }}
                                                                                            -
                                                                                            {{ $edu->end_year }}</span>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @empty
                                                                        <div class="col-12 text-muted small">No
                                                                            education details found.</div>
                                                                    @endforelse
                                                                </div>
                                                            </div>
                                                        </div> {{-- End Right Col --}}
                                                    </div>
                                                </div>
                                                <div class="modal-footer bg-light">
                                                    <button type="button" class="btn btn-secondary px-4 shadow-sm"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- --- MODAL END --- --}}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-5">
                                        <i class="fa-solid fa-inbox fa-3x mb-3 d-block opacity-25"></i>
                                        No teachers found in the system.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('adminscripts')
    <script>
        // Replace your DataTable script with this
        $(document).ready(function() {
            $('#teacherprofiletable').DataTable({
                responsive: true,
                pageLength: 10,
                dom: '<"d-flex justify-content-between align-items-center mb-4"Bf>rt<"d-flex justify-content-between align-items-center mt-4"ip>',
                buttons: [{
                    extend: 'collection',
                    text: '<i class="bi bi-download me-1"></i> Export',
                    className: 'btn btn-outline-light btn-sm',
                    buttons: ['copy', 'excel', 'pdf', 'print']
                }],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search teachers...",
                    paginate: {
                        previous: '<i class="bi bi-chevron-left"></i>',
                        next: '<i class="bi bi-chevron-right"></i>'
                    }
                }
            });

            // Make the search input look like Bootstrap
            $('.dataTables_filter input').addClass('form-control shadow-sm border-0');
        });
    </script>
@endpush
