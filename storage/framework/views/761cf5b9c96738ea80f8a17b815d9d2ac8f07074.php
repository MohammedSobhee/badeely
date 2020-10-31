<?php $__env->startSection('content'); ?>

    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title "> <?php echo app('translator')->getFromJson('pages.home'); ?> </h3>
            </div>
        </div>
    </div>

    <div class="m-content">

        <div class="m-portlet">
            <div class="m-portlet__body m-portlet__body--no-padding">
                <div class="row m-row--no-padding m-row--col-separator-xl">

                    <div class="col-md-12 col-lg-12 col-xl-3">

                        <div class="m-widget1">
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <h3 class="m-widget1__title"><?php echo app('translator')->getFromJson('dashboard.accounts_count'); ?></h3>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand"><?php echo e(\App\Account::count()); ?></span>
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
                                        <h3 class="m-widget1__title"><?php echo app('translator')->getFromJson('dashboard.users_count'); ?></h3>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand"><?php echo e(\App\User::count()); ?></span>
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
                                        <h3 class="m-widget1__title"><?php echo app('translator')->getFromJson('dashboard.countries_count'); ?></h3>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand"><?php echo e(\App\Country::where('is_active',1)->count()); ?></span>
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
                                        <h3 class="m-widget1__title"><?php echo app('translator')->getFromJson('dashboard.app_download_count'); ?></h3>
                                    </div>
                                    <div class="col m--align-right">
                                        <span class="m-widget1__number m--font-brand"><?php echo e(\App\User::count()); ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>

        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title "></h3>
            </div>
            <div>

                <div class="dropdown">
                    <button class="m-portlet__nav-link m-dropdown__toggle dropdown-toggle btn btn--sm m-btn--pill btn-secondary m-btn m-btn--label-brand" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo app('translator')->getFromJson('dashboard.all_countries'); ?>
                    </button>
                    <div id="country-filter" class="dropdown-menu m-dropdown__body scrollable-menu" aria-labelledby="dropdownMenuButton">
                        <a id="all-countries" class="dropdown-item" href="javascript:0;" data-id=""><?php echo app('translator')->getFromJson('dashboard.all_countries'); ?></a>
                        <?php $__currentLoopData = \App\Country::where('is_active',1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="dropdown-item" href="javascript:0;" data-id="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <br>
            </div>
        </div>

        <div class="m-portlet">

            <div id="country-filter-div" class="m-portlet__body m-portlet__body--no-padding">



            </div>
        </div>

    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script src="<?php echo e(url('/')); ?>/assets/admin/app/js/dashboard.js" type="text/javascript"></script>

    <script>

        $('#country-filter .dropdown-item').click(function () {

            var id = $(this).data('id');
            var label = $(this).html();

            $('#dropdownMenuButton').html(`<i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span><?php echo app('translator')->getFromJson('dashboard.plz_wait'); ?></span>`);

            $('#country-filter-div .m-widget1__number').html('0');

            $.get( "<?php echo e(route('ajax.dashboard_statistics')); ?>",{country_id : id}, function( data ) {
                $( "#country-filter-div" ).html( data );
                $('#dropdownMenuButton').html(label);
            });


        })

        $('#all-countries').click();

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'home' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>