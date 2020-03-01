@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('backend.users.partials.header', ['title' => __('Edit User')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('User Management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('admin.user.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.user.update', $user) }}" autocomplete="off">
                            @csrf
                            @method('PUT')

                            <h6 class="heading-small text-muted mb-4">{{ __('User information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('firstName') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-first-name">First name</label>
                                    <input type="text" name="firstName" id="input-first-name" class="form-control form-control-alternative{{ $errors->has('firstName') ? ' is-invalid' : '' }}" placeholder="First name" value="{{@$user->firstName ?? old('firstName') }}" required autofocus>

                                    @if ($errors->has('firstName'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('firstName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('lastName') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-last-name">Last name</label>
                                    <input type="text" name="lastName" id="input-last-name" class="form-control form-control-alternative{{ $errors->has('lastName') ? ' is-invalid' : '' }}" placeholder="Last name" value="{{ @$user->lastName ?? old('lastName') }}" required autofocus>

                                    @if ($errors->has('lastName'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('lastName') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('mobile') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-mobile">Phone number</label>
                                    <input type="text" name="mobile" id="input-mobile" class="form-control form-control-alternative{{ $errors->has('mobile') ? ' is-invalid' : '' }}" placeholder="Phone number" value="{{ @$user->mobile ?? old('mobile') }}" required autofocus>

                                    @if ($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-email">{{ __('Email') }}</label>
                                    <input type="email" name="email" id="input-email" class="form-control form-control-alternative{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Email') }}" value="{{ @$user->email}}" readonly>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @permission('assign-role')
                                <div class="form-group">
                                    <label class="form-control-label" >Choose role assign for this user</label>
                                    @foreach($roles as $role)
{{--                                        @dd($role->name,$user->getRoles())--}}
                                        <div class="custom-control custom-control-alternative custom-checkbox mb-3">
                                            <input class="custom-control-input" name="role[]" {{in_array(@$role->name,$user->getRoles()) ? 'checked' : ''}} value="{{@$role->id}}" id="customCheck{{@$role->id}}" type="checkbox">
                                            <label class="custom-control-label" for="customCheck{{@$role->id}}">{{@$role->display_name}}</label>
                                        </div>
                                    @endforeach
                                </div>
                                @endpermission
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                        <hr class="my-4" />
                        <form method="post" action="{{ route('admin.password.change',$user->id) }}" autocomplete="off">
                            @csrf
                            @method('put')

                            <h6 class="heading-small text-muted mb-4">{{ __('Password') }}</h6>

                            @if (session('password_status'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('password_status') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-password">{{ __('New Password') }}</label>
                                    <input autocomplete="off" type="password" name="password" id="input-password" class="form-control form-control-alternative{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="{{ __('New Password') }}" value="" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label class="form-control-label" for="input-password-confirmation">{{ __('Confirm New Password') }}</label>
                                    <input autocomplete="off" type="password" name="password_confirmation" id="input-password-confirmation" class="form-control form-control-alternative" placeholder="{{ __('Confirm New Password') }}" value="" required>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Change password') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
