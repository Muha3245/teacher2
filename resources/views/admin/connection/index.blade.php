@extends('layouts.admin')

@section('content')

<div class="container-fluid mt-4">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h4 class="fw-bold text-dark mb-1">Connection Management</h4>
            <p class="text-muted small mb-0">Reviewing links between educators and student requirements.</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <div id="exportButtons" class="d-inline-block me-2"></div>
            <span class="badge bg-white text-dark border py-2 px-3 shadow-sm rounded-pill">
                <span class="text-primary fw-bold">{{ $connections->count() }}</span> Total Records
            </span>
        </div>
    </div>

    <div class="card border-0 shadow-sm" style="border-radius: 15px; overflow: hidden;">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="connectionTable" class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">#</th>
                            <th>Teacher</th>
                            <th>Target Request</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($connections as $connection)
                        <tr>
                            <td class="ps-4 text-muted small">{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="avatar-circle me-3">
                                        {{ strtoupper(substr($connection->teacher->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-dark mb-0" style="font-size: 0.85rem;">
                                            {{ $connection->teacher->user->name ?? 'Unknown' }}
                                        </div>
                                        <div class="text-muted x-small">
                                            <i class="bi bi-phone me-1"></i>{{ $connection->teacher->phone ?? 'No Phone' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="mb-1">
                                    @foreach(json_decode($connection->studentPost->subjects ?? '[]') as $subject)
                                        <span class="subject-tag">{{ $subject }}</span>
                                    @endforeach
                                </div>
                                <div class="text-muted x-small">
                                    <i class="bi bi-mortarboard me-1"></i>{{ $connection->studentPost->levelText ?? 'N/A' }}
                                </div>
                            </td>
                            <td>
                                @php
                                    $status = [
                                        0 => ['dot' => 'bg-warning', 'text' => 'Pending', 'bg' => '#fffbeb', 'color' => '#9a3412'],
                                        1 => ['dot' => 'bg-success', 'text' => 'Active', 'bg' => '#f0fdf4', 'color' => '#166534'],
                                        2 => ['dot' => 'bg-secondary', 'text' => 'Closed', 'bg' => '#f8fafc', 'color' => '#475569'],
                                    ][$connection->status] ?? ['dot' => 'bg-light', 'text' => 'Unknown', 'bg' => '#f1f5f9', 'color' => '#000'];
                                @endphp
                                <span class="status-pill" style="background: {{ $status['bg'] }}; color: {{ $status['color'] }};">
                                    <span class="status-dot {{ $status['dot'] }}"></span>
                                    {{ $status['text'] }}
                                </span>
                            </td>
                            <td class="text-end pe-4">
                                <button class="btn btn-detail-trigger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#connectionModal{{ $connection->id }}">
                                    View Link <i class="bi bi-arrow-right ms-1"></i>
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

@foreach($connections as $connection)
    <div class="modal fade" id="connectionModal{{ $connection->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 24px;">
                <div class="modal-header border-0 pt-4 px-4 pb-0">
                    <h6 class="text-uppercase fw-bold text-muted small mb-0" style="letter-spacing: 1.5px;">Connection Insights</h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4 position-relative">
                        <div class="d-none d-lg-flex position-absolute top-50 start-50 translate-middle justify-content-center align-items-center" style="z-index: 5; width: 45px; height: 45px; background: #fff; border: 1px solid #edf2f7; border-radius: 50%; color: #cbd5e0; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);">
                            <i class="bi bi-arrow-left-right"></i>
                        </div>

                        <div class="col-lg-6">
                            <div class="p-4 h-100 rounded-4 border-0 shadow-sm" style="background: #fcfcfd;">
                                <div class="text-center mb-4">
                                    <div class="avatar-circle mx-auto mb-3" style="width: 65px; height: 65px; font-size: 1.5rem; background: #fff; border: 3px solid #eef2f6;">
                                        {{ strtoupper(substr($connection->teacher->user->name ?? 'U', 0, 1)) }}
                                    </div>
                                    <h5 class="fw-bold text-dark mb-1">{{ $connection->teacher->user->name ?? 'Unknown' }}</h5>
                                    <span class="badge rounded-pill bg-primary bg-opacity-10 text-primary px-3 py-2">Lead Educator</span>
                                </div>
                                <div class="info-box py-2 border-bottom border-light">
                                    <label class="x-small text-muted fw-bold text-uppercase d-block mb-1">Email</label>
                                    <span class="small fw-medium">{{ $connection->teacher->user->email ?? '-' }}</span>
                                </div>
                                <div class="mt-4">
                                    <label class="x-small text-muted fw-bold text-uppercase d-block mb-2">Proposal Message</label>
                                    <div class="p-3 bg-white rounded-3 small text-dark border-start border-primary border-3 shadow-sm italic">
                                        "{{ $connection->body ?? 'No message shared by teacher.' }}"
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="p-4 h-100 rounded-4 border-0 shadow-sm" style="background: #f8fafc;">
                                <div class="mb-4">
                                    <span class="badge rounded-pill bg-success bg-opacity-10 text-success px-3 py-2 mb-3">Student Post</span>
                                    <h5 class="fw-bold text-dark mb-1">{{ $connection->studentPost->levelText ?? 'N/A' }} Requirement</h5>
                                    <p class="text-muted small"><i class="bi bi-geo-alt me-1"></i>{{ $connection->studentPost->location ?? 'Remote Preference' }}</p>
                                </div>
                                
                                <div class="row g-2 mb-4">
                                    <div class="col-12">
                                        <label class="x-small text-muted fw-bold text-uppercase d-block mb-2">Subjects Needed</label>
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach(json_decode($connection->studentPost->subjects ?? '[]') as $subject)
                                                <span class="badge bg-white text-dark border-0 shadow-sm fw-normal">{{ $subject }}</span>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="bg-white p-3 rounded-3 border-light shadow-sm">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted small">Budget Allocation</span>
                                        <span class="fw-bold text-success">${{ number_format($connection->studentPost->budget ?? 0, 0) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 p-4 pt-0">
                    <button type="button" class="btn btn-light w-100 rounded-pill py-2 fw-bold text-muted border-0" data-bs-dismiss="modal">Dismiss View</button>
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection

{{-- 4. Custom Styles --}}
@push('adminstyles')
<style>
    /* Table Styling */
    .table thead th { 
        background: #f8fafc; font-size: 11px; text-transform: uppercase; 
        letter-spacing: 1px; color: #64748b; padding: 15px 12px; border-bottom: 2px solid #f1f5f9;
    }
    .table tbody td { padding: 16px 12px; border-bottom: 1px solid #f1f5f9; }
    
    /* Elements */
    .avatar-circle {
        width: 38px; height: 38px; background: #f1f5f9; color: #475569;
        display: flex; align-items: center; justify-content: center;
        border-radius: 12px; font-weight: 700; font-size: 0.8rem;
    }
    .subject-tag {
        font-size: 10px; padding: 2px 8px; background: #f1f5f9; color: #475569;
        border-radius: 5px; margin-right: 3px; font-weight: 600;
    }
    .status-pill {
        display: inline-flex; align-items: center; padding: 4px 12px;
        border-radius: 20px; font-size: 11px; font-weight: 700;
    }
    .status-dot { width: 6px; height: 6px; border-radius: 50%; margin-right: 8px; }
    .btn-detail-trigger {
        font-size: 12px; font-weight: 700; color: #0d6efd; background: transparent;
        border: 1px solid #e2e8f0; padding: 6px 15px; border-radius: 8px; transition: all 0.2s;
    }
    .btn-detail-trigger:hover { background: #f8fafc; transform: translateY(-1px); border-color: #cbd5e0; }
    
    /* Utilities */
    .x-small { font-size: 0.7rem; }
    .italic { font-style: italic; }
    
    /* DataTable Customization */
    .dataTables_wrapper .dataTables_filter input {
        border-radius: 10px; border: 1px solid #e2e8f0; padding: 8px 15px; 
        background: #fff; width: 220px; font-size: 13px;
    }
    .dataTables_wrapper .dataTables_paginate .paginate_button {
        border-radius: 8px !important; font-size: 12px !important;
    }
</style>
@endpush

{{-- 5. DataTables Script --}}
@push('adminscripts')
<script>
    $(document).ready(function() {
        if (!$.fn.DataTable.isDataTable('#connectionTable')) {
            const table = $('#connectionTable').DataTable({
                responsive: true,
                pageLength: 10,
                dom: '<"d-flex justify-content-between align-items-center px-4 pt-3"fB>rt<"d-flex justify-content-between align-items-center p-4"ip>',
                buttons: [
                    {
                        extend: 'collection',
                        text: '<i class="bi bi-box-arrow-up me-1"></i> Export',
                        className: 'btn btn-outline-light btn-sm rounded-pill fw-bold',
                        buttons: ['excel', 'pdf', 'print']
                    }
                ],
                language: {
                    search: "",
                    searchPlaceholder: "Search connections...",
                    paginate: {
                        next: '<i class="bi bi-chevron-right"></i>',
                        previous: '<i class="bi bi-chevron-left"></i>'
                    }
                }
            });

            // Put export buttons in the header section
            table.buttons().container().appendTo('#exportButtons');
        }
    });
</script>
@endpush