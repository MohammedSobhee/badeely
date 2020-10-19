@extends('layouts.admin',[ 'page'=> 'edit_category' ])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.categories')</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <a href="{{ route('admin.categories.index') }}" class="m-nav__link">
                                <span class="m-nav__link-text">@lang('pages.categories')</span>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                          <span class="m-nav__link-text">@lang('pages.edit_category')</span>
                        </li>

                    </ul>
                </div>

            </div>
        </div>

        <div class="m-subheader ">

            <div class="row">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
								<i class="la la-gear"></i>
								</span>
                                    <h3 class="m-portlet__head-text">@lang('pages.edit_category')</h3>
                                </div>
                            </div>
                        </div>

                        <form class="m-form validation-form" method="post" action="{{ route('admin.categories.update',[ 'id' => $category->id ]) }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="m-portlet__body">


                                <div class="languages-tabs">

                                                @if( config('languages') > 1 )
                                                    <ul class="nav nav-tabs">
                                                        @foreach( config('languages') as $code => $label )
                                                            <li class="nav-item m-tabs__item">
                                                                <a class="nav-link m-tabs__link {{ $loop->first ? 'active':''}}" href="#tb-lang-{{ $code }}" data-toggle="tab">{{ $label }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif

                                                <div class="tab-content">

                                                @foreach( config('languages')  as $code => $label )
                                                    <!-- content tab start -->
                                                        <div class="tab-pane {{ $loop->first ? 'active':''}}" id="tb-lang-{{ $code }}">

                                                            <div class="m-form__section m-form__section--first">
                                                                <div class="form-group m-form__group row">
                                                                    <label class="col-2 col-form-label" for="category_labels[{{ $code }}]">@lang('inputs.name') :</label>
                                                                    <div class="col-10">
                                                                        <input type="text" id="category_labels[{{ $code }}]" class="form-control m-input" name="category_labels[{{ $code }}]" value="{{ $category->name($code) }}">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <!-- content tab end -->
                                                    @endforeach


                                                </div>

                                            </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="parent_id">@lang('inputs.parent') :</label>
                                        <div class="col-10">
                                            <select id="parent_id" name="parent_id" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value="0">@lang('inputs.without')</option>
                                                @foreach( $categories as $cat )
                                                    <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label for="countries" class="col-2 col-form-label">@lang('inputs.countries') :</label>
                                        <div class="col-10">
                                            <select id="countries" name="countries[]" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type" multiple>
                                                @foreach( $countries as $country)
                                                    <option value="{{ $country->id }}" {{ in_array($country->id,$categoryCountry) ? 'selected' : ''}}>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="image">@lang('inputs.image') :</label>
                                        <div class="col-10">
                                            <img id="upload-pic" src="{{ $category->image() }}" class="img-responsive" width="500">
                                            <input type="file" id="file-upload" name="image" class="form-control m-input">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">

                                    <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">@lang('dashboard.save')</button>

                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

    <script>
        $("#file-upload").on('change', function(){
            if(validFile(this)){
                readURL(this,'#upload-pic');
            }
        });
    </script>

@endsection