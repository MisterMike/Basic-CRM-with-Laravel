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

            <div class="col-md-12">
                <div class="card">

                    <div class="card-header">
                        {{ __('Users') }}
                        <div class="float-right">
                            <a href="{{ route('user.create') }}">
                                <button class="btn btn-success btn-sm"><i class="fas fa-plus"></i> {{ __('Create User') }}</button>
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="w-auto">{{ __('Name') }}</th>
                                    <th class="w-auto">{{ __('Email') }}</th>
                                    <th class="w-auto">{{ __('Type') }}</th>
                                    <th class="w-auto">{{ __('Memberships') }}</th>
                                    <th class="text-center" colspan="2">{{ __('Actions') }}</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($users as $k => $user)
                                    <tr>
                                        <td style="vertical-align: middle">{{ $user->name }}</td>
                                        <td style="vertical-align: middle">{{ $user->email }}</td>
                                        <td style="vertical-align: middle">{{ $user->role }}</td>
                                        <td style="vertical-align: middle">
                                            @foreach($user->memberships as $membership)
                                                <button class="btn btn-sm btn-outline-info m-1">{{ $membership->name }}</button>
                                            @endforeach
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <a href="{{ route('user.edit', $user->id) }}">
                                                <button class="btn btn-sm btn-warning text-nowrap"><i class="fas fa-edit"></i> {{ __('Edit') }}</button>
                                            </a>
                                        </td>
                                        <td class="text-center" style="vertical-align: middle;">
                                            <form action="{{ route('user.destroy', $user->id)}}" method="post">
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
                        <div class="float-left">{{ $users->links() }}</div>
                        <div class="float-right" style="line-height: 2rem">{{ __('Total Records') }}: {{ $users->total() }}</div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
