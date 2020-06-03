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
                    <div class="card-header">{{ __('Edit User') }}</div>
                    <form action="{{ route('user.update', $user->id) }}" method="post">
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{ __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                       placeholder="{{ __('Name') }}" value="{{ $user->name }}" required autocomplete="name" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Email') }}</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                       placeholder="{{ __('Email') }}" value="{{ $user->email }}" required autocomplete="email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Password') }}</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                       placeholder="{{ __('Password') }}" autocomplete="new-password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Confirm Password') }}</label>
                                <input type="password" class="form-control" name="password_confirmation"
                                       placeholder="{{ __('Confirm Password') }}" autocomplete="new-password">
                            </div>

                            <div class="form-group">
                                <label>{{ __('Role') }}</label>
                                <select class="form-control" name="role">
                                    <option value="User" @if ($user->role === 'User') selected @endif>User</option>
                                    <option value="Manager" @if ($user->role === 'Manager') selected @endif>Manager</option>
                                    <option value="Administrator" @if ($user->role === 'Administrator') selected @endif>Administrator</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Memberships to manage') }}</label>
                                <select name="memberships[]" class="form-control" multiple style="height: 250px">
                                    @foreach($memberships as $k => $membership)
                                        <option value="{{ $membership->id }}" @if ($user->memberships->contains($membership->id)) selected @endif>{{ $membership->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="{{ route('users') }}"><button type="button" class="btn btn-danger"><i class="fas fa-step-backward"></i> {{ __('Cancel') }}</button></a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
