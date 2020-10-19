<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('settings.website_name') }}</title>

    <!-- Fonts -->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

</head>
<body>

<div class="container">
    <div class="row text-center">
        <div class="col-sm-6 col-sm-offset-3">
            <br><br><br>
            <a href="#" style="text-decoration: none;    display: table;margin: auto;">
                <img style="width:50%" src="{{ assets('logo.svg') }}">
            </a>
            <hr>
            <h2 style="color:#0fad00">@lang('dashboard.success')</h2>
            <h3>@lang('dashboard.dear'), {{ $user->name }}</h3>
            <p style="font-size:20px;color:#5C5C5C;">@lang('dashboard.thank_you_for_verifying_your_account')</p>
            <p style="font-size:20px;color:#5C5C5C;">@lang('dashboard.you_can_login_to_application_now')</p>
            <br><br>
        </div>

    </div>
</div>

</body>
</html>
