<div class="row m-row--no-padding m-row--col-separator-xl">

    <div class="col-md-12 col-lg-12 col-xl-3">

        <div class="m-widget1">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">@lang('dashboard.active_accounts')</h3>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-brand">{{ $data['active_accounts'] }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12 col-lg-12 col-xl-3">

        <div class="m-widget1">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">@lang('dashboard.inactive_accounts')</h3>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-brand">{{ $data['inactive_accounts'] }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12 col-lg-12 col-xl-3">

        <div class="m-widget1">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">@lang('dashboard.active_users')</h3>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-brand">{{ $data['active_users'] }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12 col-lg-12 col-xl-3">

        <div class="m-widget1">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">@lang('dashboard.inactive_users')</h3>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-brand">{{ $data['inactive_users'] }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<div class="row m-row--no-padding m-row--col-separator-xl" style="border-top:#ebedf2 solid 1px;">

    <div class="col-md-12 col-lg-12 col-xl-3">

        <div class="m-widget1">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">@lang('dashboard.featured_accounts')</h3>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-brand">{{ $data['featured_accounts']  }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12 col-lg-12 col-xl-3">

        <div class="m-widget1">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">@lang('dashboard.total_clicks')</h3>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-brand">{{ $data['total_clicks'] }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12 col-lg-12 col-xl-3">

        <div class="m-widget1">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">@lang('dashboard.total_votes')</h3>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-brand">{{ $data['total_votes'] }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="col-md-12 col-lg-12 col-xl-3">

        <div class="m-widget1">
            <div class="m-widget1__item">
                <div class="row m-row--no-padding align-items-center">
                    <div class="col">
                        <h3 class="m-widget1__title">@lang('dashboard.categories')</h3>
                    </div>
                    <div class="col m--align-right">
                        <span class="m-widget1__number m--font-brand">{{ $data['categories'] }}</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>