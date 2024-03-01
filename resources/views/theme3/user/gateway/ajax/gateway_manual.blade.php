<div class="row">
    <div class="col-12 text-center mb-1 pb-2 border-bottom border-5 border-primary">
        <img width="150px" src="{{ getFile('gateways', $gateway->gateway_image) }}"alt="">
    </div>
    <div class="col-12 mb-1">
        <div class="row align-items-center">
            <div class="col-auto">
                <img width="55px" height="55px;" class="rounded-circle border p-1" src="{{ getFile('icon', @$general->favicon) }}" alt="logo">
            </div>
            <div class="col">
                <p class="mb-0 text-dark"><b>{{ $general->sitename }}</b></p>
                <p class="mb-0">Method: {{ $gateway->gateway_name }}</p>
            </div>
            <div class="col-auto">
                <p class="mb-0 text-dark">
                    <b>
                        {{ showAmount($deposit->final_amount) .' ' . @$deposit->gateway->gateway_parameters->gateway_currency }}
                    </b>
                </p>
            </div>
        </div>
    </div>
    <div class="col-12 bg-primary">
        <div class="p-1">
            <div class="row py-1 border-bottom">
                <div class="col">
                    Amount:
                </div>
                <div class="col-auto">
                    {{ number_format($deposit->amount, 2) . ' ' . @$general->site_currency }}
                </div>
            </div>
            <div class="row py-1 border-bottom">
                <div class="col">
                    Charge:
                </div>
                <div class="col-auto">
                    {{ number_format($deposit->charge, 2) . ' ' . @$general->site_currency }}
                </div>
            </div>
            <div class="row py-1 border-bottom">
                <div class="col">
                    Conversion Rate:
                </div>
                <div class="col-auto">
                    {{ '1 ' . @$general->site_currency . ' = ' . showAmount($deposit->rate) . ' ' . @$deposit->gateway->gateway_parameters->gateway_currency }}
                </div>
            </div>
            <div class="row py-1">
                <div class="col">
                    Total Payable Amount:
                </div>
                <div class="col-auto">
                    {{ showAmount($deposit->final_amount) .' ' . @$deposit->gateway->gateway_parameters->gateway_currency }}
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 my-3">
        @if (@$gateway->gateway_parameters->qr_code)
        <div class="text-center mb-2">
            <h3 class="mb-2">Scan QR CODE</h3>
            <img class="img-thumbnail mb-2" width="200px" src="{{ getFile('gateways', @$gateway->gateway_parameters->qr_code) }}"alt="">
            <h3 class="mb-0">OR</h3>
        </div>
        @endif

        <style>
            p{
                margin-bottom: 0px !important;
            }
        </style>

        <label for="">{!! @$gateway->gateway_parameters->instruction !!}</label>
        <div class="row align-items-center">
            <div class="col pe-0">
                <input type="text" class="form-control copy-address" value="{{@$gateway->gateway_number}}" readonly>
            </div>
            <div class="col-auto">
                <button class="after-append bg-primary copyBtn">
                    Copy
                </button>
            </div>
        </div>

    </div>

    <div class="col-12 my-2">
        <form id="menualConfirmForm" action="{{route('user.ajax.gateway.confirm')}}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$gateway->id}}">
            <div class="row">
                @if ($gateway->user_proof_param != null)
                    @foreach ($gateway->user_proof_param as $proof)
                        @if ($proof['type'] == 'text')
                            <div class="form-group col-md-12 text-center">
                                <label for="" class="mb-1">{{ __($proof['field_name']) }}</label>
                                <input type="text"
                                    name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}"
                                    class="form-control rounded-pill"
                                    {{ $proof['validation'] == 'required' ? 'required' : '' }}>
                            </div>
                        @endif
                        @if ($proof['type'] == 'textarea')
                            <div class="form-group col-md-12">
                                <label for=""
                                    class="mb-2 mt-2">{{ __($proof['field_name']) }}</label>
                                <textarea name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}" class="form-control"
                                    {{ $proof['validation'] == 'required' ? 'required' : '' }}></textarea>
                            </div>
                        @endif

                        @if ($proof['type'] == 'file')
                            <div class="form-group col-md-12">
                                <label for=""
                                    class="mb-2 mt-2">{{ __($proof['field_name']) }}</label>
                                <input type="file"
                                    name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}"
                                    class="form-control"
                                    {{ $proof['validation'] == 'required' ? 'required' : '' }}>
                            </div>
                        @endif
                    @endforeach
                @endif
                <div class="form-group">
                    <button id="menualConfirmFormSubmitBtn" class="btn btn-primary btn-lg mt-1 w-100" type="submit">Deposit Now</button>
                </div>
            </div>
        </form>
    </div>
</div>





{{-- <div class="row gy-4">

    <div class="col-md-12">
        <div class="site-card">
            <div class="card-header">
                <h5 class="mb-0">{{ __('Requirments') }}</h5>
            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        @if ($gateway->user_proof_param != null)
                            @foreach ($gateway->user_proof_param as $proof)
                                @if ($proof['type'] == 'text')
                                    <div class="form-group col-md-12">
                                        <label for=""
                                            class="mb-2 mt-2">{{ __($proof['field_name']) }}</label>
                                        <input type="text"
                                            name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}"
                                            class="form-control"
                                            {{ $proof['validation'] == 'required' ? 'required' : '' }}>
                                    </div>
                                @endif
                                @if ($proof['type'] == 'textarea')
                                    <div class="form-group col-md-12">
                                        <label for=""
                                            class="mb-2 mt-2">{{ __($proof['field_name']) }}</label>
                                        <textarea name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}" class="form-control"
                                            {{ $proof['validation'] == 'required' ? 'required' : '' }}></textarea>
                                    </div>
                                @endif

                                @if ($proof['type'] == 'file')
                                    <div class="form-group col-md-12">
                                        <label for=""
                                            class="mb-2 mt-2">{{ __($proof['field_name']) }}</label>
                                        <input type="file"
                                            name="{{ strtolower(str_replace(' ', '_', $proof['field_name'])) }}"
                                            class="form-control"
                                            {{ $proof['validation'] == 'required' ? 'required' : '' }}>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                        <div class="form-group">
                            <button class="btn main-btn mt-4" type="submit">{{ __('Deposit Now') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}

<script>
    'use strict';
    var copyButton = document.querySelector('.copyBtn');
    var copyInput = document.querySelector('.copy-address');
    copyButton.addEventListener('click', function(e) {
        e.preventDefault();
        var text = copyInput.select();
        document.execCommand('copy');
        notifyMsg('Copy Successfully!','success');
    });
    copyInput.addEventListener('click', function() {
        this.select();
    });
</script>
