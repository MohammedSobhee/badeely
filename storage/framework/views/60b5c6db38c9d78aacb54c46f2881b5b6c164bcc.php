<!DOCTYPE html>

<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->isLocale('ar') ? 'rtl' : 'ltr'); ?>">

<head>
    <meta charset="utf-8"/>

    <title> <?php echo e(__('dashboard.dashboard').' | ' . __('pages.'.$page)); ?> </title>

    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta content="<?php echo e(csrf_token()); ?>" name="csrf-token"/>

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo e(assets('favicon/apple-touch-icon.png')); ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(assets('favicon/favicon-32x32.png')); ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(assets('favicon/favicon-16x16.png')); ?>">
    <link rel="manifest" href="<?php echo e(assets('favicon/site.webmanifest')); ?>">
    <link rel="mask-icon" href="<?php echo e(assets('favicon/safari-pinned-tab.svg')); ?>" color="#5bbad5">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- FAVICON -->


    <link href="https://fonts.googleapis.com/css?family=Cairo:200,300,400,600,700,900" rel="stylesheet">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet"/>

    <link href="<?php echo e(url('assets/admin/vendors/base/vendors.bundle.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('assets/admin/demo/default/base/style.bundle.css')); ?>" rel="stylesheet" type="text/css"/>
    <link href="<?php echo e(url('assets/admin/style.css')); ?>" rel="stylesheet" type="text/css"/>

    <?php if(app()->isLocale('ar')): ?>
        <link href="<?php echo e(url('assets/admin/style-rtl.css')); ?>" rel="stylesheet" type="text/css"/>
    <?php endif; ?>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css"/>

    <?php echo $__env->yieldContent('styles'); ?>

    <style type="text/css">
        body.m-aside-left--skin-light .m-header {
            -webkit-box-shadow: 0px 1px 15px 1px rgba(0, 0, 0, 0.1);
            -moz-box-shadow: 0px 1px 15px 1px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 1px 15px 1px rgba(0, 0, 0, 0.1);
        }

        .m-subheader .m-subheader__title.m-subheader__title--separator {
            border-left: 1px solid #e2e5ec;
            border-right: 0;
        }

        .thead-default th {
            background: #f4f4f4;
        }

        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav > .m-menu__item.m-menu__item--expanded > .m-menu__heading, .m-aside-menu.m-aside-menu--skin-light .m-menu__nav > .m-menu__item.m-menu__item--expanded > .m-menu__link,
        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav > .m-menu__item.m-menu__item--expanded > .m-menu__heading:hover, .m-aside-menu.m-aside-menu--skin-light .m-menu__nav > .m-menu__item.m-menu__item--expanded > .m-menu__link:hover {
            background-color: #f9f9f9;
        }

        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav > .m-menu__item .m-menu__submenu .m-menu__item.m-menu__item--active > .m-menu__heading, .m-aside-menu.m-aside-menu--skin-light .m-menu__nav > .m-menu__item .m-menu__submenu .m-menu__item.m-menu__item--active > .m-menu__link {
            background-color: #f9f9f9;
        }

        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav > .m-menu__item .m-menu__submenu .m-menu__item:hover > .m-menu__heading, .m-aside-menu.m-aside-menu--skin-light .m-menu__nav > .m-menu__item .m-menu__submenu .m-menu__item:hover > .m-menu__link {
            background-color: #f9f9f9;
        }

        .m-aside-menu.m-aside-menu--skin-light .m-menu__nav > .m-menu__item:hover > .m-menu__heading, .m-aside-menu.m-aside-menu--skin-light .m-menu__nav > .m-menu__item:hover > .m-menu__link {
            background-color: #f9f9f9;
        }

        .m-portlet .m-portlet__head .m-portlet__head-icon {
            color: #c7c7c7;
        }

        .m-content--skin-light2 .m-body {
            background-color: #f4f4f4;
        }

        body.m-aside-left--skin-dark .m-header .m-header-head {
            box-shadow: none !important;
        }

        @media (min-width: 1200px) {
            .row.m-row--col-separator-xl > div {
                border-bottom: 0;
                border-right: 0;
                border-left: 1px solid #ebedf2;
            }

        }

        .m-list-timeline__items .m-list-timeline__item:first-child:before, .m-list-timeline__items .m-list-timeline__item:last-child:before, .m-list-timeline .m-list-timeline__items:before {
            display: none;
        }

        .languages-tabs {
            margin-bottom: 25px;
            border-bottom: 2px solid #f4f4f4
        }

        .languages-tabs .tab-content {
            margin-bottom: 25px;
        }

        .scrollable-menu {
            height: auto;
            max-height: 200px;
            overflow-x: hidden;
        }
    </style>


    <style>
        .sort {
            cursor: pointer;
        }

        .sort a {
            color: #575962;
            text-decoration: none;
        }

        th.descend:after {
            content: "\25B2";
            margin-left: 5px;
            margin-right: 5px;
        }

        th.ascend:after {
            content: "\25BC";
            margin-left: 5px;
            margin-right: 5px;
        }
    </style>

</head>

<body class="m-page--fluid m--skin- m-content--skin-light2 m-aside-left--skin-light m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">

<div class="m-grid m-grid--hor m-grid--root m-page">

    <header class="m-grid__item m-header" data-minimize-offset="200" data-minimize-mobile-offset="200">
        <div class="m-container m-container--fluid m-container--full-height">
            <div class="m-stack m-stack--ver m-stack--desktop">
                <div class="m-stack__item m-brand  m-brand--skin-light  ">
                    <div class="m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-stack__item--middle m-brand__logo">
                            <a href="<?php echo e(url('admin')); ?>" class="m-brand__logo-wrapper"
                               style="display:-webkit-inline-box">
                                <img alt="" src="<?php echo e(assets('logo.svg')); ?>" style="width:65px"/>
                            </a>
                        </div>

                        <div class="m-stack__item m-stack__item--middle m-brand__tools">

                            <a href="javascript:;" id="m_aside_left_minimize_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
                                <span></span>
                            </a>

                            <a href="javascript:;" id="m_aside_left_offcanvas_toggle"
                               class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                                <span></span>
                            </a>


                            <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;"
                               class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                                <i class="flaticon-more"></i>
                            </a>

                        </div>
                    </div>
                </div>

                <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                    <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general">
                        <div class="m-stack__item m-topbar__nav-wrapper">
                            <ul class="m-topbar__nav m-nav m-nav--inline">

                                <li class="m-nav__item m-nav__item--info m-nav__item--qs">
                                    <div class="dropdown" style="margin-top:15px">
                                        <a href="<?php echo e(route('change_lang')); ?>" class="btn btn-default">
                                            <?php echo e(app()->isLocale('en') ? 'العربية' : 'English'); ?>

                                        </a>
                                    </div>

                                </li>

                                <?php
                                    $count = \App\Account::where('seen',0)->count();
                                    $accounts = \App\Account::where('seen',0)->latest()->limit(5)->get();
                                ?>

                                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                    data-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle"
                                       id="<?php echo e($count ? 'm_topbar_notification_icon':''); ?>">
                                        <?php if( $count ): ?>
                                            <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"
                                                  style="width: 12px;height: 12px;line-height: 12px;margin-left: -7px;top: 6px;"><?php echo e($count); ?></span>
                                        <?php endif; ?>
                                        <span class="m-nav__link-icon "><i class="flaticon-music-2"></i></span>
                                    </a>


                                    <div class="m-dropdown__wrapper">
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center" style="background: #2c2e3e">
                                                <?php if( $count ): ?>
                                                    <span class="m-dropdown__header-title"><?php echo app('translator')->getFromJson('dashboard.there_is_new_request_count',['count'=>$count]); ?> </span>
                                                    <span class="m-dropdown__header-subtitle"></span>
                                                <?php else: ?>
                                                    <span class="m-dropdown__header-title"><?php echo app('translator')->getFromJson('dashboard.no_new_request'); ?></span>
                                                <?php endif; ?>
                                            </div>

                                            <?php if( $count ): ?>

                                                <div class="m-dropdown__body">
                                                    <div class="m-list-timeline m-list-timeline--skin-light">
                                                        <div class="m-list-timeline__items">
                                                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <div class="m-list-timeline__item"
                                                                     style="<?php echo e($account->seen != 1 ? 'font-weight: 700;':''); ?>">
                                                                    <span class="m-list-timeline__text"
                                                                          style="padding:0"><a
                                                                                style="float:right;color:#2c2e3e"
                                                                                href="<?php echo e(route('admin.accounts.edit',$account->id)); ?>"><?php echo e($account->name); ?></a></span>
                                                                    <span class="m-list-timeline__time"><?php echo e($account->created_at->format('d/m/Y h:i A')); ?></span>
                                                                </div>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                            <div class="m-list-timeline__item"
                                                                 style="font-weight:700;border-top: 1px #2d2e3e solid;">
                                                                <a href="<?php echo e(route('admin.accounts.index')); ?>"
                                                                   style="padding:0;color:#2c2e3e;cursor:pointer;text-align: center;"><?php echo app('translator')->getFromJson('dashboard.see_more'); ?></a>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </li>

                                <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light"
                                    data-dropdown-toggle="click">
                                    <a href="#" class="m-nav__link m-dropdown__toggle">
                                        <span class="m-topbar__userpic" style="color: #0082c1;"><i class="flaticon-user"
                                                                                                   style="font-size:2.3rem"></i></span>
                                        <span class="m-topbar__username m--hide"><?php echo e(auth('admins')->user()->name); ?></span>
                                    </a>

                                    <div class="m-dropdown__wrapper">
                                        <div class="m-dropdown__inner">
                                            <div class="m-dropdown__header m--align-center" style="background: #2c2e3e">
                                                <div class="m-card-user m-card-user--skin-dark">
                                                    <div class="m-card-user__details">
                                                        <span class="m-card-user__name m--font-weight-500"><?php echo e(auth('admins')->user()->name); ?></span>
                                                        <a href=""
                                                           class="m-card-user__email m--font-weight-300 m-link"><?php echo e(auth('admins')->user()->role->name); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="m-dropdown__body">
                                                <div class="m-dropdown__content">
                                                    <ul class="m-nav m-nav--skin-light">
                                                        <li class="m-nav__section m--hide">
                                                            <span class="m-nav__section-text"><?php echo app('translator')->getFromJson('pages.categories'); ?></span>
                                                        </li>
                                                        <li class="m-nav__item">
                                                            <a href="<?php echo e(url('admin/profile')); ?>" class="m-nav__link">
                                                                <i class="m-nav__link-icon flaticon-profile-1"></i>
                                                                <span class="m-nav__link-title">
                                                                  <span class="m-nav__link-wrap">
                                                                    <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.profile'); ?></span>
                                                                  </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <li class="m-nav__separator m-nav__separator--fit"></li>
                                                        <li class="m-nav__item">
                                                            <a href="<?php echo e(url('admin/logout')); ?>"
                                                               class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder"><?php echo app('translator')->getFromJson('dashboard.logout'); ?></a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </li>

                            </ul>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </header>

    <div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">


        <?php $sideBar = app('App\Menu'); ?>

        <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn"><i
                    class="la la-close"></i></button>

        <div id="m_aside_left" class="m-grid__item  m-aside-left  m-aside-left--skin-light ">
            <div id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-light m-aside-menu--submenu-skin-light "
                 data-menu-vertical="true" data-menu-scrollable="false" data-menu-dropdown-timeout="500">
                <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">

                    <?php echo e($sideBar->showMenu()); ?>


                </ul>
            </div>
        </div>


        <div class="m-grid__item m-grid__item--fluid m-wrapper">

            <?php if(count($errors)): ?>
                <div class="m-subheader ">
                    <div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="m-alert__text">
                            <ul>
                                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li><?php echo e($error); ?></li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(session()->has('success')): ?>
                <div class="m-subheader ">
                    <div class="m-alert m-alert--outline alert alert-success alert-dismissible fade show" role="alert">
                        <div class="m-alert__text">
                            <?php echo e(session('success')); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if(session()->has('error')): ?>
                <div class="m-subheader ">
                    <div class="m-alert m-alert--outline alert alert-danger alert-dismissible fade show" role="alert">
                        <div class="m-alert__text">
                            <?php echo e(session('error')); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>


            <?php echo $__env->yieldContent('content'); ?>

        </div>

    </div>

</div>


<div class="m-scroll-top m-scroll-top--skin-top" data-toggle="m-scroll-top" data-scroll-offset="500"
     data-scroll-speed="300">
    <i class="la la-arrow-up"></i>
</div>
<script src="<?php echo e(url('/')); ?>/assets/admin/vendors/base/vendors.bundle.js" type="text/javascript"></script>
<script src="<?php echo e(url('/')); ?>/assets/admin/demo/default/base/scripts.bundle.js" type="text/javascript"></script>




<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="<?php echo e(url('assets/admin/vendors/custom/parsley/parsley.min.js')); ?>"></script>

<?php if(app()->isLocale('ar')): ?>
    <script src="<?php echo e(url('assets/admin/vendors/custom/parsley/parsley.ar.js')); ?>"></script>
<?php endif; ?>

<?php echo $__env->yieldContent('scripts'); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>

<script src="<?php echo e(url('assets/js/sorttable.js')); ?>"></script>

<script type="text/javascript">
    var csrf_token = $('meta[name="csrf-token"]').attr('content');

    $(function () {
        $('.m_form_type').selectpicker();
    });

    $('.validation-form').parsley();

    $(document).on('click', '#delete', function () {
        var form = $(this).parent();
        swal({
            title: "<?php echo app('translator')->getFromJson('dashboard.delete_confirmation'); ?>",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "<?php echo app('translator')->getFromJson('dashboard.yes'); ?>",
            cancelButtonText: "<?php echo app('translator')->getFromJson('dashboard.cancel'); ?>",
            closeOnConfirm: false
        }, function () {
            form.submit();
        });
    });

    function readURL(input, target) {

        $(target).show();

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(target).attr('src', e.target.result);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function validFile(file) {
        var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png"]
        if (file.type == "file") {
            var sFileName = file.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                if (!blnValid) {
                    alert("Sorry, File is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    file.value = "";
                    return false;
                }
            }
        }
        return true;

    }

    $(document).on('change', '#action', function () {

        $.ajax({
            url: '<?php echo e(url('admin/items/')); ?>/' + $(this).val(),
            type: 'GET',

            success: function (data) {
                $('#action_id').html(data).trigger("change");
                $('#action_id').selectpicker('refresh');

            }
        })
    });
</script>

<?php echo $__env->yieldPushContent('js'); ?>
</body>
</html>