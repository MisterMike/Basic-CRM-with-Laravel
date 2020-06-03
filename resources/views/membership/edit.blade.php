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
                    <div class="card-header">{{ __('Edit Membership') }}</div>
                    <form action="{{ route('membership.update', $membership->id) }}" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label>{{ __('Name') }}</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{ __('Name') }}" value="{{ $membership->name }}" />
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Email') }}</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('Email') }}" value="{{ $membership->email }}" />
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>{{ __('Logo') }}</label>
                                        <input type="file" class="form-control" name="logo" value="{{ $membership->logo }}" />
                                    </div>
                                </div>
                                <div class="col-md-4 text-right">
                                    @if (!empty($membership->logo))
                                        <img src="{{ asset('storage/' . $membership->logo) }}" style="width: 100px; height: 100px;">
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Website') }}</label>
                                <input type="text" class="form-control" name="website" placeholder="{{ __('Website') }}" value="{{ $membership->website }}" />
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="{{ route('memberships') }}"><button type="button" class="btn btn-danger"><i class="fas fa-step-backward"></i> {{ __('Cancel') }}</button></a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> {{ __('Update') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
