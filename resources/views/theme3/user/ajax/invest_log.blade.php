<div class="d-none" id="currentPath">Invest_Log</div>

<script>
    
        function getCountDown(elementId, seconds) {
            var times = seconds;
            
            var x = setInterval(function() {
                var distance = times * 1000;
                
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById(elementId).innerHTML = "COMPLETE";
                }
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                if ($('#currentPath').html() == 'Invest_Log') {
                    document.getElementById(elementId).innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
                }else{
                    clearInterval(x);
                }
                times--;
            }, 1000);
        }
</script>

<!-- Logs Navigation -->
@include('theme3.includes.user.logs_nav')

<!-- Invest History -->
<div class="section my-3">
    <div class="transactions">
        @foreach ($transactions as $k => $data)
        <!-- item -->
        <a href="#" class="item pt-1 pb-1 px-3">
            <div class="detail">
                <img src="{{asset('asset/images/2d-icon/3/history.png')}}" class="image-block imaged w48" alt="">

                <div>
                    <strong>
                        @if ($data->gateway_id == 0)
                            {{ __('Invest Using Balance') }}
                        @else
                            {{ @$data->gateway->gateway_name ?? 'Account Transfer' }}
                        @endif
                    </strong>
                    <p class="small text-secondary">
                        Trx: <b class="text-info">{{ $data->transaction_id }}</b>
                        <br>
                        {{showDateTime($data->created_at, 'd-m-Y')}} | {{ diffForHumans($data->created_at) }}
                        <br>
                        Upcoming Payment: 
                        <b class="text-info">
                            <p id="count_{{ $loop->iteration }}"></p>
                            <script>
                                if ($('#currentPath').html() == 'Invest_Log') {
                                    getCountDown("count_{{ $loop->iteration }}", "{{ now()->diffInSeconds($data->next_payment_date) }}")
                                }
                            </script>
                        </b>
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
<!-- * Invest History -->

