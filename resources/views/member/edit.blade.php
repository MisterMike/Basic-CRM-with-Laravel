@extends('layouts.app')

<!-- address,zip,city,email,phone_home',phone_mobile',phone_office,birthday,member_since,member_until,license,newsletter,comment -->

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
                                <label>{{ __('Email') }}</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="{{ __('Email') }}" value="{{ $member->email }}" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

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
                                <label>{{ __('Address') }}</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" name="address" placeholder="{{ __('Address') }}" value="{{ $member->address }}" />
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('ZIP Code') }}</label>
                                <input type="text" class="form-control" name="zip" placeholder="{{ __('ZIP Code') }}" value="{{ $member->zip }}" />
                            </div>

                            <div class="form-group">
                                <label>{{ __('City') }}</label>
                                <input type="text" class="form-control" name="city" placeholder="{{ __('City') }}" value="{{ $member->city }}" />
                            </div>

                            <div class="form-group">
                                <label>{{ __('Phone Home') }}</label>
                                <input type="text" class="form-control" name="phone_home" placeholder="{{ __('Phone Home') }}" value="{{ $member->phone_home }}" />
                            </div>

                            <div class="form-group">
                                <label>{{ __('Phone Mobile') }}</label>
                                <input type="text" class="form-control" name="phone_mobile" placeholder="{{ __('Phone Mobile') }}" value="{{ $member->phone_mobile }}" />
                            </div>

                            <div class="form-group">
                                <label>{{ __('Phone Office') }}</label>
                                <input type="text" class="form-control" name="phone_office" placeholder="{{ __('Phone Office') }}" value="{{ $member->phone_office }}" />
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

                            <div class="form-group">
                                <label>{{ __('Birthday') }}</label>
                                <input type="text" class="form-control" name="birthday" placeholder="{{ __('Birthday') }}" value="{{ $member->birthday }}" />
                            </div>

                            <hr>

                            <div class="form-group">
                                <label>{{ __('Member since') }}</label>
                                <input type="text" class="form-control" name="member_since" placeholder="{{ __('Member since') }}" value="{{ $member->member_since }}" />
                            </div>

                            <div class="form-group">
                                <label>{{ __('Member until') }}</label>
                                <input type="text" class="form-control" name="member_until" placeholder="{{ __('Member until') }}" value="{{ $member->member_until }}" />
                            </div>

                            <div class="form-group">
                                <label>{{ __('License') }}</label>
                                <input type="text" class="form-control" name="license" placeholder="{{ __('License') }}" value="{{ $member->license }}" />
                            </div>

                            <div class="form-group">
                                <label>{{ __('Newsletter') }}</label>
                                <input type="text" class="form-control" name="newsletter" placeholder="{{ __('Newsletter') }}" value="{{ $member->newsletter }}" />
                            </div>

                            <div class="form-group">
                                <label>{{ __('Comment') }}</label>
                                <textarea class="form-control" rows="4", cols="54" id="comment" name="comment">{{ $member->comment }}</textarea>
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
