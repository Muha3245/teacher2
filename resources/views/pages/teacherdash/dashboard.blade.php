@extends('layouts.teacherdash')

@section('content')
@push('frontendstyles')
<style>
    .stat-card { border: none; border-left: 4px solid #4e73df; border-radius: 10px; box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1); }
    
    .dashboard-tile {
        cursor: pointer;
        background: #fff;
        border: 1px solid #e3e6f0;
        border-radius: 15px;
        transition: all 0.3s cubic-bezier(.25,.8,.25,1);
        text-decoration: none !important;
        color: #4e5e7a;
    }
    .dashboard-tile:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.08);
        border-color: #4e73df;
        color: #4e73df;
    }
    .tile-icon-wrapper {
        width: 60px;
        height: 60px;
        background: #f0f4ff;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 15px;
    }
    .wizard-step h6 { color: #4e73df; font-weight: 700; margin-bottom: 20px; }
</style>
@endpush
<div id="page-content">
    <div class="container-fluid px-4">
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1 small">Total Students</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">1,240</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-users fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card h-100 py-2" style="border-left-color: #1cc88a;">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1 small">Course Rating</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">4.9/5.0</div>
                        </div>
                        <div class="col-auto"><i class="fas fa-star fa-2x text-gray-300"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <h5 class="mb-3 fw-bold text-secondary">Quick Actions</h5>
    <div class="row g-4">
        <div class="col-lg-3 col-md-6 d-flex align-items-stretch react-card" data-name="Open Camera">
            <div id="openCamera" class="dashboard-tile card text-center w-100 p-4 border-0">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="tile-icon-wrapper text-primary">
                        <i class="fa-solid fa-video fa-xl"></i>
                    </div>
                    <p class="fw-bold mb-0">Record Lesson</p>
                    <small class="text-muted">Start a live stream</small>
                </div>
            </div>
            <input type="file" accept="video/*" id="videoInput" style="display:none;">
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch react-card" data-action="open-profile-wizard">
            <a href="javascript:void(0)" class="dashboard-tile card text-center w-100 p-4 border-0">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="tile-icon-wrapper text-info">
                        <i class="fa-solid fa-user-gear fa-xl"></i>
                    </div>
                    <p class="fw-bold mb-0">Profile Settings</p>
                    <small class="text-muted">Update bio & info</small>
                </div>
            </a>
        </div>

        <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
            <a href="#" class="dashboard-tile card text-center w-100 p-4 border-0">
                <div class="card-body d-flex flex-column align-items-center">
                    <div class="tile-icon-wrapper text-warning">
                        <i class="fa-solid fa-star fa-xl"></i>
                    </div>
                    <p class="fw-bold mb-0">Feedback</p>
                    <small class="text-muted">View 12 new reviews</small>
                </div>
            </a>
        </div>
    </div>
</div>

<div class="modal fade" id="profileWizard" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold text-dark">Teacher Profile Setup</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <div id="wizard-step-1" class="wizard-step">
                    <h6><i class="fa-solid fa-circle-1 me-2"></i>Personal Details</h6>
                    <label class="small fw-bold mb-1">Full Name</label>
                    <input class="form-control mb-3 py-2" placeholder="e.g. John Doe">
                </div>
                </div>
            <div class="modal-footer border-0">
                <button class="btn btn-light px-4" id="prevStep">Back</button>
                <button class="btn btn-primary px-4" id="nextStep">Continue</button>
            </div>
        </div>
    </div>
</div>
</div>
@endsection