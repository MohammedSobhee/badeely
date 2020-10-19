@extends('layouts.admin',[ 'page'=> 'settings' ])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.settings')</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text">@lang('pages.settings')</span>
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
                                    <h3 class="m-portlet__head-text">@lang('pages.settings')</h3>
                                </div>
                            </div>
                        </div>


             <form class="m-form validation-form" method="post" action="{{ route('admin.settings.edit') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}

                            <div class="m-portlet m-portlet--tabs">

                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-tools">
                                        <ul class="prodHeadz nav nav-tabs m-tabs-line m-tabs-line--info m-tabs-line--2x">

                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link active" href="#general-tb">@lang('pages.general_settings')</a>
                                            </li>

                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link" href="#featured_category-tb">@lang('pages.featured_category')</a>
                                            </li>

                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link " href="#social-tb">@lang('pages.social_media_settings')</a>
                                            </li>

                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link " href="#app-tb">@lang('pages.app_url_settings')</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="m-portlet__body">

                                    <div class="m-form__section m-form__section--first">

                                        <div class="tab-content prodHeadz">

                                            <div class="tab-pane active" role="tabpanel" id="general-tb">


                                                <div class="form-group m-form__group row">
                                                    <label for="website_name" class="col-2 col-form-label">@lang('inputs.website_name') :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="website_name" class="form-control m-input" name="website_name" value="{{ $settings->website_name }}">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="website_description" class="col-2 col-form-label">@lang('inputs.website_description') :</label>
                                                    <div class="col-10">
                                                        <div class="languages-tabs">

                                                            <div class="tab-content">

                                                                <div class="tab-pane active">

                                                                    @if( config('languages') > 1 )
                                                                        <ul class="nav nav-tabs">
                                                                            @foreach( config('languages') as $code => $label )
                                                                                <li class="nav-item m-tabs__item">
                                                                                    <a class="nav-link m-tabs__link {{ $loop->first ? 'active':''}}" href="#tb-website_description-lang-{{ $code }}" data-toggle="tab">{{ $label }}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif

                                                                    <div class="tab-content">

                                                                    @foreach( config('languages')  as $code => $label )
                                                                        <!-- content tab start -->
                                                                            <div class="tab-pane {{ $loop->first ? 'active':''}}" id="tb-website_description-lang-{{ $code }}">

                                                                                <div class="m-form__section m-form__section--first">
                                                                                    <div class="form-group m-form__group row">
                                                                                        <div class="col-12">
                                                                                            @php
                                                                                                $name = "website_description_{$code}";
                                                                                            @endphp
                                                                                            <textarea name="{{ $name }}" id="{{ $name }}" class="form-control m-input" cols="30" rows="8">{{ $settings->$name }}</textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <!-- content tab end -->
                                                                        @endforeach


                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="website_mobile" class="col-2 col-form-label">@lang('inputs.mobile') :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="website_mobile" class="form-control m-input" name="website_mobile" value="{{ $settings->website_mobile }}">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="website_email" class="col-2 col-form-label">@lang('inputs.email') :</label>
                                                    <div class="col-10">
                                                        <input type="email" id="website_email" class="form-control m-input" name="website_email" value="{{ $settings->website_email }}">
                                                    </div>
                                                </div>


                                                <div class="form-group m-form__group row">
                                                    <label for="accounts_in_page" class="col-2 col-form-label">@lang('inputs.accounts_in_page') :</label>
                                                    <div class="col-10">
                                                        <input type="number" id="accounts_in_page" class="form-control m-input" name="accounts_in_page" value="{{ $settings->accounts_in_page }}" min="1">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="latest_accounts_last_days" class="col-2 col-form-label">@lang('inputs.latest_accounts_last_days') :</label>
                                                    <div class="col-10">
                                                        <input type="number" id="latest_accounts_last_days" class="form-control m-input" name="latest_accounts_last_days" value="{{ $settings->latest_accounts_last_days }}" min="1">
                                                    </div>
                                                </div>


                                             </div>

                                            <div class="tab-pane" role="tabpanel" id="featured_category-tb">

                                                <div class="form-group m-form__group row">
                                                    <label for="featured_titla" class="col-2 col-form-label">@lang('inputs.featured_title') :</label>
                                                    <div class="col-10">

                                                        <div class="languages-tabs">

                                                            <div class="tab-content">

                                                                <div class="tab-pane active">

                                                                    @if( config('languages') > 1 )
                                                                        <ul class="nav nav-tabs">
                                                                            @foreach( config('languages') as $code => $label )
                                                                                <li class="nav-item m-tabs__item">
                                                                                    <a class="nav-link m-tabs__link {{ $loop->first ? 'active':''}}" href="#tb-featured_title-lang-{{ $code }}" data-toggle="tab">{{ $label }}</a>
                                                                                </li>
                                                                            @endforeach
                                                                        </ul>
                                                                    @endif

                                                                    <div class="tab-content">

                                                                    @foreach( config('languages')  as $code => $label )
                                                                        <!-- content tab start -->
                                                                            <div class="tab-pane {{ $loop->first ? 'active':''}}" id="tb-featured_title-lang-{{ $code }}">

                                                                                <div class="m-form__section m-form__section--first">
                                                                                    <div class="form-group m-form__group row">
                                                                                        <div class="col-12">
                                                                                            @php
                                                                                                $name = "featured_title_{$code}";
                                                                                            @endphp
                                                                                            <input type="text" id="{{ $name }}" class="form-control m-input" name="{{ $name }}" value="{{ $settings->$name }}">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <!-- content tab end -->
                                                                        @endforeach


                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label class="col-2 col-form-label" for="image">@lang('inputs.featured_img') :</label>
                                                    <div class="col-10">
                                                        <img src="{{ url('/') }}/assets/featured_img.png?time={{ time() }}" class="img-responsive" style="max-width:300px;margin-bottom:15px;">

                                                        <input type="file" name="featured_img" class="form-control m-input">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="tab-pane" role="tabpanel" id="social-tb">

                                                <div class="form-group m-form__group row">
                                                    <label for="facebook" class="col-2 col-form-label">@lang('inputs.facebook') :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="facebook" class="form-control m-input" name="facebook" value="{{ $settings->facebook }}">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="twitter" class="col-2 col-form-label">@lang('inputs.twitter') :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="twitter" class="form-control m-input" name="twitter" value="{{ $settings->twitter }}">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="instagram" class="col-2 col-form-label">@lang('inputs.instagram') :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="instagram" class="form-control m-input" name="instagram" value="{{ $settings->instagram }}">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="youtube" class="col-2 col-form-label">@lang('inputs.youtube') :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="youtube" class="form-control m-input" name="youtube" value="{{ $settings->youtube }}">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="tab-pane" role="tabpanel" id="app-tb">

                                                <div class="form-group m-form__group row">
                                                    <label for="google_play" class="col-2 col-form-label">@lang('inputs.google_play') :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="google_play" class="form-control m-input" name="google_play" value="{{ $settings->google_play }}">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="appstore" class="col-2 col-form-label">@lang('inputs.appstore') :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="appstore" class="form-control m-input" name="appstore" value="{{ $settings->appstore }}">
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

@section('scripts')

    <script>
        $(function(){
        $(".prodHeadz.nav.nav-tabs.m-tabs-line li a").click(function(){
        $(".prodHeadz.nav.nav-tabs.m-tabs-line li a").removeClass('active');
        $(this).addClass('active');

        $(".prodHeadz > .tab-pane").removeClass('active');
        $($(this).attr('href')).addClass('active');
        return false;
        });
        });
    </script>

@endsection