@php
    $yourLinks = content('links.content');
@endphp
<!-- Wallet Card -->
<div class="section wallet-card-section pt-1">
    <div class="row align-items-center py-3 px-2" style="position: relative;">
        <div class="col-auto">
            <img width="80px" class="imaged rounded-circle" src="{{ @Auth::user()->image ? getFile('user', @Auth::user()->image) : dummyImg() }}"/>
        </div>
        <div class="col">
            <h4 class="mb-0 text-white">{{ Auth::user()->username }}</h4>
        </div>
        <div class="col-auto text-center">
            {{-- <img width="50px" height="50px" src="{{ asset('asset/images/site-icons/vip-member.png') }}"/> --}}
            <img width="50px" height="50px" src="https://cdn-icons-png.flaticon.com/128/5549/5549231.png"/>
            <h5 class="mb-0 text-light">VIP Privillage</h5>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <h6 class="mb-1 small-font text-start">Main Wallet</h6>
                    <h3 class="mb-1">{{ @$general->currency_sym }} {{ showAmount(@$user->balance) }}</h3>
                </div>
                <div class="col-6 text-end">
                    <h6 class="mb-1 small-font text-end">Trading Wallet</h6>
                    <h3 class="mb-1">{{ @$general->currency_sym }} {{ showAmount(@$user->trading_balance) }}</h3>
                </div>
            </div>

            <div class="row">
                <a class="col-3 text-center customLink" href="{{route('user.usdt.index')}}">
                {{-- <a class="col-3 text-center depositAction" href="javascript:void(0)"> --}}
                    <img class="icon-color-change" width="45px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/9652/9652743.png">
                    <div class="small-font">Deposit</div>
                </a>
                <a class="col-3 text-center customLink" href="{{route('user.withdraw')}}">
                    <img class="icon-color-change" width="45px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/9652/9652652.png">
                    <div class="small-font">Withdraw</div>
                </a>
                <a class="col-3 text-center transactionLogBtn" href="javascript:void(0)">
                    <img class="icon-color-change" width="45px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/12194/12194480.png">
                    <div class="small-font">Records</div>
                </a>
                <a class="col-3 text-center profileSettingBtn" href="javascript:void(0)">
                    <img class="icon-color-change" width="45px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/512/12195/12195137.png">
                    <div class="small-font">Account</div>
                </a>
            </div>

            {{-- <div class="row">
                <a class="col-3 text-center customLink" href="{{route('user.usdt.index')}}">
                    <img width="45px" src="{{asset('asset/images/site-icons/deposit-2.png')}}">
                    <div class="small-font">Deposit</div>
                </a>
                <a class="col-3 text-center customLink" href="{{route('user.withdraw')}}">
                    <img width="45px" src="{{asset('asset/images/site-icons/withdraw-2.png')}}">
                    <div class="small-font">Withdraw</div>
                </a>
                <a class="col-3 text-center transactionLogBtn" href="javascript:void(0)">
                    <img width="45px" src="{{asset('asset/images/site-icons/record.png')}}">
                    <div class="small-font">Records</div>
                </a>
                <a class="col-3 text-center profileSettingBtn" href="javascript:void(0)">
                    <img width="45px" src="{{asset('asset/images/site-icons/account-manage.png')}}">
                    <div class="small-font">Account</div>
                </a>
            </div> --}}

        </div>
    </div>
</div>
<!-- Wallet Card -->


<!-- Stats -->
<div class="section">
    <div class="row mt-2">
        <div class="col-6">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/9590/9590116.png" alt="">
                    </div>
                    <div class="col ps-0 text-end">
                        <div class="title">Total Deposit</div>
                        <div class="value text-danger">{{@$general->currency_sym}} {{ showAmount(@$totalDeposit)}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col pe-0 text-start">
                        <div class="title">Total Withdraw</div>
                        <div class="value text-success">{{@$general->currency_sym}} {{ showAmount(@$withdraw)}}</div>
                    </div>
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/9590/9590117.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6 h-100">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/1353/1353566.png" alt="">
                    </div>
                    <div class="col ps-0 text-end">
                        <div class="title">Today Profit</div>
                        <div class="value">{{@$general->currency_sym}} {{ showAmount($today['earning'])}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 h-100">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col pe-0 text-start">
                        <div class="title">Total Profit</div>
                        <div class="value">{{@$general->currency_sym}} {{ showAmount($total['earning'])}}</div>
                    </div>
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/7418/7418648.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/5662/5662976.png" alt="">
                    </div>
                    <div class="col ps-0 text-end">
                        <div class="title">Refferal Earn</div>
                        <div class="value">{{@$general->currency_sym}} {{ showAmount($commison)}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="row mt-2">
        <div class="col-6">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="{{asset('asset/images/icons-3d/pending-box.png')}}" alt="">
                    </div>
                    <div class="col ps-0 text-end">
                        <div class="title">Pending Invest</div>
                        <div class="value">{{@$general->currency_sym}} {{ showAmount($pendingInvest)}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col pe-0 text-start">
                        <div class="title">Refferal Earn</div>
                        <div class="value">{{@$general->currency_sym}} {{ showAmount($commison)}}</div>
                    </div>
                    <div class="col-auto">
                        <img width="40px" height="40px" style="opacity: 50%" src="https://cdn-icons-png.flaticon.com/128/5662/5662976.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
<!-- * Stats -->

<ul class="listview image-listview inset mt-2">
    <li>
        <a href="javascript:void(0)" class="item profileSettingBtn">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/3649/3649387.png" alt="">
            </div>
            <div class="in">
                <div>Account Info</div>
            </div>
        </a>
    </li>

    <li>
        <a href="{{route('user.kyclist')}}" class="item customLink">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/512/12195/12195137.png" alt="">
            </div>
            <div class="in">
                <div>KYC Status</div>
            </div>
        </a>
    </li>

    <li>
        <a href="{{route('user.team', 1)}}" class="item customLink">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/4807/4807598.png" alt="">
            </div>
            <div class="in">
                <div>My Team</div>
            </div>
        </a>
    </li>
    {{-- <li>
        <a href="javascript:void(0)" class="item investAllBtn">
            <div class="icon-box">
                <img width="25px" src="{{ asset('asset/images/icons-3d/runing.png') }}" alt="">
            </div>
            <div class="in">
                <div>Runing Active Plans</div>
            </div>
        </a>
    </li> --}}
    {{-- <li>
        <a href="javascript:void(0)" class="item refferFriendBtn">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/3437/3437319.png" alt="">
            </div>
            <div class="in">
                <div>Reffer Friends</div>
            </div>
        </a>
    </li> --}}
    {{-- <li>
        <a href="#" class="item">
            <div class="icon-box">
                <img width="25px" src="{{ asset('asset/images/icons-3d/support.png') }}" alt="">
            </div>
            <div class="in">
                <div>Customer Support</div>
            </div>
        </a>
    </li> --}}
    <li>
        <a href="{{route('user.withdraw.setting.bank.card')}}" class="item">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/9528/9528894.png" alt="">
            </div>
            <div class="in">
                <div>Withdraw Setting</div>
            </div>
        </a>
    </li>
    <li>
        <a href="{{@$yourLinks->data->apps}}" class="item">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/3437/3437364.png" alt="">
            </div>
            <div class="in">
                <div>App Download</div>
            </div>
        </a>
    </li>
    {{-- <li>
        <a href="#" class="item">
            <div class="icon-box">
                <img width="25px" src="{{ asset('asset/images/icons-3d/setting.png') }}" alt="">
            </div>
            <div class="in">
                <div>Setting</div>
            </div>
        </a>
    </li> --}}
    <li>
        <a href="{{$yourLinks->data->telegram}}" class="item">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/1391/1391058.png" alt="">
            </div>
            <div class="in">
                <div>Telegram</div>
            </div>
        </a>
    </li>
    <li>
        <a href="{{route('pages', 'about')}}" class="item">
            <div class="icon-box">
                <img width="25px" src="https://cdn-icons-png.flaticon.com/128/2115/2115962.png" alt="">
            </div>
            <div class="in">
                <div>About Us</div>
            </div>
        </a>
    </li>
</ul>



<!-- Stats -->
{{-- <div class="section">
    <div class="row mt-2">
        <div class="col-6">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/2/bank.png')}}" alt="">
                    </div>
                    <div class="col ps-0 text-end">
                        <div class="title">Total Deposit</div>
                        <div class="value text-danger">{{@$general->currency_sym}} {{ showAmount(@$totalDeposit)}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col pe-0 text-start">
                        <div class="title">Total Withdraw</div>
                        <div class="value text-success">{{@$general->currency_sym}} {{ showAmount(@$withdraw)}}</div>
                    </div>
                    <div class="col-auto">
                        <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/2/cashout.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6 h-100">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/2/tholee.png')}}" alt="">
                    </div>
                    <div class="col ps-0 text-end">
                        <div class="title">Total Invest</div>
                        <div class="value">{{@$general->currency_sym}} {{ showAmount(@$totalInvest)}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 h-100">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col pe-0 text-start">
                        <div class="title">Recent Invest</div>
                        <div class="value">{{@$general->currency_sym}} {{ showAmount(@$currentInvest->amount)}}</div>
                    </div>
                    <div class="col-auto">
                        <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/2/transfer.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/2/pending.png')}}" alt="">
                    </div>
                    <div class="col ps-0 text-end">
                        <div class="title">Pending Invest</div>
                        <div class="value">{{@$general->currency_sym}} {{ showAmount($pendingInvest)}}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="stat-box p-1">
                <div class="row align-items-center">
                    <div class="col pe-0 text-start">
                        <div class="title">Refferal Earn</div>
                        <div class="value">{{@$general->currency_sym}} {{ showAmount($commison)}}</div>
                    </div>
                    <div class="col-auto">
                        <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/2/mail-money.png')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<!-- * Stats -->
<!-- Account Options -->
{{-- <div class="section mt-3">
    <div class="section-heading">
        <h2 class="title">Account Options</h2>
    </div>
    <div class="row mt-2">
        <a class="col-3 text-center profileSettingBtn" href="{{route('user.profile')}}">
            <div class="card">
                <div class="card-body p-1">
                    <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/3/men-dollar.png')}}" alt="">
                </div>
            </div>
            <p class="mb-0" style="font-size: 12px;">Profile</p>
        </a>
        <a class="col-3 text-center addressSettingBtn" href="{{route('user.address')}}">
            <div class="card">
                <div class="card-body p-1">
                    <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/3/dollar-location.png')}}" alt="">
                </div>
            </div>
            <p class="mb-0" style="font-size: 12px;">Address</p>
        </a>
        <a class="col-3 text-center passwordChangeBtn" href="{{route('user.change.password')}}">
            <div class="card">
                <div class="card-body p-1">
                    <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/3/lock.png')}}" alt="">
                </div>
            </div>
            <p class="mb-0" style="font-size: 12px;">Password</p>
        </a>
    </div>
</div> --}}

<!-- Logs -->
{{-- <div class="section mt-3">
    <div class="section-heading">
        <h2 class="title">All Logs</h2>
    </div>
    <div class="row mt-2">
        <a class="col-3 text-center depositLogBtn" href="{{ route('user.deposit.log') }}">
            <div class="card">
                <div class="card-body p-1">
                    <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/3/logs.png')}}" alt="">
                </div>
            </div>
            <p class="mb-0" style="font-size: 12px;">Deposit</p>
        </a>
        <a class="col-3 text-center withdrawLogBtn" href="{{ route('user.withdraw.all') }}">
            <div class="card">
                <div class="card-body p-1">
                    <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/3/logs-2.png')}}" alt="">
                </div>
            </div>
            <p class="mb-0" style="font-size: 12px;">Withdraw</p>
        </a>
        <a class="col-3 text-center investLogBtn" href="{{ route('user.invest.log') }}">
            <div class="card">
                <div class="card-body p-1">
                    <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/3/logs-5.png')}}" alt="">
                </div>
            </div>
            <p class="mb-0" style="font-size: 12px;">Invest</p>
        </a>
        <a class="col-3 text-center interestLogBtn" href="{{ route('user.interest.log') }}">
            <div class="card">
                <div class="card-body p-1">
                    <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/3/logs-4.png')}}" alt="">
                </div>
            </div>
            <p class="mb-0" style="font-size: 12px;">Interest</p>
        </a>
        <a class="col-3 text-center transactionLogBtn" href="{{ route('user.transaction.log') }}">
            <div class="card">
                <div class="card-body p-1">
                    <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/3/logs-6.png')}}" alt="">
                </div>
            </div>
            <p class="mb-0" style="font-size: 12px;">Transaction</p>
        </a>
        <a class="col-3 text-center commisionLogBtn" href="{{ route('user.commision') }}">
            <div class="card">
                <div class="card-body p-1">
                    <img width="50px" height="50px" src="{{asset('asset/images/2d-icon/3/logs-7.png')}}" alt="">
                </div>
            </div>
            <p class="mb-0" style="font-size: 12px;">Referral</p>
        </a>
    </div>
</div> --}}

<div class="section my-3">
    <a href="javascript:void(0)" class="btn btn-gr-red gr-bg-red w-100 shadow" data-bs-toggle="modal" data-bs-target="#signoutAlert">Sign Out</a>
</div>

<!-- Dialog Basic -->
<div class="modal fade dialogbox" id="signoutAlert" data-bs-backdrop="static" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Are you sure?</h5>
            </div>
            <div class="modal-footer">
                <div class="btn-inline">
                    <a href="#" class="btn btn-text-secondary" data-bs-dismiss="modal">CANCEL</a>
                    <a href="{{route('user.logout')}}" class="btn btn-text-primary">YES</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Dialog Basic -->


