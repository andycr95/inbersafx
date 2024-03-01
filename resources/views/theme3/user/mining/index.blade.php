@extends(template().'layout.master2')

@section('content2')
@include('theme3.user.action_modal.mining_action')
<style>
    body{
        overflow: hidden !important;
    }
</style>

    <div class="container">
        <div class="card" style="border-radius: 25px">
            <div class="card-body p-1">
                <div class="row align-items-center">
                    <div class="col-auto pe-1">
                        <img style="width: 45px" src="{{asset('asset/images/site-icons/aitrade.png')}}" alt="">
                    </div>
                    <div class="col px-1">
                        <p class="small-font-lg mb-0 text-light text-start">
                            <b class="fw-bold">AI Trading</b><br>
                            Turn it on to earn crypto coins
                        </p>
                    </div>
                    <div class="col-auto ps-1">
                        <div class="input-group">
                            @if ($user->isMining != 1)
                                <button class="btn btn-sm btn-gr-red input-group-text border-0" data-bs-toggle="modal" data-bs-target="#miningModal" disabled></button>
                                <button class="btn btn-sm btn-dark border-0" data-bs-toggle="modal" data-bs-target="#miningModal">ON</button>
                            @else
                                <button class="btn btn-sm btn-dark input-group-text border-0" data-bs-toggle="modal" data-bs-target="#miningModal" disabled>OFF</button>
                                <button class="btn btn-sm btn-gr-green-light border-0" data-bs-toggle="modal" data-bs-target="#miningModal" disabled></button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <p><center><font style="color: #F0B90B;">Ai Trade Schedule:</font><br/>9:00 AM To 1:00 PM- Washington, DC, USA<br/>100% Profit - 0% Risk Free. </center></p>
        
        <div class="py-3 text-center">
            {{-- <img class="{{ $user->isMining == 1 ? 'spin-now' : '' }}" style="max-height: 160px;" src="{{asset('asset/images/site-icons/tron.png')}}" alt=""> --}}
            <img class="{{ $user->isMining == 1 ? 'spin-now' : '' }}" style="max-height: 160px;" src="{{asset('asset/theme3/images/coin_image/coin_image.png')}}" alt="">
            <h3 class="text-center text-light my-3">
                {{ @$general->coin_name }}
            </h3>
        </div>
    </div>

    <div class="tradingview-widget-container" style="height: 51vh">
        <div class="tradingview-widget-container__widget"></div>
        <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-market-overview.js" async>
            {
                "colorTheme": "dark",
                "dateRange": "12M",
                "showChart": true,
                "locale": "en",
                "width": "100%",
                "largeChartUrl": "",
                "isTransparent": true,
                "showSymbolLogo": true,
                "showFloatingTooltip": true,
                "tabs": [
                {
                    "title": "Crypto",
                    "symbols": [
                    {
                        "s": "BINANCE:BTCUSDT"
                    },
                    {
                        "s": "BINANCE:TRXUSDT"
                    },
                    {
                        "s": "BINANCE:ETHUSDT"
                    },
                    {
                        "s": "BINANCE:XRPUSDT"
                    },
                    {
                        "s": "BINANCE:MATICUSDT"
                    },
                    {
                        "s": "BINANCE:AVAXUSDT"
                    },
                    {
                        "s": "BINANCE:FTMUSDT"
                    },
                    {
                        "s": "BINANCE:DOGEUSDT"
                    },
                    {
                        "s": "BINANCE:SHIBUSDT"
                    },
                    {
                        "s": "BINANCE:SOLUSDT"
                    }
                    ],
                    "originalTitle": "Forex"
                }
                ]
            }
        </script>
    </div>



@endsection

@push('script')
<script>
</script>
@endpush
