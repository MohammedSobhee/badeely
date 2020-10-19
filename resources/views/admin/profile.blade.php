@extends('layouts.admin',['page' => 'profile'])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.profile')</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text">@lang('pages.profile')</span>
                        </li>

                    </ul>
                </div>

            </div>

        </div>

        <div class="m-subheader">

            <div class="row">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
								<i class="la la-gear"></i>
								</span>
                                    <h3 class="m-portlet__head-text">@lang('pages.profile')</h3>
                                </div>
                            </div>
                        </div>

                        <form class="m-form validation-form" method="post" action="{{ url('admin/profile') }}">
                            {{ csrf_field() }}

                            <div class="m-portlet m-portlet--tabs">
                                <div class="m-portlet__body">

                                    <div class="m-form__section m-form__section--first">

                                        <div class="tab-content prodHeadz">

                                            <div class="tab-pane active" role="tabpanel" id="general-tb">


                                                <div class="languages-tabs">


                                                    <div class="tab-content">

                                                        <div class="form-group m-form__group row">
                                                            <label for="name" class="col-2 col-form-label">@lang('inputs.name') :</label>
                                                            <div class="col-10">
                                                                <input type="text" id="name" class="form-control m-input" name="name" value="{{ auth('admins')->user()->name }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group m-form__group row">
                                                            <label for="email" class="col-2 col-form-label">@lang('inputs.email') :</label>
                                                            <div class="col-10">
                                                                <input type="email" id="email" class="form-control m-input" name="email" value="{{ auth('admins')->user()->email }}" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group m-form__group row">
                                                            <label for="password" class="col-2 col-form-label">@lang('inputs.password') :</label>
                                                            <div class="col-10">
                                                                <input type="password" id="password" class="form-control m-input" name="password" data-parsley-minlength="6">
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>


                                            </div>

                                        </div>

                                    </div>
                                </div>
                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions">

                                        <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">@lang('dashboard.save')</button>

                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection


