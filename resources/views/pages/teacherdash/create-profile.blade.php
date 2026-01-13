<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Instructor Onboarding | Create Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
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
            <div class="col-lg-10 col-xl-9">
                <div class="card shadow-lg p-4 p-md-5">

                    <div class="text-center mb-5">
                        <h2 class="fw-bold">Complete Your Teacher Profile</h2>
                        <p class="text-muted">Fill in your details to start reaching students globally.</p>
                    </div>

                    <div class="stepper">
                        <div class="stepper-item active" id="s-0">
                            <div class="step-counter">1</div>
                            <div class="small fw-bold text-uppercase">Identity</div>
                        </div>
                        <div class="stepper-item" id="s-1">
                            <div class="step-counter">2</div>
                            <div class="small fw-bold text-uppercase">Rates</div>
                        </div>
                        <div class="stepper-item" id="s-2">
                            <div class="step-counter">3</div>
                            <div class="small fw-bold text-uppercase">subjects</div>
                        </div>
                        <div class="stepper-item" id="s-3">
                            <div class="step-counter">4</div>
                            <div class="small fw-bold text-uppercase">Education</div>
                        </div>
                        <div class="stepper-item" id="s-4">
                            <div class="step-counter">5</div>
                            <div class="small fw-bold text-uppercase">Biography</div>
                        </div>
                    </div>



                    <div class="step active">
                        @include('pages.teacherdash.multistep.step1')
                    </div>

                    <div class="step">
                        <h5 class="fw-bold mb-4">Teaching Preferences & Rates</h5>
                        @include('pages.teacherdash.multistep.step2')
                    </div>

                    <div class="step">
                        @include('pages.teacherdash.multistep.step3')
                    </div>
                    <div class="step">
                        @include('pages.teacherdash.multistep.step4')
                    </div>


                    <div class="step">
                        <h5 class="fw-bold mb-4">Finalizing Your Profile</h5>
                        @include('pages.teacherdash.multistep.step5')
                    </div>
                    <input type="hidden" id="userid" value='{{auth()->id()}}'>

                    <div class="d-flex justify-content-between mt-5 pt-4 border-top">
                        <button type="button" class="btn btn-secondary px-4 fw-bold" id="prevBtn">Back</button>
                        <div>
                            <button type="button" class="btn btn-primary px-5 fw-bold" id="nextBtn">Next Step
                                <i class="bi bi-chevron-right ms-2"></i></button>
                            <button type="submit" class="btn btn-success px-5 fw-bold d-none" id="submitBtn">Finalize
                                Profile <i class="bi bi-check-circle ms-2"></i></button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>

    @stack('multistepteacherdashscripts')
    <script>
        var userid = $('#userid').val();
        // let subjects = [];
        // let educations = [];
        let currentStep = 0;
        const steps = $('.step');
        const stepperItems = $('.stepper-item');

        // Multi-step Navigation Logic
        function showStep(index) {
            steps.removeClass('active').eq(index).addClass('active');
            stepperItems.each((i, el) => {
                $(el).toggleClass('active', i === index);
                $(el).toggleClass('completed', i < index);
            });

            $('#prevBtn').css('visibility', index === 0 ? 'hidden' : 'visible');

            if (index === steps.length - 1) {
                $('#nextBtn').addClass('d-none');
                $('#submitBtn').removeClass('d-none');
            } else {
                $('#nextBtn').removeClass('d-none');
                $('#submitBtn').addClass('d-none');
            }
            window.scrollTo(0, 0);
        }

        $('#nextBtn').click(() => {
            if (currentStep === 0) {
                if (!$('#step1Form').valid()) {
                    return; // STOP here
                }
            }
            if (currentStep === 1) {
                if (!$('#step2Form').valid()) {
                    return; // STOP here
                }
            }
            if (currentStep === 2) {
                if (typeof subjects === 'undefined' || subjects.length < 1) {
                    alert('Please add at least one subject to the list before proceeding.');
                    return; // STOP here
                }

                $('#step3Form').validate().resetForm();
                $('#step3Form .form-control').removeClass('is-invalid');
            }
            if (currentStep === 3) {
                if (typeof educations === 'undefined' || educations.length < 1) {
                    alert('Please add at least one education to the list before proceeding.');
                    return; // STOP here
                }
                $('#step4Form').validate().resetForm();
                $('#step4Form .form-control').removeClass('is-invalid');
            }
            if (currentStep === 4) {
                if (!$('#step5Form').valid()) {
                    return; // STOP here
                }
            }



            currentStep++;
            showStep(currentStep);
        });
        $('#prevBtn').click(() => {
            currentStep--;
            showStep(currentStep);
        });

        $('.select-2').select2({
            width: '100%',
            tags: true,
            placeholder: 'Search or type',
            allowClear: true,
            tokenSeparators: [',']
        });


        // Initialize
        showStep(currentStep);



        
    </script>

</body>

</html>
