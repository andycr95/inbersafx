<div class="d-none" id="currentPath">Interest_Log</div>

<!-- Logs Navigation -->
@include('theme3.includes.user.logs_nav')

<!-- Deposit History -->
<div class="section my-3">
    @foreach ($interestLogs as $k => $log)
        <div class="card mb-2">
            <div class="card-body">
                <h3 class="pb-1 mb-2 text-center border-bottom">{{ $log->payment->plan->plan_name }}</h3>
                <div class="row">
                    <div class="col">Interest:</div>
                    <div class="col-auto">{{ showAmount($log->interest_amount) }} {{ @$general->site_currency }}</div>
                </div>
                <div class="row">
                    <div class="col">Invest Amount:</div>
                    <div class="col-auto">{{ showAmount($log->payment->amount, 2) }} {{ @$general->site_currency }}</div>
                </div>
                <div class="row">
                    <div class="col">Payment Date:</div>
                    <div class="col-auto">{{ $log->created_at }}</div>
                </div>
                <div class="row">
                    <div class="col">Next Payment Date:</div>
                    <div class="col-auto">{{ isset($log->payment->next_payment_date) ? $log->payment->next_payment_date : 'Plan Expired' }}</div>
                </div>
            </div>
        </div>
    @endforeach
</div>
<!-- * Deposit History -->
