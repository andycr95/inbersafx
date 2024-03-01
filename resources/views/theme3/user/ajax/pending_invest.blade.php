<div class="container-fluid">
    @forelse ($payments as $plan)
        <div class="card mt-2">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img width="60px" src="{{ asset('asset/images/icons-3d/trophy.png') }}" alt="">
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col-12">
                                <h3 class="mb-0">{{ @$plan->plan->plan_name }}</h3>
                            </div>
                            <div class="col-12">
                                <span class="small fw-bold">Get Paid: </span>
                                <span class="small">
                                    @if ($plan->plan->return_for == 1)
                                        {{ isset($plan->pay_count) ? $plan->pay_count : $plan->plan->how_many_time }}
                                        {{ __(' Out of ') }}
                                        {{ $plan->plan->how_many_time }} {{ __('Times') }}
                                    @else
                                        {{ __('Lifetime') }}
                                    @endif
                                </span>
                            </div>
                            <div class="col-12">
                                <span class="small fw-bold">Interest: </span>
                                <span class="small">{{ @$general->currency_sym }} {{ showAmount($plan->interest_amount) }}</span>
                            </div>
                            <div class="col-12">
                                <span class="small fw-bold">Invest Amount: </span>
                                <span class="small">{{ @$general->currency_sym }} {{ showAmount($plan->amount) }}</span>
                            </div>
                            <div class="col-12">
                                <span class="small fw-bold">Invest Date: </span>
                                <span class="small">{{ $plan->created_at }}</span>
                            </div>
                            <div class="col-12">
                                <span class="small fw-bold">Next Payment: </span>
                                <span class="small">
                                    @if ($plan->payment_status == 1)
                                        {{ @$plan->next_payment_date }}
                                    @else
                                        {{'N/A'}}
                                    @endif
                                </span>
                            </div>
                            <div class="col-12">
                                <span class="small fw-bold">Payment Status: </span>
                                <span class="small">
                                    @if ($plan->payment_status == 1)
                                        <span class="badge badge-success">{{ __('Success') }}</span>
                                    @elseif($plan->payment_status == 2)
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                    @elseif($plan->payment_status == 3)
                                        <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <h4 class="my-4">No Data Found!</h4>
    @endforelse
</div>




    {{-- <div class="card my-2">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table site-table">
                    <thead>
                        <tr>
                            <th scope="col">{{ __('Plan Name') }}</th>
                            <th scope="col">{{ __('Get Paid') }}</th>
                            <th scope="col">{{ __('Interest') }}</th>
                            <th scope="col">{{ __('Invest Amount') }}</th>
                            <th scope="col">{{ __('Invest Date') }}</th>
                            <th scope="col">{{ __('Next Payment Date') }}</th>
                            <th scope="col">{{ __('Payment Status') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($payments as $plan)
                            <tr>
                                <td data-caption="Plan Name">{{ @$plan->plan->plan_name }}</td>
                                <td data-caption="Get Paid">
                                    @if ($plan->plan->return_for == 1)
                                        {{ isset($plan->pay_count) ? $plan->pay_count : $plan->plan->how_many_time }}
                                        {{ __(' Out of ') }}
                                        {{ $plan->plan->how_many_time }} {{ __('Times') }}
                                    @else
                                        {{ __('Lifetime') }}
                                    @endif
                                </td>
                                <td data-caption="Interest">{{ number_format($plan->interest_amount, 2) }}
                                    {{ @$general->site_currency }}</td>
                                <td data-caption="Invest Amount">{{ number_format($plan->amount, 2) }} {{ @$general->site_currency }}</td>
                                <td data-caption="Invest Date">{{ $plan->created_at }}</td>
                                <td data-caption="Next Payment Date">
                                    @if ($plan->payment_status == 1)
                                        {{ @$plan->next_payment_date }}
                                    @else
                                        {{'N/A'}}
                                    @endif
                                </td>
                                <td data-caption="Payment Status">

                                    @if ($plan->payment_status == 1)
                                        <span class="badge badge-success">{{ __('Success') }}</span>
                                    @elseif($plan->payment_status == 2)
                                        <span class="badge badge-warning">{{ __('Pending') }}</span>
                                    @elseif($plan->payment_status == 3)
                                        <span class="badge badge-danger">{{ __('Rejected') }}</span>
                                    @endif

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td data-caption="Not Found" class="text-center" colspan="100%">{{ __('No Data Found') }}</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}
