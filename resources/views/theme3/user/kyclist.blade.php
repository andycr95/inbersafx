@extends(template().'layout.master2')
@section('content2')

<div class="container">
    <div class="card mt-2">
        <div class="card-body text-center">
            <h3 class="pb-2 mb-1 border-bottom">KYC Status</h3>
        </div>
    </div>
</div>

<div class="section my-3">
    <div class="transactions">
        @foreach ($kyc as $k => $data)
        <!-- item -->
        <a href="#" class="item pt-1 pb-1 px-3">
            <div class="detail">
                <img src="https://cdn-icons-png.flaticon.com/512/12195/12195137.png" class="image-block imaged w48" alt="">

                <div>
                    <strong>{{ $user->fname }}</strong>
                    <p>Country: {{$data->country}}</p>
                    <p>Card Type: {{$data->type}}</p>
                    <p class="small text-secondary">
                        {{showDateTime($data->created_at, 'd-m-Y')}} | {{ diffForHumans($data->created_at) }}
                    </p>
                </div>
            </div>
            <div align="right" class="col-auto">
                <h5 class="text-danger mb-1">
                    Status
                </h5>
                @if($data->status == 1)
                    <span class="badge badge-success style--light">@lang('Verify')</span>
                @elseif($data->status == 0)
                    <span class="badge badge-warning style--light">@lang('Pending')</span>
                @elseif($data->status == 2)
                    <span class="badge badge-danger style--light">@lang('Rejected')</span>
                @endif
            </div>
        </a>
        <!-- * item -->
        @endforeach
    </div>
</div>
@endsection

