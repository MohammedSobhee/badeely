@extends('layouts.admin',[ 'page' => 'create_user' ])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.users')</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <a href="{{ route('admin.users.index') }}" class="m-nav__link">
                                <span class="m-nav__link-text">@lang('pages.users')</span>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text">@lang('pages.create_user')</span>
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
                                    <h3 class="m-portlet__head-text">@lang('pages.create_user')</h3>
                                </div>
                            </div>
                        </div>

                        <form class="m-form validation-form" method="post" action="{{ route('admin.users.store') }}">
                            {{ csrf_field() }}

                            <div class="m-portlet__body">

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
                                            <input type="email" id="email" class="form-control m-input" name="email" value="{{ old('email') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="mobile">@lang('inputs.mobile') :</label>
                                        <div class="col-10">
                                            <input type="text" id="mobile" class="form-control m-input" name="mobile" value="{{ old('mobile') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="country">@lang('inputs.country') :</label>
                                        <div class="col-10">
                                            <select id="country" name="country" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value="">@lang('inputs.country')</option>
                                                @foreach( $countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="language">@lang('inputs.language') :</label>
                                        <div class="col-10">
                                            <select id="language" name="language" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value="">@lang('inputs.language')</option>
                                                @foreach(config('languages') as $key => $label)
                                                    <option value="{{ $key }}" {{ old('language') ==  $key ? 'selected' : ''}}>{{ $label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="gender">@lang('inputs.gender') :</label>
                                        <div class="col-10">
                                            <select id="gender" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type" name="gender">
                                                <option value="">@lang('inputs.gender')</option>
                                                <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>@lang('inputs.male')</option>
                                                <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>@lang('inputs.female')</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="age">@lang('inputs.age') :</label>
                                        <div class="col-10">
                                            <select id="age" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type" name="age">
                                                <option value="">@lang('inputs.age')</option>
                                                <option value="16-24" {{ request('age') == '16-24' ? 'selected' : '' }}>16-24</option>
                                                <option value="25-29" {{ request('age') == '25-29' ? 'selected' : '' }}>25-29</option>
                                                <option value="30-40" {{ request('age') == '30-40' ? 'selected' : '' }}>30-40</option>
                                                <option value="+40" {{ request('age')  == '+40' ? 'selected' : '' }}>+40</option>
                                            </select>
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
                                            <input type="password" id="password_confirmation" class="form-control m-input" name="password_confirmation" required data-parsley-equalto="#password">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label for="pageTitle" class="col-2 col-form-label">@lang('inputs.verified') :</label>
                                        <div class="col-10">
										<span class="m-switch m-switch--lg m-switch--info m-switch--icon">
												<label>
						                        <input type="checkbox" name="is_confirmed" value="1">
						                        <span></span>
						                        </label>
						                    </span>
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