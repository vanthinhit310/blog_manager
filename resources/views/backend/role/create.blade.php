@extends('layouts.app', ['title' => __('Add Role')])

@section('content')
    @include('backend.role.partials.header', ['title' => __('Add Role')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">Role Management</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('admin.role.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.role.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">Role information</h6>
                            <div class="pl-lg-6">
                                <div class="form-group{{ $errors->has('display_name') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="input-dl-name">Role name</label>
                                    <input autocomplete="off" type="text" name="display_name" id="input-dl-name" class="form-control form-control-alternative{{ $errors->has('display_name') ? ' is-invalid' : '' }}" placeholder="Role name" value="{{ old('display_name') }}" required autofocus>

                                    @if ($errors->has('display_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('display_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('desceiption') ? ' has-danger' : '' }}">
                                    <label class="form-control-label" for="role-dr">Role description</label>
                                    <textarea class="form-control" name="description" id="role-dr" rows="3">{{ old('desceiption') ?? '' }}</textarea>

                                    @if ($errors->has('desceiption'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('desceiption') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                @isset($permissions)
                                    <div class="form-group">
                                        <label class="form-control-label">Choose permission to assign for this role</label>
                                        @foreach($permissions as $group => $permission)
                                            <ul class="list-group">
                                                <li class="list-group-item mb-3">
                                                    <div class="mb-2 badge badge-default">{{@$group}}</div>
                                                    <div class="row">
                                                        @foreach($permission as $p)
                                                            <div class="col-xl-3 col-md-6">
                                                                <div class="custom-control custom-control-alternative custom-checkbox">
                                                                    <input class="custom-control-input" name="permissions[]" {{$p->name == 'user' ? 'checked' : ''}} value="{{@$p->id}}" id="customCheck{{@$p->id}}" type="checkbox">
                                                                    <label class="custom-control-label" for="customCheck{{@$p->id}}">{{@$p->display_name}}</label>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>

                                        @endforeach
                                    </div>
                                @endisset
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
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
