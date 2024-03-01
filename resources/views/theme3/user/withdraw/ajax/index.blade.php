
    <div class="row gy-4">
        <div class="col-12 withdraw-ins d-none">
            <div class="site-card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('Withdraw Instruction') }}</h5>
                </div>
                <div class="card-body">
                    <p class="instruction"></p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="site-card">
                <form id="withdrawConfirmForm" action="{{route('user.withdraw')}}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">{{ __('Withdraw Method') }}</label>
                            <select name="method" id="" class="select">
                                <option value="" selected>{{ __('Select Method') }}</option>
                                @foreach ($withdraws as $withdraw)
                                    <option value="{{ $withdraw->id }}" data-url="{{ route('user.withdraw.fetch', $withdraw->id) }}">
                                        {{ $withdraw->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="row appendData"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
