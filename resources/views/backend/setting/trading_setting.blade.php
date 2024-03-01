@extends('backend.layout.master')

@section('content')
    <link rel="stylesheet" href="{{ asset('asset/admin/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.css') }}" />
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __($pageTitle) }}</h1>
            </div>
            <div class="row">
                <div class="col-md-12 stretch-card">
                    <div class="card">
                        <div class="card-body">

                            <form action="" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label for="trading_bonus">{{ __('Trading Bonus') }}</label>
                                        <div class="input-group">
                                            <input type="text" name="trading_bonus" placeholder="@lang('Trading Bonus')"
                                                class="form-control form_control" value="{{ @$general->trading_bonus }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text gr-bg-1 text-white">%</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="trading_min_amount">{{ __('Minimum Trading Amount') }}</label>
                                        <div class="input-group">
                                            <input type="text" name="trading_min_amount" placeholder="@lang('Minimum Trading Amount')" class="form-control form_control" value="{{ @$general->trading_min_amount }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text gr-bg-1 text-white">{{ @$general->site_currency }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="profit_type">{{ __('Profit Type') }}</label>
                                        <select class="form-select form-control form_control text-white {{ @$general->profit_type == 'minus' ? 'bg-danger' : 'bg-success' }}" id="profit_type" name="profit_type">
                                            <option @if(@$general->profit_type == 'plus') selected @endif value="plus">+ Plus</option>
                                            <option @if(@$general->profit_type == 'minus') selected @endif value="minus">- Minus</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="invest_end_time">{{ __('Trade Open End Time') }}</label>
                                        <div class="input-group">
                                            <input type="time" name="invest_end_time" placeholder="@lang('Trade Open End Time')" class="form-control form_control" value="{{ @$general->invest_end_time }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label for="coin_name">{{ __('Coin Name') }}</label>
                                        <div class="input-group">
                                            <input type="text" name="coin_name" placeholder="@lang('Coin Name')" class="form-control form_control" value="{{ @$general->coin_name }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3 mb-3">
                                        <label class="col-form-label">{{ __('Coin Image') }}</label>
                                        <div id="image-preview-login" class="image-preview" style="background-image:url({{ getFile('coin_image', @$general->coin_image) }});">
                                            <label for="image-upload-login" id="image-label-login">{{ __('Choose File') }}</label>
                                            <input type="file" name="coin_image" id="image-upload-login" />
                                        </div>
                                    </div>

                                    <div class="form-group col-md-12 mt-4">
                                        <button type="submit" class="btn btn-primary w-100">{{ __('Update Trading Setting') }}</button>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection




@push('style')
    <style>
        .sp-replacer {
            padding: 0;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: 5px 0 0 5px;
            border-right: none;
        }

        select.form-control:not([size]):not([multiple]) {
            height: calc(2.25rem + 9px);
        }

        .sp-preview {
            width: 100px;
            height: 46px;
            border: 0;
        }

        .sp-preview-inner {
            width: 110px;
        }

        .sp-dd {
            display: none;
        }

        .select2-container .select2-selection--single {
            height: 44px;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 43px;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 43px;
        }
    </style>
@endpush

@push('script')
    <script src="{{ asset('asset/admin/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
    <script>
        $(function() {

            'use strict'

            $('#cp1').colorpicker();
            $('#cp2').colorpicker();

            $.uploadPreview({
                input_field: "#image-upload",
                preview_box: "#image-preview",
                label_field: "#image-label",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-icon",
                preview_box: "#image-preview-icon",
                label_field: "#image-label-icon",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-login",
                preview_box: "#image-preview-login",
                label_field: "#image-label-login",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-login_image",
                preview_box: "#image-preview-login_image",
                label_field: "#image-label-login_image",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-breadcrumbs",
                preview_box: "#image-preview-breadcrumbs",
                label_field: "#image-label-breadcrumbs",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-main",
                preview_box: "#image-preview-main",
                label_field: "#image-label-main",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });

            $.uploadPreview({
                input_field: "#image-upload-whitelogo",
                preview_box: "#image-preview-whitelogo",
                label_field: "#image-label-whitelogo",
                label_default: "Choose File",
                label_selected: "Update Image",
                no_label: false,
                success_callback: null
            });
        })
    </script>
@endpush
