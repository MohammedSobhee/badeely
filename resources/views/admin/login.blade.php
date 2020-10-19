<!DOCTYPE html>

<html lang="{{ app()->getLocale() }}" dir="{{ app()->isLocale('ar') ? 'rtl' : 'ltr' }}">

	<head>

        <meta charset="utf-8" />
        <title> {{ config('settings.website_name') .' | '. __('pages.dashboard_login') }} </title>
		<meta name="description" content="">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- FAVICON -->
		<link rel="apple-touch-icon" sizes="180x180" href="{{ assets('favicon/apple-touch-icon.png') }}">
		<link rel="icon" type="image/png" sizes="32x32" href="{{ assets('favicon/favicon-32x32.png') }}">
		<link rel="icon" type="image/png" sizes="16x16" href="{{ assets('favicon/favicon-16x16.png') }}">
		<link rel="manifest" href="{{ assets('favicon/site.webmanifest') }}">
		<link rel="mask-icon" href="{{ assets('favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">
		<!-- FAVICON -->


		<link href="{{ url('assets/admin/vendors/base/vendors.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ url('assets/admin/demo/default/base/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    	<link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900" rel="stylesheet">


	    <link href="{{ url('assets/admin/style.css') }}" rel="stylesheet" type="text/css" />

	    <link href="{{ url('assets/admin/style-rtl.css') }}" rel="stylesheet" type="text/css" />

	</head>

	<body class="m--skin- m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

		<div class="m-grid m-grid--hor m-grid--root m-page">
			<div class="m-grid__item m-grid__item--fluid m-grid m-grid--hor m-login m-login--singin m-login--2 m-login-2--skin-2" id="m_login">
				<div class="m-grid__item m-grid__item--fluid	m-login__wrapper">
					<div class="m-login__container">
						<div class="m-login__logo">
							<img style="width:50%" src="{{ assets('logo.svg') }}">
						</div>
						<div class="m-login__signin">
                            @if(count($errors))
                                <div class="m-subheader">
                                    <div class="alert alert-danger">
                                        @foreach($errors->all() as $error)
                                            <p>{{ $error }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

							<form class="m-login__form m-form" method="post">
								{{ csrf_field() }}

								<div class="form-group m-form__group">
									<input class="form-control m-input" type="email" placeholder="@lang('inputs.email')" name="email" value="{{ old('email') }}">
								</div>
								<div class="form-group m-form__group">
									<input class="form-control m-input m-login__form-input--last" type="password" placeholder="@lang('inputs.password')" name="password">
								</div>
								<div class="row m-login__form-sub">
									<div class="col m--align-right m-login__form-right">
										<label class="m-checkbox">
											<input type="checkbox" name="remember" value="1">
												@lang('inputs.remember_me')
											<span></span>
										</label>
									</div>
								</div>
								<div class="m-login__form-action">
									<button id="m_login_signin_submit" class="btn btn-fix m-btn m-btn--pill m-btn--custom m-btn--air m-login__btn m-login__btn--primary">@lang('inputs.login')</button>
								</div>
							</form>
						</div>

					</div>
				</div>
			</div>
		</div>

		<script src="{{ url('assets/admin/vendors/base/vendors.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ url('assets/admin/demo/default/base/scripts.bundle.js') }}" type="text/javascript"></script>

		<script type="text/javascript">
            $(function(){
                $("form").submit(function(){
                    $("#m_login_signin_submit").addClass('m-loader m-loader--right m-loader--light').attr('disabled', true);
                });
            });
		</script>

	</body>

</html>
