@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger mb-3">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">{{ __('Edit Member Data') }}</div>
                    <form action="{{ route('member.update', $member->id) }}" method="post">
                        <div class="card-body">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label>{{ __('First Name') }}</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="{{ __('First Name') }}" value="{{ $member->first_name }}" />
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Last Name') }}</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="{{ __('Last Name') }}" value="{{ $member->last_name }}" />
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Email') }}</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('Email') }}" value="{{ $member->email }}" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Phone') }}</label>
                                <input type="text" class="form-control" name="phone" placeholder="{{ __('Phone') }}" value="{{ $member->phone }}" />
                            </div>

                            <div class="form-group">
                                <label>{{ __('Membership') }}</label>
                                <select name="membership_id" class="form-control">
                                    @foreach($memberships as $k => $membership)
                                        @if ($membership->id == $member->membership_id)
                                            <option value="{{ $membership->id }}" selected>{{ $membership->name }}</option>
                                        @else
                                            <option value="{{ $membership->id }}">{{ $membership->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="card-footer">
                            <a href="{{ route('members') }}"><button type="button" class="btn btn-danger"><i class="fas fa-step-backward"></i> {{ __('Cancel') }}</button></a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
