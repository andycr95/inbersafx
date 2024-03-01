@php
$content = content('affiliate.content');

$invest = \App\Models\Refferal::where('type', 'invest')->first();

@endphp
<div class="container">
    <div class="card mt-2">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-xl-4 text-lg-start text-center">
                    <h3 class="mb-2">Reffer System</h3>
                </div>
                <div class="col-xl-8 mt-xl-0 mt-4">
                    <div class="referral-wrapper">
                        @for ($i = 0; $i < count($invest->level ?? []); $i++)
                        <div class="referral-item">
                            <img src="{{ asset('asset/images/icons-3d/shield-ref-2.png') }}" alt="image">
                            <div class="referral-content">
                            <div class="referral-amount">{{ $invest->commision[$i] . '%' }}</div>
                            <span class="referral-caption">{{ __('Lev') }} {{ $i + 1 }}</span>
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
