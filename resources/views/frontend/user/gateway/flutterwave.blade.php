@extends(template().'layout.master2')

@section('content2')
    <div class="dashboard-body-part">
        <div class="card">
            <div class="card-header text-center">
                <h5>{{ __('Payment Preview') }}</h5>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    @if(!(session('type') == 'deposit'))
                    <li class="list-group-item text-light  d-flex justify-content-between">
                        <span>{{ __('Plan Name') }}:</span>

                        <span>{{ $deposit->plan->plan_name }}</span>

                    </li>
                    @endif
                    <li class="list-group-item   text-white d-flex justify-content-between">
                        <span>{{ __('Gateway Name') }}:</span>

                        <span>{{ $deposit->gateway->gateway_name }}</span>

                    </li>
                    <li class="list-group-item   text-white d-flex justify-content-between">
                        <span>{{ __('Amount') }}:</span>
                        <span>{{ number_format($deposit->amount, 2) }}</span>
                    </li>

                    <li class="list-group-item  text-white  d-flex justify-content-between">
                        <span>{{ __('Charge') }}:</span>
                        <span>{{ number_format($deposit->charge, 2) }}</span>
                    </li>


                    <li class="list-group-item  text-white  d-flex justify-content-between">
                        <span>{{ __('Conversion Rate') }}:</span>
                        <span>{{ '1 ' . @$general->site_currency . ' = ' . number_format($deposit->rate, 2) }}</span>
                    </li>

                    <li class="list-group-item   text-white d-flex justify-content-between">
                        <span>{{ __('Total Payable Amount') }}:</span>
                        <span>{{ number_format($deposit->final_amount, 2) }}</span>
                    </li>
                </ul>
                <div class="mt-3 text-end">
                    <button type="submit" class="cmn-btn flutter" data-amount="{{ number_format($deposit->final_amount, 2) }}" >{{ __('Pay With Flutterwave') }}</button>
                </div>
            </div>
        </div>
    </div>
    @php
        session()->forget('transaction_id');
        session()->put('transaction_id' , $deposit->transaction_id)
    @endphp
@endsection


@push('script')

<script src="https://checkout.flutterwave.com/v3.js"></script>

<script>
    $(function(){
        'use strict'
        $('.flutter').on('click', function(e){
            e.preventDefault();

            makePayment($(this).data('amount'))
        })
    })

    function makePayment(amount) {
        FlutterwaveCheckout({
            public_key: "{{$deposit->gateway->gateway_parameters->public_key}}",
            tx_ref: "{{$deposit->gateway->gateway_parameters->reference_key}}",
            amount: amount,
            currency: "{{$deposit->gateway->gateway_parameters->gateway_currency}}",
            payment_options: "card, banktransfer, ussd",
            redirect_url: "{{route('user.flutter.success')}}",
            meta: {
                consumer_id: 23,
                consumer_mac: "92a3-912ba-1192a",
            },
            customer: {
                email: "{{auth()->user()->email}}",
                name: "{{auth()->user()->username}}",
            },
            customizations: {
                title: "{{$general->sitename}}",
                description: "Payment for purchasing a plan",
                logo: "{{getFile('logo', $general->logo)}}",
            },
        });
    }
</script>
@endpush

