@extends('layouts.app', ['title' => __('User Management')])

@section('content')
    @include('layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Users') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                @permission('add-user')
                                <a href="{{ route('admin.user.create') }}" class="btn btn-sm btn-primary">{{ __('Add user') }}</a>
                                @endpermission
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">First name</th>
                                    <th scope="col">Last name</th>
                                    <th scope="col">Mobile</th>
                                    <th scope="col">{{ __('Email') }}</th>
                                    <th scope="col">{{ __('Creation Date') }}</th>
                                    <th scope="col">Last login</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ @$user->firstName }}</td>
                                        <td>{{ @$user->lastName }}</td>
                                        <td>{{ @$user->mobile }}</td>
                                        <td>
                                            <a href="mailto:{{ @$user->email }}">{{ @$user->email }}</a>
                                        </td>
                                        <td>{{ !empty($user->created_at) ? $user->created_at->format('d/m/Y H:i') : '' }}</td>
                                        <td>{{ !empty($user->last_login) ? $user->last_login->format('d/m/Y H:i') : '' }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    @if (@$user->id != auth()->id())
                                                        <form action="{{ route('admin.user.destroy', @$user) }}" method="post">
                                                            @csrf
                                                            @method('delete')
                                                            @permission('update-user')
                                                            <a class="dropdown-item" href="{{ route('admin.user.edit', @$user) }}">{{ __('Edit') }}</a>
                                                            @endpermission
                                                            @permission('destroy-user')
                                                            <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                                {{ __('Delete') }}
                                                            </button>
                                                            @endpermission
                                                        </form>
                                                    @else
                                                        @permission('update-user')
                                                        <a class="dropdown-item" href="{{ route('admin.profile.edit') }}">{{ __('Edit') }}</a>
                                                        @endpermission
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                            {{ $users->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
