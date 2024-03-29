@extends(template().'layout.master')

@section('content')

    <section class="page-banner">
        <div class="container">
            <div class="row justify-content-center">
            <div class="col-lg-6 text-center">
                <h2 class="title text-white">{{ __($pageTitle) }}</h2>
                <ul class="page-breadcrumb justify-content-center mt-2">
                    <li><a href="index.html">{{ __('Home') }}</a></li>
                    <li>{{ __($pageTitle) }}</li>
                </ul>
            </div>
            </div>
        </div>
    </section>

    <section class="plan-section pt-100 pb-100 section-bg" style="background-image: url('{{ asset('asset/theme3/images/bg/plan.jpg') }}')">
        <div class="container mb-5">
            <div class="row">
                <div class="col-auto">
                    <form id="curFormjq" action="{{ route('storeCur.session') }}" method="post">
                        @csrf
                        <select name="currency" class="form-select" id="cngCurrency">
                            <option @if($general->site_currency==session()->get('currency_name')) selected @endif value="{{ $general->site_currency }}">{{ $general->site_currency }}</option>
                            @foreach ($currencys as $item)
                            <option @if($item->currency==session()->get('currency_name')) selected @endif value="{{ $item->currency }}">{{ $item->currency }}</option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
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
                                                {{ number_format($plan->minimum_amount*(session()->has('currency_rate')?session()->get('currency_rate'):1), 2) }} 
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
                                                {{ number_format($plan->maximum_amount*(session()->has('currency_rate')?session()->get('currency_rate'):1), 2) }} 
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
                                                {{ number_format($plan->amount*(session()->has('currency_rate')?session()->get('currency_rate'):1), 2) }} 
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
        </div>
    </section>

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
@endsection

@push('script')
    <script>
        $(document).on("change", '#cngCurrency', function () {
            $("#curFormjq").submit();
        });

        $(function() {
            'use strict'

            $('.balance').on('click', function() {
                const modal = $('#invest');
                modal.find('input[name=plan_id]').val($(this).data('plan').id);
                modal.modal('show')
            })
        })
    </script>
@endpush