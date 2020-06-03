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
                    <div class="card-header">{{ __('Create Employee') }}</div>
                    <form action="{{ route('employee.store') }}" method="post">
                        <div class="card-body">
                            @csrf
                            <div class="form-group">
                                <label>{{ __('First Name') }}</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="{{ __('First Name') }}" />
                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Last Name') }}</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="{{ __('Last Name') }}" />
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Email') }}</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('Email') }}"/>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Phone') }}</label>
                                <input type="text" class="form-control" name="phone" placeholder="{{ __('Phone') }}"/>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Company') }}</label>
                                <select name="company_id" class="form-control">
                                    @foreach($companies as $k => $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ __('Add') }}</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
