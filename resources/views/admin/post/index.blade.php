@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-bold text-dark">
                <i class="fa-solid fa-clipboard-list me-2 text-primary"></i> Student Inquiries & Posts
            </h5>
            <span class="badge bg-primary-subtle text-primary rounded-pill px-3">{{ $posts->count() }} Total Posts</span>
        </div>

        <div class="card-body bg-white">
            <div class="table-responsive">
                <table id="postTable" class="table table-hover align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>Subject & Level</th>
                            <th>Budget</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $index => $post)
                        @php
                            // Decode JSON fields manually since no casts are used
                            $subjects = json_decode($post->subjects, true) ?? [];
                            $languages = json_decode($post->language, true) ?? [];
                        @endphp
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <div class="fw-semibold text-dark">{{ $post->user->name ?? 'Guest User' }}</div>
                                <small class="text-muted"><i class="bi bi-telephone me-1"></i>{{ $post->country_code }} {{ $post->phone }}</small>
                            </td>
                            <td>
                                <div class="text-truncate" style="max-width: 200px;">
                                    <span class="fw-medium text-primary">{{ is_array($subjects) ? implode(', ', $subjects) : $post->subjects }}</span>
                                </div>
                                <small class="badge bg-light text-dark border">{{ $post->levelText }}</small>
                            </td>
                            <td>
                                <div class="fw-bold text-success">${{ number_format($post->budget, 2) }}</div>
                                <small class="text-muted">{{ $post->budgetType }} • {{ $post->jobType }}</small>
                            </td>
                            <td>
                                <div class="small text-truncate" style="max-width: 150px;"><i class="bi bi-geo-alt text-danger me-1"></i>{{ $post->location }}</div>
                                <small class="text-muted">
                                    {{ $post->getutorfrom }} 
                                    {{-- ({{ $post->meeting_tutorplace }}) --}}
                                </small>
                            </td>
                            <td>
                                @php
                                    // Mapping Integer Status from Migration
                                    $statusMap = [
                                        0 => ['label' => 'Pending', 'class' => 'bg-warning-subtle text-warning border-warning'],
                                        1 => ['label' => 'Active', 'class' => 'bg-success-subtle text-success border-success'],
                                        2 => ['label' => 'Closed', 'class' => 'bg-secondary-subtle text-secondary border-secondary'],
                                    ];
                                    $currentStatus = $statusMap[$post->status] ?? ['label' => 'Unknown', 'class' => 'bg-light text-dark'];
                                @endphp
                                <span class="badge rounded-pill border {{ $currentStatus['class'] }} px-3">
                                    {{ $currentStatus['label'] }}
                                </span>
                            </td>
                            <td class="text-center d-flex align-center">
                                <button class="btn btn-outline-primary btn-sm rounded-circle shadow-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#commentsModel{{ $post->id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                                <button class="btn btn-outline-primary btn-sm rounded-circle shadow-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#postModal{{ $post->id }}">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($posts as $post)
    @php
        $subjects = json_decode($post->subjects, true) ?? [];
        $languages = json_decode($post->language, true) ?? [];
    @endphp
    <div class="modal fade" id="postModal{{ $post->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header border-bottom-0 pt-4 px-4">
                    <h5 class="modal-title fw-bold">Post Details #{{ $post->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-7">
                            <label class="text-muted small text-uppercase fw-bold mb-2 d-block">Request Description</label>
                            <div class="text-dark bg-light p-3 rounded border-start border-4 border-primary shadow-sm" style="min-height: 100px;">
                                {{ $post->description ?? 'No description provided.' }}
                            </div>

                            <div class="row mt-4">
                                <div class="col-6 mb-3">
                                    <label class="text-muted small d-block">Subjects</label>
                                    <span class="fw-medium text-primary">{{ implode(', ', $subjects) }}</span>
                                </div>
                                <div class="col-6 mb-3">
                                    <label class="text-muted small d-block">Preferred Language</label>
                                    <span class="fw-medium">{{ implode(', ', $languages) }}</span>
                                </div>
                                <div class="col-6">
                                    <label class="text-muted small d-block">Travel Preference</label>
                                    <span class="fw-medium"><i class="bi bi-truck me-2"></i>Max {{ $post->travel_distance }} km</span>
                                </div>
                                <div class="col-6">
                                    <label class="text-muted small d-block">Gender Preference</label>
                                    <span class="fw-medium text-capitalize">{{ $post->genderPreference ?? 'No preference' }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="card bg-dark text-white border-0 shadow-sm mb-3">
                                <div class="card-body">
                                    <label class="opacity-75 small d-block mb-1">Posted By</label>
                                    <h5 class="mb-0 fw-bold">{{ $post->user->name ?? 'Guest' }}</h5>
                                    <small class="opacity-75">{{ $post->country_code }} {{ $post->phone }}</small>
                                </div>
                            </div>
                            
                            <div class="list-group shadow-sm border-0">
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 py-2">
                                    <span class="text-muted small">Budget</span>
                                    <span class="fw-bold text-success">${{ number_format($post->budget, 2) }}</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 py-2">
                                    <span class="text-muted small">Job Type</span>
                                    <span class="badge bg-info-subtle text-info border border-info-subtle">{{ $post->jobType }}</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 py-2">
                                    <span class="text-muted small">Needs a...</span>
                                    <span class="fw-bold text-dark">{{ $post->needSomeone }}</span>
                                </div>
                                <div class="list-group-item d-flex justify-content-between align-items-center border-0 py-2">
                                    <span class="text-muted small">Location</span>
                                    <span class="fw-bold text-dark text-end" style="font-size: 0.8rem;">{{ $post->location }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light px-4 border" data-bs-dismiss="modal">Close View</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

@push('adminscripts')
<script>
    $(document).ready(function() {
        if (!$.fn.DataTable.isDataTable('#postTable')) {
            $('#postTable').DataTable({
                responsive: true,
                pageLength: 10,
                dom: '<"d-flex justify-content-between align-items-center mb-3"Bf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
                buttons: [{
                    extend: 'collection',
                    text: '<i class="bi bi-download me-1"></i> Export',
                    className: 'btn btn-outline-light btn-sm',
                    buttons: ['copy', 'excel', 'pdf', 'print']
                }],
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search posts...",
                }
            });
        }
        $('.dataTables_filter input').addClass('form-control shadow-sm border-0 bg-light px-3');
    });
</script>
@endpush