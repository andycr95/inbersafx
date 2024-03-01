<div class="container">
    <div class="card mt-2 mb-2">
        <div class="card-body">
            <h4 class="mb-0 text-center">{{@$pageTitle}}</h4>
            <div class="input-group">
                <input type="text" name="key" value="{{ route('user.register', [Auth::user()->username]) }}" class="form-control form-control-sm" id="referralURL" readonly>
                <a href="javascript:void(0)" class="input-group-text btn btn-gr-red cursor-pointer copy_ref px-3 after-append" id="copyBoard">
                    <i class="fa fa-copy"></i>
                </a>
            </div>
        </div>
    </div>
    @php
        $reference = auth()->user()->refferals;
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">{{ __('Reference Tree') }}</h5>
                </div>
                <div class="card-body">
                    @if ($reference->count() > 0)
                    <ul class="sp-referral">
                        <li class="single-child root-child">
                            <p>
                                <img src="{{ auth()->user()->image ? getFile('user', auth()->user()->image) : 'https://cdn-icons-png.flaticon.com/128/4140/4140048.png' }}">
                                <span class="mb-0">{{ auth()->user()->username .' - '. checkActiveOrNot(auth()->user())}}</span>
                            </p>
                            <ul class="sub-child-list step-2">
                                @foreach ($reference as $user)
                                    <li class="single-child">
                                        <p>
                                            <img src="{{ $user->image ? getFile('user', $user->image) : 'https://cdn-icons-png.flaticon.com/128/4140/4140048.png' }}">
                                            <span class="mb-0">{{ $user->username.' - '. checkActiveOrNot($user) }}</span>
                                        </p>

                                        <ul class="sub-child-list step-3">
                                            @foreach ($user->refferals as $ref)
                                                <li class="single-child">
                                                    <p>
                                                        <img src="{{ $ref->image ? getFile('user', $ref->image) : 'https://cdn-icons-png.flaticon.com/128/4140/4140048.png' }}">
                                                        <span class="mb-0">{{ $ref->username.' - '. checkActiveOrNot($ref) }}</span>
                                                    </p>
                                                    <ul class="sub-child-list step-4">
                                                        @foreach ($ref->refferals as $ref2)
                                                            <li class="single-child">
                                                                <p>
                                                                    <img src="{{ $ref2->image ? getFile('user', $ref2->image) : 'https://cdn-icons-png.flaticon.com/128/4140/4140048.png' }}">
                                                                    <span class="mb-0">{{ $ref2->username.' - '. checkActiveOrNot($ref2) }}</span>
                                                                </p>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                    </ul>
                    @else
                        <div class="col-md-12 text-center mt-5">
                            <i class="far fa-sad-tear display-1"></i>
                            <p class="mt-2">
                                {{ __('No Reference User Found') }}
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
<script>
    $('.copy_ref').on('click', function() {
        var copyText = document.getElementById("referralURL");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        document.execCommand("copy");
        notifyMsg("Copied: " + copyText.value,'success')
    });
</script>
