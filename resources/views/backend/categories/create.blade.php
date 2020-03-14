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
                        <media-component inline-template>

                        <form class="dropzone-media-manager" method="post" action="{{ route('admin.category.store') }}" autocomplete="off">
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


                                <!-- Upload media manager -->
                                    <div style="height:160px">
                                        <div v-if="inputName">@include('MediaManager::extras.modal', ['filter' => false,'no_bulk'=> false,'bookmarks' => false, 'lock' => false, 'hidden' => false])</div>
                                        <media-modal item="cover" :name="inputName"></media-modal>
                                        <section class="{{ $errors->has('logo') ? ' has-danger' : '' }}">
                                            <input type="hidden" name="logo" class="form-control form-control-alternative {{ $errors->has('logo') ? ' is-invalid' : '' }}" :value="cover"/>

                                            <div v-if="cover != ''" class="avatar avatar-cover-custom form-group">
                                                <img alt="Image placeholder" class="img-fluid w-100" :src="cover">
                                                <a role="button" @click="removeCoverImage()" class="remove-media-image"><i class="fa fa-times" aria-hidden="true"></i></a>
                                            </div>
                                            <div v-if="cover == ''" class="toggle-modal">
                                                <button class="media-manager-button" @click="toggleModalFor('cover')" type="button">
                                                    <span class="btn-inner--text">Browser media</span>
                                                </button>
                                            </div>
                                            @if ($errors->has('logo'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('logo') }}</strong>
                                                </span>
                                            @endif
                                        </section>
                                    </div>
                                <!-- Upload media manager -->
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success mt-4">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                        </media-component>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth')
    </div>
@endsection
