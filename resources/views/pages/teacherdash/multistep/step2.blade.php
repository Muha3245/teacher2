<form id="step2Form">
    <div class="row g-4">
        <div class="col-12">
            <label class="form-label">Professional Headline</label>
            <input type="text" name="headline" class="form-control"
                placeholder="Ex: Senior Physics Professor with 15 Years Experience">
        </div>
        <div class="col-md-4">
            <label class="form-label">Charge Period</label>
            <select name="charge_period" class="form-select">
                <option>Hourly</option>
                <option>Monthly</option>
                <option>Per Session</option>
            </select>
        </div>
        <div class="col-md-4">
            <label class="form-label">Min Price</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" name="min_price" class="form-control">
            </div>
        </div>
        <div class="col-md-4">
            <label class="form-label">Max Price</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" name="max_price" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <label class="form-label">Teaching Experience (Offline)</label>
            <input type="number" name="years_teaching" class="form-control" placeholder="Years">
        </div>
        <div class="col-md-6">
            <label class="form-label">Teaching Experience (Online)</label>
            <input type="number" name="years_online" class="form-control" placeholder="Years">
        </div>
    </div>

    <div class="row mt-4 g-3 bg-light p-3 rounded-3">
        <div class="col-md-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="willing_to_travel" id="travelSw">
                <label class="form-check-label fw-bold" for="travelSw">Willing to
                    Travel</label>
            </div>
            <input type="number" name="travel_km" class="form-control form-control-sm mt-2 travel_km d-none"
                placeholder="Max KM">
        </div>
        <div class="col-md-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="has_digital_pen" id="penSw">
                <label class="form-check-label fw-bold" for="penSw">Has Digital Pen</label>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="helps_homework" id="hwSw">
                <label class="form-check-label fw-bold" for="hwSw">Helps with
                    Homework</label>
            </div>
        </div>
    </div>
</form>
@push('multistepteacherdashscripts')
    <script>
        $('#travelSw').on('change', function() {
            if ($(this).is(':checked')) {
                $('.travel_km').removeClass('d-none');
            } else {
                $('.travel_km').addClass('d-none').val('');
            }
        });
        $.validator.addMethod("greaterThan", function(value, element, param) {
            let min = $(param).val();
            if (min === '') return true;
            return parseFloat(value) >= parseFloat(min);
        }, "Max price must be greater than min price");
        $('#step2Form').validate({
            rules: {
                headline: {
                    required: true,
                    minlength: 10
                },
                charge_period: {
                    required: true
                },
                min_price: {
                    required: true,
                    number: true,
                    min: 1
                },
                max_price: {
                    required: true,
                    number: true,
                    greaterThan: '[name="min_price"]'
                },
                years_teaching: {
                    required: true,
                    number: true,
                    min: 0
                },
                years_online: {
                    required: true,
                    number: true,
                    min: 0
                },
                travel_km: {
                    required: {
                        depends: function() {
                            return $('#travelSw').is(':checked');
                        }
                    },
                    number: true,
                    min: 1
                }
            },

            messages: {
                headline: {
                    required: "Professional headline is required",
                    minlength: "Headline must be at least 10 characters"
                },
                charge_period: {
                    required: "Please select charge period"
                },
                min_price: {
                    required: "Minimum price is required",
                    number: "Enter valid amount",
                    min: "Price must be greater than 0"
                },
                max_price: {
                    required: "Maximum price is required",
                    number: "Enter valid amount",
                    greaterThan: "Max price must be greater than or equal to min price"
                },
                years_teaching: {
                    required: "Offline teaching experience is required",
                    number: "Enter valid years"
                },
                years_online: {
                    required: "Online teaching experience is required",
                    number: "Enter valid years"
                },
                travel_km: {
                    required: "Please enter max travel KM",
                    number: "Enter valid KM",
                    min: "KM must be at least 1"
                }
            },

            errorElement: 'small',
            errorClass: 'text-danger',
            highlight: function(element) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid');
            }

        });
        $('#nextBtn').click(function() {
            // Only save if this is Step 2
            if (currentStep === 1 && $('#step2Form').valid()) {
                const step2Data = {
                    headline: $('input[name="headline"]').val(),
                    charge_period: $('select[name="charge_period"]').val(),
                    min_price: $('input[name="min_price"]').val(),
                    max_price: $('input[name="max_price"]').val(),
                    years_teaching: $('input[name="years_teaching"]').val(),
                    years_online: $('input[name="years_online"]').val(),
                    travel_km: $('input[name="travel_km"]').val()
                };
                localStorage.setItem('step_1', JSON.stringify(step2Data));
            }
        });
    </script>
@endpush
