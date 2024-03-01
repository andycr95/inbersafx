<!DOCTYPE html>
<html lang="en">
    <!-- Include Head -->
    @include('theme3.includes.frontend.head')
<body>
    @php
        $get_trx = @$_GET['trx'];
        $get_amount = @$_GET['amount'];
        $get_final_amo = @$_GET['final_amo'];
        $get_currency = @$_GET['currency'];
    @endphp
    <!-- App Capsule -->
    <div id="appCapsule">
        <div class="container">
            <h2 class="mb-4 text-center fw-bold">
                অর্ডার পর্যালোচনা করা হচ্ছে, এবং পর্যালোচনা 30 মিনিটের মধ্যে সম্পন্ন হবে বলে আশা করা হচ্ছে
            </h2>
            <div class="mt-3 mb-3 px-3">
                <h6 class="small-font-lg text-start fw-bold">
                    অর্ডার নাম্বার: {{ $get_trx }}
                </h6>
                <h6 class="small-font-lg text-start fw-bold">
                    অর্ডারের পরিমাণ: {{ $get_amount }} {{ $general->cur_text }}
                </h6>
                <h6 class="small-font-lg text-start fw-bold">
                    প্রকৃত অর্থপ্রদানের পরিমাণ: {{ $get_final_amo }} {{ $get_currency }}
                </h6>
            </div>
            <a href="{{route('home')}}" class="btn btn-lg btn-dark w-100 fw-bold">হোম পেইজে ফিরে যান</a>
        </div>
    </div>
    <!-- Include Script -->
    @include('theme3.includes.frontend.script')
</body>
