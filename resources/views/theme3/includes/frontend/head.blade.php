<meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#1E2329">
    <meta name="description" content="Buy what you need from CodeShack.net - AI Crypto Trading">
    <meta name="keywords" content="Buy what you need from CodeShack.net, wallet, banking, trading, mobile trade, Crypto" />

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" type="image/png" href="{{ getFile('icon', @$general->favicon) }}">
    <title>
        @if (@$general->sitename)
            {{ __(@$general->sitename) . ' -' }}
        @endif
        {{ __(@$pageTitle) }}
    </title>

    <link href="{{ asset('asset/theme3/frontend/img/apple-touch-icon.png') }}" rel="apple-touch-icon">
    <link href="{{ asset('asset/theme3/frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme3/frontend/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme3/frontend/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme3/frontend/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme3/frontend/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('asset/theme3/frontend/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('asset/theme3/frontend/css/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/theme3/frontend/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/theme3/frontend/css/font-awsome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/theme3/frontend/css/iziToast.min.css') }}">
    <link href="{{ asset('asset/theme3/frontend/css/style.css') }}" rel="stylesheet">


    <!-- Custom Css Start-->
    {{-- <link rel="icon" type="image/png" href="{{asset('asset/theme3/assets/img/favicon.png')}}" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="{{asset('asset/theme3/assets/img/icon/192x192.png')}}"> --}}
    <link rel="stylesheet" href="{{asset('asset/theme3/assets/css/style.css')}}">
    {{-- <link rel="manifest" href="{{asset('asset/theme3/__manifest.json')}}"> --}}
    <!-- Custom Css End-->

    <!-- Material icons-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
