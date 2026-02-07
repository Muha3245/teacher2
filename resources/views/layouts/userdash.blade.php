<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Post Your Requirement | Student Feed</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/css/intlTelInput.css" />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">
           <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href={{ asset('css/frontend/home.css')}}>
         <style>
        :root {
            --primary-color: #6366f1;
            --primary-hover: #4f46e5;
            --bg-light: #f8fafc;
            --border-radius: 12px;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-light);
            color: #1e293b;
        }

        .form-card {
            background: #ffffff;
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            padding: 2.5rem;
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            border-bottom: 2px solid #f1f5f9;
            padding-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* --- SELECT2 CUSTOM BEAUTIFICATION --- */

        /* Container styling */
        .select2-container--default .select2-selection--single,
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #e2e8f0 !important;
            border-radius: var(--border-radius) !important;
            min-height: 50px !important;
            padding: 6px 12px !important;
            transition: all 0.3s ease;
        }

        .select2-container--default.select2-container--focus .select2-selection--multiple,
        .select2-container--default.select2-container--focus .select2-selection--single {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1) !important;
        }

        /* Language Tags Styling */
        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background-color: var(--primary-color) !important;
            border: none !important;
            color: white !important;
            border-radius: 50px !important;
            padding: 4px 12px !important;
            font-weight: 500;
            font-size: 0.85rem;
            margin-top: 4px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: rgba(255, 255, 255, 0.8) !important;
            border-right: 1px solid rgba(255, 255, 255, 0.2) !important;
            margin-right: 8px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover {
            background-color: transparent !important;
            color: white !important;
        }

        /* Dropdown Menu Styling */
        .select2-dropdown {
            border: none !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important;
            border-radius: 12px !important;
            overflow: hidden;
            z-index: 9999;
        }

        .select2-results__option {
            padding: 10px 15px !important;
        }

        .select2-results__option--highlighted[aria-selected] {
            background-color: var(--primary-color) !important;
        }

        /* --- OTHER INPUTS --- */
        .form-control,
        .form-select {
            border-radius: var(--border-radius);
            padding: 0.75rem 1rem;
            border: 1px solid #e2e8f0;
        }

        .btn-submit {
            background-color: var(--primary-color);
            border: none;
            padding: 1rem;
            border-radius: var(--border-radius);
            font-weight: 700;
            transition: all 0.3s;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);

            transform: transl .card .btn-outline-primary {
                transition: all 0.3s ease;
            }

            .card .btn-outline-primary:hover {
                background-color: var(--primary-color);
                color: #fff;
                transform: translateY(-2px);
            }
    </style>
    @stack('userdashstyles')
</head>
<body>
        <x-frontend.navbar />

    <main class="container my-5">
        @yield('content')
    </main>

    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/js/intlTelInput.min.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    @stack('userdashjs')
    <script>
        lucide.createIcons();

        $(document).ready(function() {
            // SCRIPT FOR CREATE FORM
            if ($("#studentPostForm").length) {
                // 1. SUBJECT (Single Select + Own Entry)
                $("#subjectsSelect").select2({
                    placeholder: "Search or type your own subject...",
                    tags: true, // Allows custom typing
                    allowClear: true,
                    width: "100%",
                });

                // 2. LANGUAGES (Multi Select + Tags)
                $("#languagesSelect").select2({
                    placeholder: "Add languages (English, Urdu...)",
                    tags: true,
                    width: "100%",
                    tokenSeparators: [',', ' '] // Allows adding tag by pressing space or comma
                });

                // PHONE LOGIC
                const iti = intlTelInput(document.querySelector("#phone"), {
                    initialCountry: "pk",
                    separateDialCode: true,
                    utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@19.5.6/build/js/utils.js",
                });

                // LEVEL COMBINER
                $("#gradeSelect, #skillSelect").on("change", function() {
                    const g = $("#gradeSelect").val();
                    const s = $("#skillSelect").val();
                    $("#finalLevelInput").val(g && s ? `${g} - ${s}` : "");
                });

                // VALIDATION
                $("#studentPostForm").on("submit", function(e) {
                    if (!iti.isValidNumber()) {
                        e.preventDefault();
                        $("#phoneError").removeClass("d-none");
                        return false;
                    }
                    $("input[name=phone]").val(iti.getNumber());
                    $("input[name=country_code]").val(iti.getSelectedCountryData().dialCode);
                });
            }
        });
    </script>
</body>
</html>