@extends('backend.layout.master')


@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __($pageTitle) }}</h1>
            </div>

            <div class="row">

                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">

                        <div class="card-body p-2">

                            <table class="table table-striped" id="myTable">
                                <thead>
                                    <tr>
                                        <th>{{ __('Sl') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Amount') }}</th>
                                        <th>{{ __('Trade Start Time') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($trades as $key => $trade)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <a href="{{ route('admin.user.details', $trade->user) }}">
                                                    <i class="fa-solid fa-user"></i> {{ $trade->user->username }}
                                                </a>
                                            </td>
                                            <td>{{ number_format($trade->amount, 2) . ' ' . @$general->site_currency }}</td>
                                            <td>{{ $trade->created_at }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td class="text-center" colspan="100%">{{ __('No Data Found') }}
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                        </div>

                        @if ($trades->hasPages())
                            <div class="card-footer">
                                {{ $trades->links('backend.partial.paginate') }}
                            </div>
                        @endif

                    </div>
                </div>
            </div>

        </section>
    </div>


@endsection


@push('style-plugin')
    <link rel="stylesheet" href="{{ asset('asset/admin/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/admin/css/bs4-datatable.min.css') }}">
@endpush

@push('script-plugin')
    <script src="{{ asset('asset/admin/js/datatables.min.js') }}"></script>
    <script src="{{ asset('asset/admin/js/bs4-datatable.min.js') }}"></script>
@endpush

@push('style')
    <style>
        .pagination .page-item.active .page-link {
            background-color: rgb(95, 116, 235);
            border: none;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover,
        .dataTables_wrapper .dataTables_paginate .paginate_button:focus {
            background: transparent;
            border-color: transparent;
        }

        .pagination .page-item.active .page-link:hover {
            background-color: rgb(95, 116, 235);
        }

        th,
        td {
            text-align: center !important;
        }
    </style>
@endpush
