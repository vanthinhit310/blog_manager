@extends('layouts.app', ['title' => __('Role Management')])

@section('content')
    @include('backend.role.partials.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-6">
                                <h3 class="mb-0">Role Management</h3>
                            </div>
                            <div class="col-6 text-right">
                                <a href="{{ route('admin.role.create') }}" class="btn btn-sm btn-primary btn-round btn-icon" data-toggle="tooltip" data-original-title="Create new role">
                                    <span class="btn-inner--icon"><i class="fas fa-plus"></i></span>
                                    <span class="btn-inner--text">Add role</span>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Role name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Creation date</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody class="list">
                            @foreach ($data as $row)
                                <tr>
                                    <td>{{ @$row->display_name }}</td>
                                    <td>{{ @$row->description }}</td>
                                    <td>
                                        {{ !empty($row->created_at) ? \Carbon\Carbon::parse($row->created_at)->format('d.m.Y H:i') : '' }}
                                    </td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    <form action="{{ route('admin.role.destroy', @$row) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        @permission('update-role')
                                                        <a class="dropdown-item" href="{{ route('admin.role.edit', @$row) }}">{{ __('Edit') }}</a>
                                                        @endpermission
                                                        @permission('destroy-role')
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this role?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Delete') }}
                                                        </button>
                                                        @endpermission
                                                    </form>
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
                            {{ $data->links() }}
                        </nav>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footers.auth')
    </div>
@endsection
