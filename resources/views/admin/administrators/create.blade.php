@extends('layouts.admin',[ 'page' => 'create_administrator' ])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.administrators')</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <a href="{{ route('admin.administrators.index') }}" class="m-nav__link">
                                <span class="m-nav__link-text">@lang('pages.administrators')</span>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text">@lang('pages.create_administrator')</span>
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
                                    <h3 class="m-portlet__head-text">@lang('pages.create_administrator')</h3>
                                </div>
                            </div>
                        </div>

                        <form class="m-form validation-form" method="post" action="{{ route('admin.administrators.store') }}">
                            {{ csrf_field() }}

                            <div class="m-portlet__body">

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="name">@lang('inputs.role') :</label>
                                        <div class="col-10">
                                            <select name="role_id" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type" required>
                                                @foreach(\App\Role::all() as $role)
                                                    <option {{ old('role') == $role->id ? 'selected' : ''}} value="{{ $role->id }}">{{ $role->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="name">@lang('inputs.name') :</label>
                                        <div class="col-10">
                                            <input type="text" id="name" class="form-control m-input" name="name" value="{{ old('name') }}" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="email">@lang('inputs.email') :</label>
                                        <div class="col-10">
                                            <input type="email" id="email" class="form-control m-input" name="email" value="{{ old('email') }}" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="password">@lang('inputs.password') :</label>
                                        <div class="col-10">
                                            <input type="password" id="password" class="form-control m-input" name="password" data-parsley-minlength="6" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="password_confirmation">@lang('inputs.password_confirmation') :</label>
                                        <div class="col-10">
                                            <input type="password" id="password_confirmation" class="form-control m-input" name="password_confirmation" data-parsley-minlength="6" data-parsley-equalto="#password" required>
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