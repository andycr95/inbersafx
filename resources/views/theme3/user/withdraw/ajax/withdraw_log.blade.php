<div class="d-none" id="currentPath">Withdraw_Log</div>

<!-- Logs Navigation -->
@include('theme3.includes.user.logs_nav')

<!-- Withdraw History -->
<div class="section my-3">
    <div class="transactions">
        @foreach ($withdrawlogs as $k => $data)
        <!-- item -->
        <a href="javascript:void(0)" class="item pt-1 pb-1 px-3 details" data-user_data="{{ json_encode($data->user_withdraw_prof) }}" data-withdraw="{{ $data }}">
            <div class="detail">
                <img src="https://cdn-icons-png.flaticon.com/128/2921/2921222.png" class="image-block imaged w48" alt="">

                <div>
                    <strong>Withdraw via {{ __(@$data->withdrawMethod->name)  }}</strong>
                    <p class="small text-secondary">
                        Trx: <b class="text-info">{{ $data->transaction_id }}</b>
                        <br>
                        {{showDateTime($data->created_at, 'd-m-Y')}} | {{ diffForHumans($data->created_at) }}
                    </p>
                </div>
            </div>
            <div align="right" class="col-auto">
                <h5 class="text-success mb-1">
                    {{__($general->currency_sym)}} {{ showAmount($data->withdraw_amount) }}
                </h5>
                @if ($data->status == 1)
                    <span class="badge badge-success">{{ __('Success') }}</span>
                @elseif($data->status == 2)
                    <span class="badge badge-danger">{{ __('Rejected') }}</span>
                @else
                    <span class="badge badge-warning">{{ __('Pending') }}</span>
                @endif
            </div>
        </a>
        <!-- * item -->
        @endforeach
    </div>
</div>
<!-- * Withdraw History -->

<script>
    $(document).on('click', '.details', function() {

        let html = `

            <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                       {{ __('Withdraw Email') }}
                        <span>${$(this).data('user_data').email}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Withdraw Account Information') }}
                        <span>${$(this).data('user_data').account_information}</span>
                    </li>


                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Note For Withdraw') }}
                        <span>${$(this).data('user_data').note}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ __('Withdraw Transaction') }}
                        <span>${$(this).data('withdraw').transaction_id}</span>
                    </li>
                </ul>
        `;

        $('#details').find('.withdraw-details').html(html);

        $('#details').modal('show');
    })
</script>

<!-- Modal -->
<div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('Withdraw Details') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="text-white">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="withdraw-details">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-danger"
                    data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>

