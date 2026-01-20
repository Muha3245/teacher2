<form id="step2Form">
    <div class="row g-4">
        <div class="col-12">
            <label class="form-label">Professional Headline</label>
            <input type="text" name="headline" value="{{ old('headline', optional($singleprofile)->headline) }}"
                class="form-control" placeholder="Ex: Senior Physics Professor with 15 Years Experience">
        </div>

        <div class="col-md-4">
            <label class="form-label">Charge Period</label>
            <select name="charge_period" class="form-select">
                <option value="Hourly"
                    {{ old('charge_period', optional($singleprofile)->charge_period) == 'Hourly' ? 'selected' : '' }}>
                    Hourly</option>
                <option value="Monthly"
                    {{ old('charge_period', optional($singleprofile)->charge_period) == 'Monthly' ? 'selected' : '' }}>
                    Monthly</option>
                <option value="Per Session"
                    {{ old('charge_period', optional($singleprofile)->charge_period) == 'Per Session' ? 'selected' : '' }}>
                    Per Session</option>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Min Price</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" name="min_price"
                    value="{{ old('min_price', optional($singleprofile)->min_price) }}" class="form-control">
            </div>
        </div>

        <div class="col-md-4">
            <label class="form-label">Max Price</label>
            <div class="input-group">
                <span class="input-group-text">$</span>
                <input type="number" name="max_price"
                    value="{{ old('max_price', optional($singleprofile)->max_price) }}" class="form-control">
            </div>
        </div>

        <div class="col-md-6">
            <label class="form-label">Teaching Experience (Offline)</label>
            <input type="number" name="years_teaching"
                value="{{ old('years_teaching', optional($singleprofile)->years_teaching) }}" class="form-control"
                placeholder="Years">
        </div>

        <div class="col-md-6">
            <label class="form-label">Teaching Experience (Online)</label>
            <input type="number" name="years_online"
                value="{{ old('years_online', optional($singleprofile)->years_online) }}" class="form-control"
                placeholder="Years">
        </div>
    </div>

    <div class="row mt-4 g-3 bg-light p-3 rounded-3">
        <div class="col-md-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="willing_to_travel" id="travelSw"
                    {{ old('willing_to_travel', optional($singleprofile)->willing_to_travel) ? 'checked' : '' }}>
                <label class="form-check-label fw-bold" for="travelSw">Willing to Travel</label>
            </div>
            <input type="number" name="travel_km" value="{{ old('travel_km', optional($singleprofile)->travel_km) }}"
                class="form-control form-control-sm mt-2 travel_km {{ optional($singleprofile)->willing_to_travel ? '' : 'd-none' }}"
                placeholder="Max KM">
        </div>

        <div class="col-md-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="has_digital_pen" id="penSw"
                    {{ old('has_digital_pen', optional($singleprofile)->has_digital_pen) ? 'checked' : '' }}>
                <label class="form-check-label fw-bold" for="penSw">Has Digital Pen</label>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" name="helps_homework" id="hwSw"
                    {{ old('helps_homework', optional($singleprofile)->helps_homework) ? 'checked' : '' }}>
                <label class="form-check-label fw-bold" for="hwSw">Helps with Homework</label>
            </div>
        </div>
    </div>

    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
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

        function step2ajax(e) {
            e.preventDefault();
            let formData = new FormData($('#step2Form')[0]);

            // Fix checkboxes
            formData.set('willing_to_travel', $('#travelSw').is(':checked') ? 1 : 0);
            formData.set('has_digital_pen', $('#penSw').is(':checked') ? 1 : 0);
            formData.set('helps_homework', $('#hwSw').is(':checked') ? 1 : 0);

            $.ajax({
                url: '/api/steptwo', // Your step 2 API
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        // Move to next step
                        currentStep++;
                        showStep(currentStep);
                        console.log(res.profile);
                    }
                },
                error: function(err) {
                    if (err.responseJSON && err.responseJSON.errors) {
                        let errors = err.responseJSON.errors;
                        for (let key in errors) {
                            toastr.error(errors[key][0]);
                            break;
                        }
                    } else {
                        toastr.error('Something went wrong!');
                    }
                }
            });
        }
    </script>
@endpush
