<div class="mt-2 mb-3">
    <div class="container">
        <div class="card mb-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="mb-0 text-pink">Investment Plans</h3>
                        <p class="mb-0">Invest Now and Earn Money</p>
                    </div>
                    <div class="col-auto">
                        <img width="100px" src="{{asset('asset/images/icons-3d/vip-lock.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card mb-2 bg-pink-light-alt">
            <div class="card-body">
                <h2 class="text-center text-white mb-0">Investmrnt Plan</h2>
            </div>
        </div> --}}
        <div class="row">
            @forelse ($plans as $plan)
                @php
                    $plan_exist = App\Models\Payment::where('plan_id', $plan->id)
                        ->where('user_id', Auth::id())
                        ->where('next_payment_date', '!=', null)
                        ->where('payment_status', 1)
                        ->count();
                @endphp
                <div class="col-6 mb-2">
                    <div class="card bg-pink-light-alt">
                        <div class="card-body">
                            {{-- <img class="img-fluid pe-1" src="{{ asset('asset/images/site-icons/vip-3.png') }}" alt="plan"> --}}
                            <div class="text-center">
                                <img style="height: 70px" src="{{asset('asset/images/plan-img/' . $plan->plan_image)}}" alt="">
                            </div>
                            <h2 class="text-center mt-3 mb-1">{{ $plan->plan_name }}</h2>
                            <h4 class="text-center">
                                <span class="plan-amount">
                                    {{ number_format($plan->return_interest, 2) }}
                                    @if ($plan->interest_status == 'percentage')
                                        {{ '%' }}
                                    @else
                                        {{ @$general->site_currency }}
                                    @endif
                                </span>
                                <span class="plan-status">{{ $plan->time->name }}</span>
                            </h4>

                            @if ($plan->amount_type == 0)
                                <div class="row border-bottom">
                                    <div class="col ps-0" style="padding-right: 3px !important;">Min</div>
                                    <div class="col-auto px-0">{{showAmount($plan->minimum_amount)}} {{ @$general->currency_sym }}</div>
                                </div>
                                <div class="row border-bottom ">
                                    <div class="col ps-0" style="padding-right: 3px !important;">Max</div>
                                    <div class="col-auto px-0">{{showAmount($plan->maximum_amount)}} {{ @$general->currency_sym }}</div>
                                </div>
                            @else
                                <div class="row border-bottom">
                                    <div class="col ps-0" style="padding-right: 3px !important;">Amount</div>
                                    <div class="col-auto px-0">{{showAmount($plan->amount)}} {{ @$general->currency_sym }}</div>
                                </div>
                            @endif

                            <div class="row border-bottom">
                                <div class="col ps-0" style="padding-right: 3px !important;">For</div>
                                <div class="col-auto px-0">
                                    @if ($plan->return_for == 1)
                                        {{ $plan->how_many_time }} {{ __('Times') }}
                                    @else
                                        {{ __('Lifetime') }}
                                    @endif
                                </div>
                            </div>
                            <div class="row border-bottom">
                                <div class="col ps-0" style="padding-right: 3px !important;">Capital Back</div>
                                <div class="col-auto px-0">
                                    @if ($plan->capital_back == 1)
                                        YES
                                    @else
                                        NO
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-3 mb-1">
                                    @if ($plan_exist >= $plan->invest_limit)
                                        <a class="btn btn-sm btn-primary plan-btn w-100 disabled" href="#">{{ __('Limit Over') }}</a>
                                    @else
                                        @auth
                                            <button class="btn btn-pink-light plan-btn balance w-100" data-plan="{{ $plan }}" data-url="">{{ __('Invest Now') }}</button>
                                        @endauth
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty

            @endforelse
        </div>
    </div>
</div>


<div class="modal fade" id="invest" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{ route('user.investmentplan.submit') }}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('Invest Now') }}</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="form-group">
                            <label for="">{{ __('Invest Amount') }}</label>
                            <input type="text" name="amount" class="form-control">
                            <input type="hidden" name="plan_id" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                        data-bs-dismiss="modal">{{ __('Close') }}</button>
                    <button type="submit" class="btn btn-success">{{ __('Invest Now') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Investment Plan-->
<script>
    $(function() {
        'use strict'

        $(document).on('click', '.balance', function() {
            const modal = $('#invest');
            modal.find('input[name=plan_id]').val($(this).data('plan').id);
            modal.modal('show')
        })
    })
</script>

{{-- @push('script')
    <script>
        $(function() {
            'use strict'

            $('.balance').on('click', function() {
                const modal = $('#invest');
                modal.find('input[name=plan_id]').val($(this).data('plan').id);
                modal.modal('show')
            })
        })
    </script>
@endpush --}}
