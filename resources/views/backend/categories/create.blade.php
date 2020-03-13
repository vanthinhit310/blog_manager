@extends('layouts.app', ['title' => __('categories.new_category')])

@section('content')
    @include('backend.categories.partials.header', ['title' => __('categories.add_category')])

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 order-xl-1">
                <div class="card bg-secondary shadow">
                    <div class="card-header bg-white border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('categories.category_management') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('admin.category.index') }}" class="btn btn-sm btn-primary">{{ __('Back to list') }}</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('admin.category.store') }}" autocomplete="off">
                            @csrf

                            <h6 class="heading-small text-muted mb-4">{{ __('categories.categories_information') }}</h6>
                            <div class="pl-lg-4">
                                <div class="form-group{{ $errors->has('title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label required">{{__('categories.title')}}</label>
                                    <input type="text" name="title" autocomplete="off" class="form-control form-control-alternative{{ $errors->has('title') ? ' is-invalid' : '' }}" placeholder="{{__('categories.title')}}" value="{{ old('title') }}" autofocus>

                                    @if ($errors->has('title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('title') }}</strong>
                                        </span>
                                    @endif
                                </div>
                                <div class="form-group{{ $errors->has('meta_title') ? ' has-danger' : '' }}">
                                    <label class="form-control-label required">{{__('categories.meta_title')}}</label>
                                    <input type="text" name="meta_title" autocomplete="off" class="form-control form-control-alternative{{ $errors->has('meta_title') ? ' is-invalid' : '' }}" placeholder="{{__('categories.meta_title')}}" value="{{ old('meta_title') }}" autofocus>

                                    @if ($errors->has('meta_title'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('meta_title') }}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label class="form-control-label">{{__('categories.content')}}</label>
                                    <textarea name="content" class="form-control form-control-alternative{{ $errors->has('content') ? ' is-invalid' : '' }}" rows="3"></textarea>
                                </div>

                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-primary" type="button" data-toggle="modal" data-target="#modal-media" id="button-addon2">{{ __('categories.logo') }}</button>
                                    </div>
                                </div>

                                <!-- Upload media manager -->
                                <media-component inline-template>
                                    <div>
                                        <div v-if="inputName">@include('MediaManager::extras.modal')</div>
                                        <media-modal item="cover" :name="inputName"></media-modal>
                                        <form action="#" method="get">
                                            <section>
                                                <input type="hidden" name="cover" :value="cover"/>
                                                <div v-if="cover != ''" class="avatar form-group">
                                                    <img alt="Image placeholder" class="img-fluid w-100" :src="cover">
                                                </div>
                                                <div class="toggle-modal">
                                                    <button @click="toggleModalFor('cover')" class="btn btn-icon btn-primary" type="button">
                                                        <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
                                                        <span class="btn-inner--text">Choose logo for this category</span>
                                                    </button>
                                                </div>
                                            </section>
                                        </form>
                                    </div>
                                </media-component inline-template>
                                <!-- Upload media manager -->
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
@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/MediaManager/bulma.css') }}">
    <style>
        .card-header {
            display: unset;
        }
    </style>
@endpush
