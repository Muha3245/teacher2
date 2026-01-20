<form id="step5Form">
    @csrf
    <input type="hidden" id="phone_editing_id" value="">
    <h5 class="fw-bold mb-3">Phone Numbers</h5>

    <div class="col-md-6 mb-2">
        <label class="form-label">Phone Number</label>
        <input type="tel" id="phone_input" name="phone_input" class="form-control">
        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
        <small class="text-danger d-none" id="phone-error"></small>
    </div>

    <button type="button" class="btn btn-sm btn-outline-primary mb-3" id="add-phone">
        + Add Phone
    </button>

    <div id="phones-list">
        @if (!empty($singleprofile) && $singleprofile->phones->count())
            @foreach ($singleprofile->phones as $phone)
                <div class="phone-box bg-light border rounded-3 p-2 mb-2 d-flex justify-content-between align-items-center"
                    data-id="{{ $phone->id }}" data-phone="{{ $phone->phone }}">
                    <span>+{{ $phone->country_code }}-{{ $phone->phone }}</span>
                    <div>
                        <i class="bi bi-pencil-square text-dark me-2 edit-phone" style="cursor:pointer"></i>
                        <i class="bi bi-x-circle text-danger delete-phone" style="cursor:pointer"></i>
                    </div>
                </div>
            @endforeach
        @endif
        <div
            class="text-muted empty-phone-msg {{ !empty($singleprofile) && $singleprofile->phones->count() ? 'd-none' : '' }}">
            No phone numbers added yet.
        </div>
    </div>
</form>
@push('multistepteacherdashscripts')
    <script>
        /* -----------------------------
                intl-tel-input Initialization
            ----------------------------- */
        const phoneInput = document.querySelector("#phone_input");
        const iti = window.intlTelInput(phoneInput, {
            initialCountry: "pk",
            separateDialCode: true,
            nationalMode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.19/js/utils.js"
        });

        /**
         * CUSTOM VALIDATION FUNCTION
         * @param {string} number - The raw number from input
         * @param {string} countryIso - The ISO code (pk, us, etc.)
         */
        function validatePhoneNumber(number, countryIso) {
            let result = {
                isValid: true,
                message: ""
            };

            // Remove everything except numbers
            const digitsOnly = number.replace(/\D/g, '');

            switch (countryIso) {
                case 'pk': // Pakistan: Expecting 10 digits (e.g., 3446608702)
                    if (digitsOnly.length !== 10) {
                        result.isValid = false;
                        result.message = "Pakistan numbers must be exactly 10 digits (exclude 0).";
                    }
                    break;

                case 'us': // USA
                case 'ca': // Canada
                    if (digitsOnly.length !== 10) {
                        result.isValid = false;
                        result.message = "US/Canada numbers must be 10 digits.";
                    }
                    break;

                case 'gb': // UK
                    if (digitsOnly.length < 10 || digitsOnly.length > 11) {
                        result.isValid = false;
                        result.message = "UK numbers must be 10 or 11 digits.";
                    }
                    break;

                default: // Global standard (usually between 7 and 15 digits)
                    if (digitsOnly.length < 7 || digitsOnly.length > 15) {
                        result.isValid = false;
                        result.message = "Please enter a valid phone number length.";
                    }
                    break;
            }

            return result;
        }

        // Helper: Reset Form
        function resetPhoneForm() {
            $('#phone_input').val('');
            $('#phone_editing_id').val('');
            $('#phone-error').addClass('d-none').text('');
            $('#add-phone').text('+ Add Phone').removeClass('btn-success').addClass('btn-outline-primary');
        }

        /* -----------------------------
            ADD or UPDATE Phone
        ----------------------------- */
        $('#add-phone').on('click', function() {
            const editingId = $('#phone_editing_id').val();
            const rawValue = $('#phone_input').val().trim();
            const countryData = iti.getSelectedCountryData();

            if (rawValue === "") {
                $('#phone-error').removeClass('d-none').text('Phone number is required.');
                return;
            }

            const validation = validatePhoneNumber(rawValue, countryData.iso2);

            if (!validation.isValid) {
                $('#phone-error').removeClass('d-none').text(validation.message);
                toastr.error(validation.message);
                return;
            } else {
                $('#phone-error').addClass('d-none'); 
            }

            const dialCode = countryData.dialCode;
            const cleanNumber = rawValue.replace(/^0+/, ''); 

            const payload = {
                country_code: dialCode,
                phone_number: cleanNumber,
                phone_id: editingId,
                user_id: $('input[name="user_id"]').val(),
                edit: editingId ? true : false,
                _token: '{{ csrf_token() }}'
            };

            $.ajax({
                url: '/api/stepfive',
                type: 'POST',
                data: payload,
                dataType: 'json',
                beforeSend: function() {
                    $('#add-phone').prop('disabled', true).text('Processing...');
                },
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        $('.empty-phone-msg').addClass('d-none');

                        const html = `
                        <div class="phone-box bg-light border rounded-3 p-2 mb-2 d-flex justify-content-between align-items-center"
                            data-id="${res.phone_id}"
                            data-phone="${res.phone_number}">
                            <span>+${res.country_code}-${res.phone_number}</span>
                            <div>
                                <i class="bi bi-pencil-square text-dark me-2 edit-phone" style="cursor:pointer"></i>
                                <i class="bi bi-x-circle text-danger delete-phone" style="cursor:pointer"></i>
                            </div>
                        </div>`;

                        if (payload.edit) {
                            $(`.phone-box[data-id="${res.phone_id}"]`).replaceWith(html);
                        } else {
                            $('#phones-list').append(html);
                        }
                        resetPhoneForm();
                    } else {
                        toastr.error(res.message);
                    }
                },
                error: function(xhr) {
                    toastr.error('System error occurred.');
                },
                complete: function() {
                    $('#add-phone').prop('disabled', false);
                    if (!$('#phone_editing_id').val()) {
                        $('#add-phone').text('+ Add Phone');
                    } else {
                        $('#add-phone').text('Update Phone');
                    }
                }
            });
        });

        /* -----------------------------
            EDIT & DELETE Logic
        ----------------------------- */
        $(document).on('click', '.edit-phone', function() {
            const box = $(this).closest('.phone-box');
            const phone = box.data('phone');
            $('#phone_editing_id').val(box.data('id'));
            iti.setNumber(phone.toString());
            $('#add-phone').text('Update Phone').removeClass('btn-outline-primary').addClass('btn-success');
            $('#phone_input').focus();
        });

        $(document).on('click', '.delete-phone', function() {
            const boxActual = $(this).closest('.phone-box');
            if (!confirm('Remove this phone number?')) return;

            $.ajax({
                url: '/api/stepfive/delete',
                type: 'POST',
                data: {
                    phone_id: boxActual.data('id'),
                    _token: '{{ csrf_token() }}'
                },
                success: function(res) {
                    if (res.status) {
                        toastr.success(res.message);
                        boxActual.fadeOut(300, function() {
                            $(this).remove();
                            if ($('.phone-box').length === 0) {
                                $('.empty-phone-msg').removeClass('d-none');
                            }
                        });
                    }
                }
            });
        });
    </script>
@endpush
