@extends('backend.layout.master')


@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>{{ __($pageTitle) }}</h1>
            </div>

            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header">
                            <div class="d-inline-flex">


                            </div>


                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table" id="example">
                                    <thead>
                                        <tr>

                                            <th>{{ __('Sl') }}</th>
                                            <th>{{ __('Full Name') }}</th>
                                            <th>{{ __('Phone') }}</th>
                                            <th>{{ __('Email') }}</th>
                                            <th>{{ __('Country') }}</th>
                                            <th>{{ __('Status') }}</th>
                                            <th>{{ __('Action') }}</th>

                                        </tr>

                                    </thead>

                                    <tbody id="filter_data">

                                        @forelse($userdata as $key => $user)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $user->fname.' '.$user->lname }}</td>
                                                <td>{{ $user->phone ?? 'N/A'}}</td>
                                                <td>{{ $user->email ?? 'N/A' }}</td>
                                                <td>{{ @$user->country ?? 'N/A' }}</td>
                                                <td>

                                                    @if ($user->status==1)
                                                        <span class='badge badge-success'>{{ __('Active') }}</span>
                                                    @elseif($user->status==0)
                                                        <span class='badge badge-danger'>{{ __('Pending') }}</span>
                                                    @else
                                                    <span class='badge badge-danger'>{{ __('Rejected') }}</span>
                                                    @endif

                                                </td>

                                                <td>

                                                    <a href="{{route('admin.user.kycdetails',$user->id)}}"
                                                        class="btn btn-md btn-primary"><i class="fa fa-eye"></i></a>
                                                </td>


                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="text-center" colspan="100%">{{ __('No Data Found') }}</td>
                                            </tr>
                                        @endforelse



                                    </tbody>
                                </table>
                            </div>
                        </div>


                        @if ($userdata->hasPages())
                            <div class="card-footer">
                                {{ $userdata->links('backend.partial.paginate') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
