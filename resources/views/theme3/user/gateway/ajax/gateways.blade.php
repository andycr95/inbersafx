<div class="row">
    <div class="col-12">
        <h4 class="text-center">Select Method</h4>
    </div>
    @foreach ($gateways as $gateway)
        <div class="col-4 mb-2">
            <div class="gatewayItem text-center" data-id="{{ $gateway->id }}" data-name="{{ $gateway->name }}"
                data-charge="{{ $gateway->charge }}" data-rate="{{ $gateway->rate }}"
                data-min_limit="{{ $gateway->min_limit }}" data-max_limit="{{ $gateway->max_limit }}"
                data-curr="{{ $gateway->gateway_parameters->gateway_currency }}">
                <img src="{{ getFile('gateways', $gateway->gateway_image) }}" alt="Lights" class="trans-img">
            </div>
        </div>
    @endforeach
</div>

<ul id="detailPreview" class="listview simple-listview inset mb-3 d-none">
    <li>1 {{ $general->site_currency }}: <span id="rateView"></span></li>
    <li>Charge: <span id="chargeView"></span></li>
    <li>Min Limit: <span id="minView"></span></li>
    <li>Max Limit: <span id="maxView"></span></li>
</ul>
<form id="paynowForm" action="{{ route('user.ajax.paynow') }}" method="post">
    @csrf
    <div class="row align-items-center">
        <div class="col pe-0">
            <input type="hidden" name="id" id="methodID" value="">
            <input type="number" class="form-control" placeholder="Enter Amount" name="amount" required>
            <input type="hidden" name="user_id" class="form-control" value="{{ auth()->id() }}">
            <input type="hidden" name="type" class="form-control" value="deposit">
        </div>
        <div class="col-auto">
            <div class="after-append">
                {{ $general->site_currency }}
            </div>
        </div>
    </div>

    <div class="my-3">
        <button type="submit" class="btn btn-primary btn-lg gr-bg-blue w-100" id="amountSubmitBtn">Next Step</button>
    </div>
</form>







{{-- <div class="dashboard-body-part">

        <div class="row g-sm-4 g-3 justify-content-center">
            @forelse ($gateways as $gateway)
                <div class="col-xxl-2 col-lg-3 col-sm-4 col-6">
                    <div class="payment-box text-center">
                        <div class="payment-box-thumb">
                            <img src="{{ getFile('gateways', $gateway->gateway_image) }}" alt="Lights" class="trans-img">
                        </div>
                        <div class="payment-box-content">
                            <h5 class="title">{{ ucwords(str_replace('_',' ',$gateway->gateway_name)) }}</h5>
                            <button data-href="{{ route('user.paynow', $gateway->id) }}" data-id="{{ $gateway->id }}" class="btn main-btn w-100 paynow mt-3">{{ __('Pay Now') }}</button>
                        </div>
                    </div>
                </div>
            @empty
                {{ __('Not Found') }}
            @endforelse

        </div>
    </div>

    @if (isset($type) && $type == 'deposit')
    <div class="modal fade" tabindex="-1" role="dialog" id="paynow">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content bg-body">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Deposit Amount') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-light">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" value="">
                            <div class="form-group">
                                <label for="">{{ __('Amount') }}</label>
                                <input type="text" name="amount" class="form-control" placeholder="{{ __('Enter Amount') }}">

                                <input type="hidden" name="user_id" class="form-control" value="{{ auth()->id() }}">
                                <input type="hidden" name="type" class="form-control" value="deposit">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn main-btn">{{ __('Deposit Now') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @else
    <div class="modal fade" tabindex="-1" role="dialog" id="paynow">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content bg-body">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Invest Amount') }}</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-light">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" name="id" value="">
                            <div class="form-group">
                                <label for="">{{ __('Amount') }}</label>
                                <input type="text" name="amount" class="form-control"
                                    placeholder="{{ __('Enter Amount') }}">

                                <input type="text" name="plan_id" class="form-control" value="{{ $plan->id  }}" hidden>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger"
                            data-bs-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn main-btn">{{ __('Invest Now') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endif --}}
