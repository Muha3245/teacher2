{{-- =================== Other Details Modal =================== --}}
<div class="modal fade" id="editOtherModal{{ $profile->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Edit Contact & Other Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form class="ajaxForm" data-url="{{ route('teacher.profile.phone') }}" method="POST"
                data-id="{{ $profile->id }}">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    {{-- Phones --}}
                    @foreach ($profile->phones as $phone)
                        <div class="mb-3">
                            <label class="form-label small fw-bold">Phone</label>
                            <input type="text" name="phones[{{ $phone->id }}][number]" class="form-control"
                                value="{{ $phone->phone }}">
                            <label class="form-label small fw-bold mt-1">Country Code</label>
                            <input type="text" name="phones[{{ $phone->id }}][code]" class="form-control"
                                value="{{ $phone->country_code }}">
                        </div>
                    @endforeach

                    {{-- Charge Period --}}
                    <div class="mb-3">
                        <label class="form-label small fw-bold">Charge Period</label>
                        <select name="charge_period" class="form-select">
                            <option value="hourly" {{ $profile->charge_period == 'hourly' ? 'selected' : '' }}>Hourly</option>
                            <option value="weekly" {{ $profile->charge_period == 'weekly' ? 'selected' : '' }}>Weekly</option>
                            <option value="monthly" {{ $profile->charge_period == 'monthly' ? 'selected' : '' }}>Monthly</option>
                        </select>
                    </div>

                    {{-- Min & Max Price --}}
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Min Price</label>
                            <input type="number" name="min_price" class="form-control" 
                                value="{{ $profile->min_price }}" placeholder="Minimum Rate">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label small fw-bold">Max Price</label>
                            <input type="number" name="max_price" class="form-control" 
                                value="{{ $profile->max_price }}" placeholder="Maximum Rate">
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
