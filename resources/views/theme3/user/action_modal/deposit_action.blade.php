<!-- Deposit Action Sheet -->
<div class="modal fade action-sheet" id="depositAction" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Balance</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div id="depositActionBody"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Deposit Action Sheet -->

@push('script')
    <script>
        //deposit-page-view-on deposit action
        $(document).on('click', '.depositAction', function (e) {
            e.preventDefault();
            $('#preLoadCustom').removeClass('d-none'); // loader-on
            let modal = $('#depositAction')
            $.ajax({
                type: "GET",
                url: "{{route('user.ajax.deposit')}}",
                success: function (res) {
                    $('#depositActionBody').html(res);
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    modal.modal('show')
                },
                error: function (err) {
                    $('#preLoadCustom').addClass('d-none'); // loader-off
                    let error = err.responseJSON;
                    console.log(error);
                    if (error.message === "Unauthenticated.") {
                        notifyMsg("You need to Login At first!", 'error');
                        setTimeout(() => {
                            GoTo("{{route('user.login')}}")
                        }, 1000);
                    }else {
                        notifyMsg('Something went wrong!', 'error');
                    }
                }
            });
        });
    </script>

    <script>
        $(document).on('click', '.gatewayItem', function (e) {
            e.preventDefault();
            $('.gatewayItem').removeClass('gatewayActive');
            $(this).addClass('gatewayActive');
            let id = $(this).data('id');
            let charge = $(this).data('charge');
            let rate = $(this).data('rate');
            let min_limit = $(this).data('min_limit');
            let max_limit = $(this).data('max_limit');
            let curr = $(this).data('curr');
            let site_curr = "{{$general->site_currency}}";

            $('#rateView').html(Number(rate).toFixed(2)+' '+curr);
            $('#chargeView').html(Number(charge).toFixed(2)+' '+site_curr);
            $('#minView').html(Number(min_limit).toFixed(2)+' '+site_curr);
            $('#maxView').html(Number(max_limit).toFixed(2)+' '+site_curr);

            $('#methodID').val(id);

            $('#detailPreview').removeClass('d-none');

            console.log(id+' '+charge+' '+rate+' '+curr);
        });

        //final page view on deposit action
        $(document).on('submit', '#paynowForm', function (e) {
            e.preventDefault();
            $('#amountSubmitBtn').html(BtnSPIN);
            let formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('user.ajax.paynow')}}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (res) {
                    console.log(res);
                    if (res.cls == 'error') {
                        notifyMsg(res.msg, res.cls);
                        $('#amountSubmitBtn').html('Next Step');
                    }
                    $('#depositActionBody').html(res.data);
                }
            });

        });

        //menual-confirm-submit
        $(document).on('submit', '#menualConfirmForm', function (e) {
            e.preventDefault();
            $('#menualConfirmFormSubmitBtn').html(BtnSPIN);
            let formData = new FormData($(this)[0]);
            $.ajax({
                type: "POST",
                url: "{{route('user.ajax.gateway.confirm')}}",
                data: formData,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function (res) {
                    console.log(res);
                    notifyMsg(res.msg, res.cls);
                    $('#depositAction').modal('hide')
                },
                error: function (err) {
                    let errors = err.responseJSON.errors;
                    let notice = '';

                    $.each(errors, function (index, val) {
                        notice += val+'<br>'
                    });
                    setTimeout(() => {
                        notifyMsg(notice, 'error');
                        $('#menualConfirmFormSubmitBtn').html('Deposit Now');
                    }, 1000);
                }
            });

        });
    </script>
@endpush
