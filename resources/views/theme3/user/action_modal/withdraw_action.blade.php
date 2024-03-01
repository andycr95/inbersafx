<!-- Withdraw Action Sheet -->
<div class="modal fade action-sheet" id="withdrawAction" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Withdraw Money</h5>
            </div>
            <div class="modal-body">
                <div class="action-sheet-content">
                    <div id="withdrawActionBody"> </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * Withdraw Action Sheet -->

@push('script')
<script>
    //deposit-page-view-on deposit action
    $(document).on('click', '.withdrawAction', function (e) {
        e.preventDefault();
        $('#preLoadCustom').removeClass('d-none'); // loader-on
        let modal = $('#withdrawAction')
        $.ajax({
            type: "GET",
            url: "{{route('user.ajax.withdraw')}}",
            success: function (res) {
                $('#withdrawActionBody').html(res);
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

    //withdraw-confirm-submit
    $(document).on('submit', '#withdrawConfirmForm', function (e) {
        e.preventDefault();
        let formData = new FormData($(this)[0]);
        $.ajax({
            type: "POST",
            url: "{{route('user.ajax.withdraw.complete')}}",
            data: formData,
            dataType: "json",
            contentType: false,
            processData: false,
            success: function (res) {
                console.log(res);
                notifyMsg(res.msg, res.cls);
                if (res.cls == 'success') {
                    $('#withdrawAction').modal('hide')
                }
            }
        });

    });
</script>

<script>
    $(function() {
        'use strict'

        $(document).on('change', 'select[name=method]', function() {
            if ($(this).val() == '') {
                $('.withdraw-ins').addClass('d-none');
                $('.appendData').addClass('d-none');
                $('.instruction').text('');
                return;
            }
            $('.withdraw-ins').removeClass('d-none');
            $('.appendData').removeClass('d-none');
            getData($('select[name=method] option:selected').data('url'))

            // let charge_symbol = '{{@$general->site_currency}}';
            // if ($('.withdraw_charge_type').text().localeCompare("percent") == 1) {
            //     charge_symbol = '{{@$general->site_currency}}';
            // }
            // if ($('.withdraw_charge_type').text().localeCompare("fixed") == 1) {
            //     charge_symbol = '%';
            // }
        })

        $(document).on('keyup', '.amount', function() {
            let main_amount = $(this).val();

            const withdraw_charge_type = $('.withdraw_charge_type').text();

            if ($(this).val() == '') {
                $('.final_amo').val(0);
                $('.you_got').html(0);
                return
            }

            const rate = $('.cur_rate').html();

            $('.you_got').html(main_amount * rate);



            const charge = $('.charge').val();

            console.log('rate '+ rate);

            if (withdraw_charge_type.localeCompare("percent") == 1) {
                let percentAmount = (Number.parseFloat($(this).val())) + Number.parseFloat((charge * $(this).val()) / 100);

                $('.final_amo').val((percentAmount).toFixed(2));
                return
            }
            if (withdraw_charge_type.localeCompare("fixed") == 1) {

                let totalAmount = (Number.parseFloat($(this).val())) + Number.parseFloat(charge);

                $('.final_amo').val((totalAmount).toFixed(2));
            }
        })

        function getData(url) {
            $.ajax({
                url: url,
                method: "GET",
                success: function(response) {

                    let informations = JSON.parse(response.informations);
                    let infos = '';
                    $.each(informations, function (index, value) {
                        infos += `
                            <div class="col-md-12 mb-3">
                                <label for="">${value} <span class="text-danger">*</span></label>
                                <input type="text" name="info[${index}]" class="form-control form-control-sm rounded-pill" required>
                            </div>
                        `;
                    });

                    // console.log(infos);

                    $('.instruction').html(response.withdraw_instruction)
                    let html = `

                            <div class="col-md-12 mb-3 mt-3">
                                <label for="">{{ __('Withdraw Amount') }} <span class="text-danger">*</span></label>
                                <input type="number" name="amount" class="form-control form-control-sm rounded-pill amount" required>
                                <p class="text-small color-change mb-0 mt-1"><span>{{ __('Min Amount & ') }}  ${Number.parseFloat(response.min_amount).toFixed(2)}</span> <span>{{ __('Max Amount') }} ${Number.parseFloat(response.max_amount).toFixed(2)}</span></p>
                            </div>

                            <div class="p-1">
                                <div class="row py-1 border-bottom">
                                    <div class="col">
                                        Charge:
                                    </div>
                                    <div class="col-auto">
                                        <b>${Number.parseFloat(response.charge).toFixed(2)}</b> {{@$general->site_currency}}
                                    </div>
                                </div>
                                <div class="row py-1 border-bottom">
                                    <div class="col">
                                        Conversion Rate:
                                    </div>
                                    <div class="col-auto">
                                        1 {{@$general->site_currency}} = <b class="cur_rate">${Number.parseFloat(response.singel_rate).toFixed(2)}</b> ${response.singel_currency}
                                    </div>
                                </div>
                                <div class="row py-1">
                                    <div class="col">
                                        You Got:
                                    </div>
                                    <div class="col-auto">
                                        <b class="you_got">0.00</b> ${response.singel_currency}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3" hidden>
                                <label>{{ __('Withdraw Charge') }}</label>
                                <div class="input-group">
                                    <input type="text" class="form-control form-control-sm rounded-pill charge" value="${Number.parseFloat(response.charge).toFixed(2)}" required disabled>
                                    <div class="input-group-text">
                                        <span class="withdraw_charge_type">${response.charge_type}<span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label for="">{{ __('Cut From Your Wallet') }} <span class="text-danger">*</span></label>
                                <input type="text" name="final_amo" class="form-control form-control-sm rounded-pill final_amo" required readonly>
                            </div>

                            ${infos}

                            <div class="col-md-12">
                               <button class="btn btn-pink-light w-100 rounded-pill" type="submit">{{ __('Withdraw Now') }}</button>
                            </div>
               `;

                    $('.appendData').html(html);
                }
            })
        }
    })
</script>

@endpush
