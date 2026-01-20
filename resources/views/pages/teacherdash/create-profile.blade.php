@php
    $subjects = Subjects();
    $educations = Educations();
    $singleprofile = SingelTeacherProfile(auth()->id());
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instructor Onboarding | Create Profile</title>

    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@25.10.1/build/css/intlTelInput.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/frontend/teacherdash.css') }}">

    <style>
        :root {
            --primary: #4f46e5;
            --primary-soft: rgba(79, 70, 229, 0.1);
            --bg: #f8fafc;
        }

        body {
            background-color: var(--bg);
            font-family: 'Inter', sans-serif;
            color: #1e293b;
        }

        .card {
            border: none;
            border-radius: 1.5rem;
            overflow: hidden;
        }

        /* Stepper UI */
        .stepper {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3rem;
            position: relative;
        }

        .stepper-item {
            flex: 1;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        .step-counter {
            width: 45px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #e2e8f0;
            border-radius: 50%;
            margin: 0 auto 10px;
            font-weight: 600;
            color: #64748b;
            transition: 0.3s;
        }

        .stepper-item.active .step-counter {
            background: var(--primary);
            color: white;
            box-shadow: 0 0 0 6px var(--primary-soft);
        }

        .stepper-item.completed .step-counter {
            background: #10b981;
            color: white;
        }

        /* Form Styling */
        .step {
            display: none;
        }

        .step.active {
            display: block;
            animation: slideUp 0.4s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #475569;
        }

        .form-control,
        .form-select {
            padding: 0.75rem;
            border-color: #cbd5e1;
            border-radius: 0.75rem;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 4px var(--primary-soft);
        }

        /* Profile Picture Preview */
        .profile-pic-wrapper {
            width: 140px;
            height: 140px;
            border: 2px dashed #cbd5e1;
            border-radius: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            margin: 0 auto;
            overflow: hidden;
            background: #fff;
            position: relative;
            transition: 0.3s;
        }

        .profile-pic-wrapper:hover {
            border-color: var(--primary);
            background: var(--bg);
        }

        #imgPreview {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        /* Dynamic Rows */
        .dynamic-row {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 1.25rem;
            border-radius: 1rem;
            margin-bottom: 1rem;
            position: relative;
            transition: 0.2s;
        }

        .dynamic-row:hover {
            border-color: var(--primary);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        }

        .btn-remove {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #fee2e2;
            color: #ef4444;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border: 1px solid #fecaca;
        }
    </style>
</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="card shadow-lg p-4 p-md-5">

                    {{-- Header --}}
                    <div class="text-center mb-5">
                        <h2 class="fw-bold">Complete Your Teacher Profile</h2>
                        <p class="text-muted">Step-by-step onboarding</p>
                    </div>

                    {{-- Stepper --}}
                    <div class="stepper mb-5">
                        @foreach ([1, 2, 3, 4, 5, 6] as $i)
                            <div class="stepper-item {{ $i == 1 ? 'active' : '' }}">
                                <div class="step-counter">{{ $i }}</div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Steps --}}
                    <div class="step active">@include('pages.teacherdash.multistep.step1')</div>
                    <div class="step">@include('pages.teacherdash.multistep.step2')</div>
                    <div class="step">@include('pages.teacherdash.multistep.step3')</div>
                    <div class="step">@include('pages.teacherdash.multistep.step4')</div>
                    <div class="step">@include('pages.teacherdash.multistep.step5')</div>
                    <div class="step">@include('pages.teacherdash.multistep.step6')</div>

                    {{-- SUCCESS STEP --}}
                    <div class="step text-center" id="successStep">
                        <i class="bi bi-check-circle text-success display-3"></i>
                        <h3 class="fw-bold mt-3">Profile Completed 🎉</h3>
                        <p class="text-muted">Your profile is now live.</p>
                        <a href="{{ route('teacher.dashboard') }}" class="btn btn-success btn-lg">
                            Go to Dashboard
                        </a>
                    </div>

                    <input type="hidden" id="userid" value="{{ auth()->id() }}">

                    {{-- Navigation --}}
                    <div class="d-flex justify-content-between mt-5 border-top pt-4">
                        <button class="btn btn-secondary" id="prevBtn">Back</button>

                        <div>
                            <button class="btn btn-primary" id="nextBtn">
                                Next <i class="bi bi-arrow-right"></i>
                            </button>

                            <button class="btn btn-success d-none" id="submitBtn">
                                Finalize <i class="bi bi-check"></i>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- JS --}}
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('multistepteacherdashscripts')

    <script>
        toastr.options = {
            closeButton: true,
            progressBar: true,
            timeOut: 3000
        };

        let currentStep = 0;
        const steps = $('.step');
        const stepperItems = $('.stepper-item');

        function showStep(index) {
            steps.removeClass('active').eq(index).addClass('active');

            stepperItems.each((i, el) => {
                $(el).toggleClass('active', i === index);
                $(el).toggleClass('completed', i < index);
            });

            $('#prevBtn').toggle(index > 0);

            if (index === steps.length - 2) {
                $('#nextBtn').addClass('d-none');
                $('#submitBtn').removeClass('d-none');
            } else {
                $('#nextBtn').removeClass('d-none');
                $('#submitBtn').addClass('d-none');
            }
        }

        $('#nextBtn').on('click', function(e) {
            e.preventDefault();

            switch (currentStep) {
                case 0:
                    step1ajax(e);
                    break;
                case 1:
                    step2ajax(e);
                    break;
                default:
                    currentStep++;
                    showStep(currentStep);
            }
        });

        $('#prevBtn').on('click', function() {
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });

        $('#submitBtn').on('click', function(e) {
            e.preventDefault();
            step6Form(e);
            finishOnboarding();
        });

        /* CALLED AFTER STEP 6 SUCCESS */
        function finishOnboarding() {
            $('.stepper, #prevBtn, #nextBtn, #submitBtn').hide();
            steps.removeClass('active');
            $('#successStep').addClass('active');
        }

        showStep(currentStep);
    </script>

</body>

</html>
