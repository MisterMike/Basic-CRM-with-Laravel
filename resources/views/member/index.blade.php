@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if(session()->get('success'))
                <div class="col-md-12 mb-2">
                    <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                        {{ session()->get('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            @if(session()->get('error'))
                <div class="col-md-12 mb-2">
                    <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                        {{ session()->get('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif

            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">{{ __('Members') }}</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="w-auto">{{ __('messages.firstname') }}</th>
                                    <th class="w-auto">{{ __('messages.lastname') }}</th>
                                    <th class="w-auto">{{ __('messages.email') }}</th>
                                    <th class="w-auto">{{ __('messages.phonemobile') }}</th>
                                    <th class="w-auto">{{ __('messages.membership') }}</th>
                                    <th class="w-auto">{{ __('messages.license') }}</th>
                                    <th class="text-center" colspan="2">{{ __('messages.actions') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($members as $k => $member)
                                    <tr>
                                        <td style="vertical-align: middle">{{ $member->first_name }}</td>
                                        <td style="vertical-align: middle">{{ $member->last_name }}</td>
                                        <td style="vertical-align: middle">{{ $member->email }}</td>
                                        <td style="vertical-align: middle">{{ $member->phone_mobile }}</td>
                                        <td style="vertical-align: middle">{{ $member->membership->name }}</td>
                                        <td style="vertical-align: middle">
                                            <i class="fas fa-{{ $member->license ? 'check' : 'times' }}"></i>
                                        </td>
                                        <td class="text-nowrap text-center" style="vertical-align: middle;">
                                            <a href="{{ route('member.edit', $member->id) }}">
                                                <button class="btn btn-sm btn-warning text-nowrap"><i class="fas fa-edit"></i> {{ __('Edit') }}</button>
                                            </a>
                                        </td>
                                        <td class="text-nowrap text-center" style="vertical-align: middle;">
                                            <form action="{{ route('member.destroy', $member->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger text-nowrap" type="submit"><i class="fas fa-trash"></i> {{ __('Delete') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        <div class="float-left">{{ $members->links() }}</div>
                        <div class="float-right" style="line-height: 2rem">{{ __('Total Members') }}: {{ $members->total() }}</div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
