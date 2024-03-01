@extends('backend.layout.master')

@section('content')
    <div class="main-content">
        <div class="manage-language">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-primary add">{{ __('Add Currency') }}</button>
                </div>
                <div class="card-body p-0 table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>{{ __('Currency Name') }}</th>
                                <th>{{ __('Rate') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allCurrency as $cur)
                                <tr>
                                    <td>{{ $cur->currency }}</td>
                                    <td>{{ $cur->rate }}</td>
                                    <td>
                                        <button class="btn btn-md btn-primary edit mr-1"
                                            data-href="{{ route('admin.currency.edit', $cur) }}"
                                            data-cur="{{ $cur }}"><i class="fa fa-pen"></i></button>

                                        <button class="btn btn-md btn-danger delete mr-1"
                                            data-href="{{ route('admin.currency.delete', $cur) }}"><i
                                                class="fa fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- add modal -->
    
    <div class="modal fade" tabindex="-1" id="add" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Add Currency') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">{{ __('Currency Name') }}</label>
                                <input type="text" name="currency" class="form-control" placeholder="{{ __('Enter Currency') }}">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="">{{ __('Currency Rate') }}</label>
                                <input type="text" name="rate" class="form-control" placeholder="{{ __('Enter currency Rate') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Create') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- edit modal -->
    <div class="modal fade" tabindex="-1" id="edit" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Edit Currency') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="">{{ __('Currency Name') }}</label>
                                <input type="text" name="currency" class="form-control"
                                    placeholder="{{ __('Enter Currency') }}">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="">{{ __('Currency Rate') }}</label>
                                <input type="text" name="rate" class="form-control"
                                    placeholder="{{ __('Enter currency Rate') }}">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">{{ __('Close') }}</button>
                        <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <div class="modal fade" tabindex="-1" id="delete" role="dialog">
        <div class="modal-dialog" role="document">
            <form action="" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">{{ __('Delete Currency') }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <p>{{ __('Are You Sure to Delete') }}?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>

                        <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection

@push('script')

    <script>
        $(function() {
            'use strict'

            $('.add').on('click', function() {
                const modal = $('#add');

                modal.modal('show')
            })

            $('.edit').on('click', function() {
                const modal = $('#edit');
                modal.find('form').attr('action', $(this).data('href'))
                modal.find('input[name=currency]').val($(this).data('cur').currency)
                modal.find('input[name=rate]').val($(this).data('cur').rate)
                modal.modal('show')
            })

            $('.delete').on('click', function() {
                const modal = $('#delete');

                modal.find('form').attr('action', $(this).data('href'));

                modal.modal('show');
            })

        })
    </script>



@endpush
