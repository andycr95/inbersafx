<div class="d-none" id="currentPath">Deposit_Log</div>

<!-- Logs Navigation -->
@include('theme3.includes.user.logs_nav')

<!-- Deposit History -->
<div class="section my-3">
    <div class="transactions">
        @foreach ($transactions as $k => $data)
        <!-- item -->
        <a href="#" class="item pt-1 pb-1 px-3">
            <div class="detail">
                <img src="https://cdn-icons-png.flaticon.com/128/2921/2921222.png" class="image-block imaged w48" alt="">

                <div>
                    <strong>Deposit via {{ __(@$data->gateway->gateway_name)  }}</strong>
                    <p class="small text-secondary">
                        Trx: <b class="text-info">{{ $data->transaction_id }}</b>
                        <br>
                        {{showDateTime($data->created_at, 'd-m-Y')}} | {{ diffForHumans($data->created_at) }}
                    </p>
                </div>
            </div>
            <div align="right" class="col-auto">
                <h5 class="text-danger mb-1">
                    {{__($general->currency_sym)}} {{ showAmount($data->amount) }}
                </h5>
                @if($data->payment_status == 1)
                    <span class="badge badge-success style--light">@lang('Complete')</span>
                @elseif($data->payment_status == 2)
                    <span class="badge badge-warning style--light">@lang('Pending')</span>
                @elseif($data->payment_status == 3)
                    <span class="badge badge-danger style--light">@lang('Rejected')</span>
                @endif
            </div>
        </a>
        <!-- * item -->
        @endforeach
    </div>
</div>
<!-- * Deposit History -->

