@extends('layouts.frontend')

@section('content')
    <x-frontend.navbar />

    <style>
        .post-detail-container {
            background-color: #fff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #333;
        }

        .post-title {
            font-size: 1.5rem;
            color: #555;
            font-weight: 400;
            margin-bottom: 15px;
        }

        .btn-contact-custom {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            font-size: 14px;
            transition: background 0.3s;
            cursor: pointer;
        }

        .btn-contact-custom:hover {
            background-color: #2980b9;
            color: white;
        }

        .subject-tag {
            display: inline-block;
            border: 1px solid #ccc;
            padding: 5px 15px;
            color: #666;
            font-size: 14px;
            margin-top: 20px;
            margin-bottom: 25px;
        }

        .detail-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 15px;
            align-items: center;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 15px;
            color: #444;
            min-width: 200px;
        }

        .info-item i {
            font-size: 20px;
            color: #555;
        }

        .info-item .label {
            color: #666;
        }

        .info-item .value {
            font-weight: 500;
        }

        .info-item.disabled {
            color: #ccc;
        }

        .info-item.disabled i {
            color: #ddd;
        }

        .description-text {
            margin-top: 30px;
            font-size: 16px;
            color: #555;
            line-height: 1.6;
        }

        .icon-green {
            color: #5cb85c !important;
        }

        /* Modal Custom Styles */
        .contact-modal-number {
            background: #f8f9fa;
            border: 2px dashed #3498db;
            padding: 15px;
            text-align: center;
            border-radius: 10px;
            font-size: 1.3rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 20px;
        }
    </style>

    <div class="container py-5">
        @php
            $requiredCoin = round($singlepost->budget * 0.01, 2);
        @endphp
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="post-detail-container p-4">

                    <!-- Title -->
                    <h1 class="post-title">
                        {{ implode(', ', json_decode($singlepost->subjects ?? '[]')) }} help teacher required in
                        {{ $singlepost->location }}
                    </h1>

                    <!-- Contact Button - Triggers Modal -->
                    <div class="mb-4">
                        <button type="button" class="btn-contact-custom" data-bs-toggle="modal"
                            data-bs-target="#contactTutorModal" data-coin="{{ $requiredCoin }}">
                            Contact {{ $singlepost->user->name }}
                        </button>

                        {{-- For coins --}}

                        {{-- <div class="mb-4">
                        <button type="button" class="btn-contact-custom contact-btn"  data-coin="{{ $requiredCoin }}" data-post="{{ $singlepost->id }}">
                            Contact {{ $singlepost->user->name }} (coins {{ $coin}})
                        </button>
                    </div> --}}
                    </div>

                    <!-- Subject Tag -->
                    <div class="subject-tag">
                        {{ implode(', ', json_decode($singlepost->subjects ?? '[]')) }}
                    </div>

                    <!-- Info Grid Section -->
                    <div class="mt-2">
                        <!-- Row 1: Location & Budget -->
                        <div class="detail-row">
                            <div class="info-item">
                                <i class="bi bi-geo-alt-fill"></i>
                                <span class="value">{{ $singlepost->location }}</span>
                            </div>
                            <div class="info-item">
                                <span class="fs-4">$</span>
                                <span class="value">{{ $singlepost->budget }}/{{ $singlepost->budgetType }}</span>
                            </div>
                        </div>

                        <!-- Row 2: Posted & Level & Due Date -->
                        <div class="detail-row">
                            <div class="info-item">
                                <i class="bi bi-calendar3"></i>
                                <span class="label">Posted :</span>
                                <span class="value">{{ $singlepost->created_at->diffForHumans() }}</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-bar-chart-steps"></i>
                                <span class="label">Level :</span>
                                <span class="value">{{ $singlepost->levelText }}</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-clock"></i>
                                <span class="label">Due Date :</span>
                                <span class="value">{{ $singlepost->due_date ?? 'N/A' }}</span>
                            </div>
                        </div>

                        <!-- Row 3: Job Type & Posted By -->
                        <div class="detail-row">
                            <div class="info-item">
                                <i class="bi bi-person-workspace"></i>
                                <span class="label">Requires :</span>
                                <span class="value">{{ $singlepost->jobType }}</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-person-fill"></i>
                                <span class="label">Posted by :</span>
                                <span class="value">{{ $singlepost->user->name }} (Professional) <i
                                        class="bi bi-info-circle"></i></span>
                            </div>
                        </div>

                        <!-- Row 4: Verification & Gender & Online -->
                        <div class="detail-row">
                            <div class="info-item">
                                <i class="bi bi-phone icon-green"></i>
                                <span class="label">Phone verified</span>
                                <span class="value">{{ $singlepost->country_code }}-**********</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-gender-ambiguous"></i>
                                <span class="label">Gender Preference :</span>
                                <span class="value">{{ $singlepost->genderPreference }}</span>
                            </div>
                            <div class="info-item{{ $singlepost->getutorfrom != 'online' ? ' disabled' : '' }}">
                                <i class="bi bi-wifi-off"></i>
                                <span class="value">
                                    {{ $singlepost->getutorfrom != 'online' ? 'Not available for online tutoring' : 'Available for online tutoring' }}
                                </span>
                            </div>
                        </div>

                        <!-- Row 5: Home Tutoring & Travel & Comm Language -->
                        <div class="detail-row">
                            <div class="info-item {{ $singlepost->getutorfrom != 'home' ? 'disabled' : '' }}">
                                <i class="bi bi-house-door"></i>
                                <span class="value">
                                    {{ $singlepost->getutorfrom != 'home' ? 'Not available for home tutoring' : 'Available for home tutoring' }}
                                </span>
                            </div>

                            <div class="info-item {{ $singlepost->getutorfrom != 'assignment' ? 'disabled' : '' }}">
                                <i class="bi bi-journal-plus"></i>
                                <span class="value">
                                    {{ $singlepost->getutorfrom != 'assignment' ? 'Not available for Assignment' : 'Available for Assignment' }}
                                </span>
                            </div>

                            <div class="info-item">
                                <i class="bi bi-car-front-fill"></i>
                                <span class="label">From:</span>
                                <span class="value">{{ $singlepost->location }}</span>
                            </div>
                            <div class="info-item">
                                <i class="bi bi-chat-dots-fill"></i>
                                <span class="label">Can communicate in :</span>
                                <span class="value">
                                    {{ implode(', ', json_decode($singlepost->language ?? '[]')) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="description-text">
                        {{ $singlepost->description }}
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal fade" id="contactTutorModal" tabindex="-1" aria-labelledby="contactTutorModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold" id="contactTutorModalLabel">Contact {{ $singlepost->user->name }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <!-- Phone Section -->
                    <label class="small text-uppercase fw-bold text-muted mb-2">Phone Number</label>
                    <div class="contact-modal-number">
                        <i class="bi bi-telephone-outbound-fill me-2 text-primary"></i>
                        +{{ $singlepost->country_code }} {{ $singlepost->phone }}
                    </div>

                    <hr class="my-4">

                    <!-- Message Section -->
                    <label class="small text-uppercase fw-bold text-muted mb-2">Send a Message</label>
                    <form action="{{ route('jobs.comment', $singlepost->id) }}" method="post">
                        @csrf
                        <textarea name="comment" class="form-control border-0 shadow-sm rounded-3 p-3" rows="4"
                            placeholder="Introduce yourself and mention your requirements..."
                            style="background: #fdfdfd; border: 1px solid #e5e7eb !important;" required></textarea>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" class="btn btn-primary py-2 rounded-pill fw-bold shadow-sm">
                                <i class="bi bi-send-fill me-2"></i> Post Comment
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer border-0 justify-content-center pb-4">
                    <small class="text-muted">Direct contact is recommended for faster response.</small>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.contact-btn');

        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                let postId = this.dataset.post;
                let coinsNeeded = this.dataset.coin;

                fetch('{{ route('jobs.checkCoins') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            post_id: postId,
                            coins_needed: coinsNeeded
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Open modal if success
                            let modal = new bootstrap.Modal(document.getElementById(
                                'contactTutorModal'));
                            modal.show();
                        } else {
                            // Show alert if not enough coins
                            alert(data.message);
                        }
                    })
                    .catch(err => {
                        console.error(err);
                        alert('Something went wrong!');
                    });
            });
        });
    });
</script>
