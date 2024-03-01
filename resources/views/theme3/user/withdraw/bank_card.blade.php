@extends(template().'layout.master2')
@section('content2')

<!-- page content start -->
<main class="flex-shrink-0 main">

    <div class="main-container">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 pr-1">
                            <a class="btn btn-sm btn-warning w-100">Bank Card</a>
                        </div>
                        <div class="col-6 pl-1">
                            <a href="{{ route('user.withdraw.setting.usdt') }}" class="btn btn-sm btn-light w-100">USDT</a>
                        </div>
                    </div>
                </div>
            </div>

            @php
                $bdtWalletName = 'N/A';
                $bdtWallet = App\Models\WithdrawGateway::where('id', $user->bdt_wallet_id)->first();
                if($bdtWallet){
                    $bdtWalletName = $bdtWallet->name;
                }
            @endphp

            {{-- @if ($user->bdt_wallet_id && $user->bdt_wallet_number)
                <div class="card mt-3">
                    <div class="card-body">
                         <h6 class="mb-0 text-left text-secondary fw-bold">
                            Name: <b class="text-info">{{ $bdtWalletName }}</b>
                         </h6>
                         <h6 class="mb-0 text-left text-secondary fw-bold">
                            Number: <b class="text-info">{{ $user->bdt_wallet_number }}</b>
                         </h6>
                    </div>
                </div>
            @else --}}
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <select class="form-control" id="name" name="name" @if(@$user->bdt_wallet_number) readonly disabled @endif>
                                    <option value="{{null}}">Select Method</option>
                                    @foreach ($methods as $method)
                                        @if (strtolower($method->singel_currency) != 'usdt')
                                            <option @if($method->id == @$user->bdt_wallet_id) selected @endif data-id="{{$method->name}}" value="{{$method->id}}">{{$method->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            @if (@$user->bdt_wallet_number)
                                <input type="hidden" name="name" value="{{ @$user->bdt_wallet_id }}">
                            @endif

                            <div class="form-group">
                                <label for="number">Bank Number</label>
                                <input type="text" class="form-control" id="number" name="number" value="{{ @$user->bdt_wallet_number }}" placeholder="enter bank number" @if(@$user->bdt_wallet_number) readonly @endif>
                            </div>
                            @if (!$user->withdraw_pass)
                                <div class="form-group">
                                    <label for="number">Withdraw Password</label>
                                    <input type="text" class="form-control" id="withdraw_pass" name="withdraw_pass" value="{{ @$user->withdraw_pass }}" placeholder="enter withdraw password" required @if(@$user->withdraw_pass) readonly @endif>
                                </div>
                            @endif
                            <button class="btn btn-primary w-100 mt-2" type="submit">Confirm</button>
                        </form>
                    </div>
                </div>
            {{-- @endif --}}

        </div>
    </div>
</main>

@endsection

@push('script')

@endpush
