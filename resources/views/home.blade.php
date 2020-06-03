@extends('layouts.app')

@section('content')
<div class="container">
    @if(session()->get('success'))
        <div class="row justify-content-center">
            <div class="col-md-8 mb-2">
                <div class="alert alert-success alert-dismissible fade show w-100" role="alert">
                    {{ session()->get('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif
    @if(session()->get('error'))
        <div class="row justify-content-center">
            <div class="col-md-8 mb-2">
                <div class="alert alert-danger alert-dismissible fade show w-100" role="alert">
                    {{ session()->get('error') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('messages.Memberships') }}</div>
                <div class="card-body">
                    {{ __('messages.nof_memberships', ['nof' => $nofMemberships]) }}
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('memberships') }}">{{ __('messages.show_all') }}</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">{{ __('messages.Members') }}</div>
                <div class="card-body">
                    {{ __('messages.nof_members', ['nof' => $nofMembers]) }}
                </div>
                <div class="card-footer text-center">
                    <a href="{{ route('members') }}">{{ __('messages.show_all') }}</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
