@extends('layouts.app', ['title' => __('categories.category_management')])

@section('content')
    @include('backend.categories.partials.cards')
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('categories.categories') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                @permission('add-category')
                                <a href="{{ route('admin.category.create') }}" class="btn btn-sm btn-primary">{{ __('categories.add_category') }}</a>
                                @endpermission
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Meta title</th>
                                <th scope="col">{{ __('Creation Date') }}</th>
                                <th scope="col"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($data as $row)
                                <tr>
                                    <td>{{ @$row->title }}</td>
                                    <td>{{ @$row->meta_title }}</td>
                                    <td>{{ \Illuminate\Support\Carbon::parse(@$row->created_at)->format('d.m.Y H:i') }}</td>
                                    <td class="text-right">
                                        <div class="dropdown">
                                            <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-v"></i>
                                            </a>
                                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                <form action="{{ route('admin.user.destroy', @$user) }}" method="post">
                                                    @csrf
                                                    @method('delete')
                                                    @permission('update-category')
                                                    <a class="dropdown-item" href="{{ route('admin.user.edit', @$user) }}">{{ __('Edit') }}</a>
                                                    @endpermission
                                                    @permission('destroy-category')
                                                    <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete this user?") }}') ? this.parentElement.submit() : ''">
                                                        {{ __('Delete') }}
                                                    </button>
                                                    @endpermission
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center"><span class="text-primary">No data to display</span></td>
                                </tr>
                            @endforelse
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
