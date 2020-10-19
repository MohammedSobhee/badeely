<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator"><?php echo app('translator')->getFromJson('pages.settings'); ?></h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                        <li class="m-nav__item m-nav__item--home">
                            <a href="<?php echo e(route('admin_home')); ?>" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.settings'); ?></span>
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
                                    <h3 class="m-portlet__head-text"><?php echo app('translator')->getFromJson('pages.settings'); ?></h3>
                                </div>
                            </div>
                        </div>


             <form class="m-form validation-form" method="post" action="<?php echo e(route('admin.settings.edit')); ?>" enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>


                            <div class="m-portlet m-portlet--tabs">

                                <div class="m-portlet__head">
                                    <div class="m-portlet__head-tools">
                                        <ul class="prodHeadz nav nav-tabs m-tabs-line m-tabs-line--info m-tabs-line--2x">

                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link active" href="#general-tb"><?php echo app('translator')->getFromJson('pages.general_settings'); ?></a>
                                            </li>

                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link" href="#featured_category-tb"><?php echo app('translator')->getFromJson('pages.featured_category'); ?></a>
                                            </li>

                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link " href="#social-tb"><?php echo app('translator')->getFromJson('pages.social_media_settings'); ?></a>
                                            </li>

                                            <li class="nav-item m-tabs__item">
                                                <a class="nav-link m-tabs__link " href="#app-tb"><?php echo app('translator')->getFromJson('pages.app_url_settings'); ?></a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>

                                <div class="m-portlet__body">

                                    <div class="m-form__section m-form__section--first">

                                        <div class="tab-content prodHeadz">

                                            <div class="tab-pane active" role="tabpanel" id="general-tb">


                                                <div class="form-group m-form__group row">
                                                    <label for="website_name" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.website_name'); ?> :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="website_name" class="form-control m-input" name="website_name" value="<?php echo e($settings->website_name); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="website_description" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.website_description'); ?> :</label>
                                                    <div class="col-10">
                                                        <div class="languages-tabs">

                                                            <div class="tab-content">

                                                                <div class="tab-pane active">

                                                                    <?php if( config('languages') > 1 ): ?>
                                                                        <ul class="nav nav-tabs">
                                                                            <?php $__currentLoopData = config('languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <li class="nav-item m-tabs__item">
                                                                                    <a class="nav-link m-tabs__link <?php echo e($loop->first ? 'active':''); ?>" href="#tb-website_description-lang-<?php echo e($code); ?>" data-toggle="tab"><?php echo e($label); ?></a>
                                                                                </li>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </ul>
                                                                    <?php endif; ?>

                                                                    <div class="tab-content">

                                                                    <?php $__currentLoopData = config('languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <!-- content tab start -->
                                                                            <div class="tab-pane <?php echo e($loop->first ? 'active':''); ?>" id="tb-website_description-lang-<?php echo e($code); ?>">

                                                                                <div class="m-form__section m-form__section--first">
                                                                                    <div class="form-group m-form__group row">
                                                                                        <div class="col-12">
                                                                                            <?php
                                                                                                $name = "website_description_{$code}";
                                                                                            ?>
                                                                                            <textarea name="<?php echo e($name); ?>" id="<?php echo e($name); ?>" class="form-control m-input" cols="30" rows="8"><?php echo e($settings->$name); ?></textarea>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <!-- content tab end -->
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="website_mobile" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.mobile'); ?> :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="website_mobile" class="form-control m-input" name="website_mobile" value="<?php echo e($settings->website_mobile); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="website_email" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.email'); ?> :</label>
                                                    <div class="col-10">
                                                        <input type="email" id="website_email" class="form-control m-input" name="website_email" value="<?php echo e($settings->website_email); ?>">
                                                    </div>
                                                </div>


                                                <div class="form-group m-form__group row">
                                                    <label for="accounts_in_page" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.accounts_in_page'); ?> :</label>
                                                    <div class="col-10">
                                                        <input type="number" id="accounts_in_page" class="form-control m-input" name="accounts_in_page" value="<?php echo e($settings->accounts_in_page); ?>" min="1">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="latest_accounts_last_days" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.latest_accounts_last_days'); ?> :</label>
                                                    <div class="col-10">
                                                        <input type="number" id="latest_accounts_last_days" class="form-control m-input" name="latest_accounts_last_days" value="<?php echo e($settings->latest_accounts_last_days); ?>" min="1">
                                                    </div>
                                                </div>


                                             </div>

                                            <div class="tab-pane" role="tabpanel" id="featured_category-tb">

                                                <div class="form-group m-form__group row">
                                                    <label for="featured_titla" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.featured_title'); ?> :</label>
                                                    <div class="col-10">

                                                        <div class="languages-tabs">

                                                            <div class="tab-content">

                                                                <div class="tab-pane active">

                                                                    <?php if( config('languages') > 1 ): ?>
                                                                        <ul class="nav nav-tabs">
                                                                            <?php $__currentLoopData = config('languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                                <li class="nav-item m-tabs__item">
                                                                                    <a class="nav-link m-tabs__link <?php echo e($loop->first ? 'active':''); ?>" href="#tb-featured_title-lang-<?php echo e($code); ?>" data-toggle="tab"><?php echo e($label); ?></a>
                                                                                </li>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </ul>
                                                                    <?php endif; ?>

                                                                    <div class="tab-content">

                                                                    <?php $__currentLoopData = config('languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <!-- content tab start -->
                                                                            <div class="tab-pane <?php echo e($loop->first ? 'active':''); ?>" id="tb-featured_title-lang-<?php echo e($code); ?>">

                                                                                <div class="m-form__section m-form__section--first">
                                                                                    <div class="form-group m-form__group row">
                                                                                        <div class="col-12">
                                                                                            <?php
                                                                                                $name = "featured_title_{$code}";
                                                                                            ?>
                                                                                            <input type="text" id="<?php echo e($name); ?>" class="form-control m-input" name="<?php echo e($name); ?>" value="<?php echo e($settings->$name); ?>">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <!-- content tab end -->
                                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                                                    </div>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label class="col-2 col-form-label" for="image"><?php echo app('translator')->getFromJson('inputs.featured_img'); ?> :</label>
                                                    <div class="col-10">
                                                        <img src="<?php echo e(url('/')); ?>/assets/featured_img.png?time=<?php echo e(time()); ?>" class="img-responsive" style="max-width:300px;margin-bottom:15px;">

                                                        <input type="file" name="featured_img" class="form-control m-input">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="tab-pane" role="tabpanel" id="social-tb">

                                                <div class="form-group m-form__group row">
                                                    <label for="facebook" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.facebook'); ?> :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="facebook" class="form-control m-input" name="facebook" value="<?php echo e($settings->facebook); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="twitter" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.twitter'); ?> :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="twitter" class="form-control m-input" name="twitter" value="<?php echo e($settings->twitter); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="instagram" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.instagram'); ?> :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="instagram" class="form-control m-input" name="instagram" value="<?php echo e($settings->instagram); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="youtube" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.youtube'); ?> :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="youtube" class="form-control m-input" name="youtube" value="<?php echo e($settings->youtube); ?>">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="tab-pane" role="tabpanel" id="app-tb">

                                                <div class="form-group m-form__group row">
                                                    <label for="google_play" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.google_play'); ?> :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="google_play" class="form-control m-input" name="google_play" value="<?php echo e($settings->google_play); ?>">
                                                    </div>
                                                </div>

                                                <div class="form-group m-form__group row">
                                                    <label for="appstore" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.appstore'); ?> :</label>
                                                    <div class="col-10">
                                                        <input type="text" id="appstore" class="form-control m-input" name="appstore" value="<?php echo e($settings->appstore); ?>">
                                                    </div>
                                                </div>

                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="m-portlet__foot m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions">

                                        <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom"><?php echo app('translator')->getFromJson('dashboard.save'); ?></button>

                                    </div>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'settings' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>