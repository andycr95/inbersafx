
<div class="d-none" id="currentPath">Referral_Log</div>

<!-- Logs Navigation -->
@include('theme3.includes.user.logs_nav')

<!-- Referral History -->
<div class="section my-3">
    <div class="transactions">
        @foreach ($commison as $k => $data)
        <!-- item -->
        <a href="#" class="item pt-1 pb-1 px-3">
            <div class="detail">
                <img src="{{asset('asset/images/2d-icon/3/history.png')}}" class="image-block imaged w48" alt="">

                <div>
                    <strong>{{$data->purpouse}} from <b class="text-success">{{ @$data->commissionFrom->username }}</b></strong>
                    <p class="small text-secondary">
                        {{showDateTime($data->created_at, 'd-m-Y')}} | {{ diffForHumans($data->created_at) }}
                    </p>
                </div>
            </div>
            <div align="right" class="col-auto">
                <h5 class="text-success mb-0">
                    {{__($general->currency_sym)}} {{ showAmount($data->amount) }}
                </h5>
            </div>
        </a>
        <!-- * item -->
        @endforeach
    </div>
</div>
<!-- * Referral History -->
