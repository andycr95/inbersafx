@php
$content = content('plan.content');
$plans = App\Models\Plan::where('status', 1)
    ->latest()
    ->get();
@endphp

{{-- <div class="">
    <!-- my cards -->
    <div class="section full mt-4">
        <div class="section-heading padding">
            <h2 class="title">Investment Plans</h2>
        </div>

        <!-- carousel single -->
        <div class="carousel-single splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @forelse ($plans as $plan)
                        @php
                            $plan_exist = App\Models\Payment::where('plan_id', $plan->id)
                                ->where('user_id', Auth::id())
                                ->where('next_payment_date', '!=', null)
                                ->where('payment_status', 1)
                                ->count();
                        @endphp
                    <li class="splide__slide">
                        <!-- card block -->
                        <div class="card-block bg-pink-light rounded-20px">
                            <div class="card-main rounded-20px">
                                <div class="card-button dropdown">
                                    @if ($plan_exist >= $plan->invest_limit)
                                        <a class="btn btn-sm btn-light disabled" href="javascript:void(0)">{{ __('Limit Over') }}</a>
                                    @else
                                        @auth
                                            <button type="button" class="btn btn-sm btn-light buyNowBtn" data-plan="{{ $plan }}" data-url="">BUY NOW</button>
                                        @endauth
                                        @guest
                                            <a class="btn btn-sm btn-light" href="{{ route('user.login') }}">BUY NOW</a>
                                        @endguest
                                    @endif
                                </div>
                                <div class="balance">
                                    <span class="label">Plan Name</span>
                                    <h1 class="title">{{ $plan->plan_name }}</h1>
                                </div>
                                <div class="in">
                                    <div class="card-number">
                                        <div class="row">
                                            @if ($plan->amount_type == 0)
                                                <div class="col">
                                                    <span class="label">Min</span>
                                                    <p class="mb-0 text-small">
                                                        {{ showAmount($plan->minimum_amount) }}
                                                    </p>
                                                </div>
                                                <div class="col">
                                                    <span class="label">Max</span>
                                                    <p class="mb-0 text-small">
                                                        {{ showAmount($plan->maximum_amount) }}
                                                    </p>
                                                </div>
                                            @else
                                                <div class="col">
                                                    <span class="label">Amount</span>
                                                    {{$general->currency_sym}} {{ showAmount($plan->amount) }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="bottom">
                                        <div class="card-expiry">
                                            <span class="label">For</span>
                                            @if ($plan->return_for == 1)
                                                {{ $plan->how_many_time }} {{ __('Times') }}
                                            @else
                                                {{ __('Lifetime') }}
                                            @endif
                                        </div>
                                        <div class="card-ccv">
                                            <span class="label">Capital Back</span>
                                            @if ($plan->capital_back == 1)
                                                YES
                                            @else
                                                NO
                                            @endif
                                        </div>
                                        <div class="card-ccv ms-2">
                                            <span class="label">Reward</span>
                                            {{ number_format($plan->return_interest, 2) }}
                                            @if ($plan->interest_status == 'percentage')
                                                {{ '%' }}
                                            @else
                                                {{ @$general->site_currency }}
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- * card block -->
                    </li>
                    @empty
                    @endforelse

                </ul>
            </div>
        </div>
        <!-- * carousel single -->

    </div>
    <!-- * my cards -->
</div> --}}

{{-- <div class="container">
    <div class="row gy-4 items-wrapper justify-content-center">
        @forelse ($plans as $plan)
            @php
                $plan_exist = App\Models\Payment::where('plan_id', $plan->id)
                    ->where('user_id', Auth::id())
                    ->where('next_payment_date', '!=', null)
                    ->where('payment_status', 1)
                    ->count();
            @endphp

            <div class="col-xl-12 col-md-6">
                <div class="plan-item">
                    <div class="plan-el">
                        <img src="{{ asset('asset/theme3/images/bg/plan3.png') }}" alt="image">
                    </div>
                    <div class="plan-name-area">
                        <h3 class="plan-name mb-2">{{ $plan->plan_name }}</h3>
                        <span class="plan-status">{{ __('Every') }} {{ $plan->time->name }}</span>
                    </div>
                    <div class="plan-fatures">
                        <ul class="plan-list">
                            @if ($plan->amount_type == 0)
                                <li>
                                    <span class="caption">{{ __('Minimum') }} </span>
                                    <span class="details">
                                        <span class="dynamicAmount">
                                            {{ number_format($plan->minimum_amount*(session()->has('currency_rate')?session()->get('currency_rate'):1), 2) }}
                                        </span>
                                        @if (session()->has('currency_name'))
                                            {{ session()->get('currency_name') }}
                                        @else
                                            {{ @$general->site_currency }}
                                        @endif
                                    </span>
                                </li>
                                <li>
                                    <span class="caption">{{ __('Maximum') }} </span>
                                    <span class="details">
                                        <span class="dynamicAmount">
                                            {{ number_format($plan->maximum_amount*(session()->has('currency_rate')?session()->get('currency_rate'):1), 2) }}
                                        </span>
                                        @if (session()->has('currency_name'))
                                            {{ session()->get('currency_name') }}
                                        @else
                                            {{ @$general->site_currency }}
                                        @endif
                                    </span>
                                </li>
                            @else
                                <li>
                                    <span class="caption">{{ __('Amount') }} </span>
                                    <span class="details">
                                        <span class="dynamicAmount">
                                            {{ number_format( $plan->amount*(session()->has('currency_rate')?session()->get('currency_rate'):1), 2) }}
                                        </span>
                                        @if (session()->has('currency_name'))
                                            {{ session()->get('currency_name') }}
                                        @else
                                            {{ @$general->site_currency }}
                                        @endif
                                    </span>
                                </li>
                            @endif

                            @if ($plan->return_for == 1)
                                <li>
                                    <span class="caption">{{ __('For') }} </span>
                                    <span class="details"> {{ $plan->how_many_time }} {{ __('Times') }}</span>
                                </li>
                            @else
                                <li>
                                    <span class="caption">{{ __('For') }} </span>
                                    <span class="details"> {{ __('Lifetime') }}</span>
                                </li>
                            @endif

                            @if ($plan->capital_back == 1)
                                <li>
                                    <span class="caption">{{ __('Capital Back') }} </span>
                                    <span class="details"> {{ __('YES') }}</span>
                                </li>
                            @else
                                <li>
                                    <span class="caption">{{ __('Capital Back') }} </span>
                                    <span class="details"> {{ __('NO') }}</span>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="plan-rio">
                        <h5>{{ __('Investment RIO') }}</h5>
                        <p class="plan-amount mb-2">
                            {{ number_format($plan->return_interest, 2) }} @if ($plan->interest_status == 'percentage')
                                {{ '%' }}
                            @else
                                {{ @$general->site_currency }}
                            @endif
                        </p>
                    </div>
                    <div class="plan-action">
                        @if ($plan_exist >= $plan->invest_limit)
                            <a class="btn main-btn plan-btn w-100 disabled" href="#">{{ __('Max Limit exceeded') }}</a>
                        @else
                            <a class="btn main-btn plan-btn w-100" href="{{ route('user.gateways', $plan->id) }}">{{ __('Invest Now') }}</a>
                            @auth
                            <button class="btn bg-transparent plan-btn balance w-100 mt-2" data-plan="{{ $plan }}"
                                data-url="">{{ __('Invest Using Balance') }}</button>
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
</div> --}}

{{-- <div class="container">
    <div class="card mt-2 bg-pink-light-alt">
        <div class="card-body">
            <h3 class="text-center text-white">Profit Calcululator</h3>
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-6 my-1">
                    <label class="mbl-h text-white">{{ __('Amount') }}</label>
                    <input type="text" class="form-control form-control-sm rounded-20px" name="amount" id="amount" placeholder="{{ __('Enter amount') }}">
                </div>
                <div class="col-lg-5 col-md-6 my-1">
                    <label class="mbl-h text-white">{{ __('Investment Plan') }}</label>
                    <select class="select form-control-sm rounded-20px" name="selectplan" id="plan">
                        <option selected disabled class="text-secondary">{{ __('Select a plan') }}</option>
                        @forelse ($plans as $item)
                            <option value="{{ $item->id }}">{{ $item->plan_name }}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <div class="col-lg-3 my-1">
                    <a href="#0" id="calculate-btn" class="btn btn-pink-light w-100"> {{ __('Calculate Earning') }}</a>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<div class="modal fade" id="invest" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="{{route('user.investmentplan.submit')}}" method="post">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{__('Invest Now')}}</h5>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{__('Close')}}</button>
                    <button type="submit" class="btn main-btn">{{__('Invest Now')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).on("change", '#cngCurrency', function () {
        $("#curFormjq").submit();
    });

    $(function() {
        'use strict'

        $('.buyNowBtn').on('click', function() {
            const modal = $('#invest');
            modal.find('input[name=plan_id]').val($(this).data('plan').id);
            modal.modal('show')
        })
    })
</script>
