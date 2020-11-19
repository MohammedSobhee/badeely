<?php $__env->startSection('styles'); ?>
    <link href="<?php echo e(url('assets/admin/plugin/tagsinput/tagsinput.css')); ?>" rel="stylesheet" type="text/css"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator"><?php echo app('translator')->getFromJson('pages.accounts'); ?></h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                        <li class="m-nav__item m-nav__item--home">
                            <a href="<?php echo e(route('admin_home')); ?>" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <a href="<?php echo e(route('admin.accounts.index')); ?>" class="m-nav__link">
                                <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.accounts'); ?></span>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.create_account'); ?></span>
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
                                    <h3 class="m-portlet__head-text"><?php echo app('translator')->getFromJson('pages.create_account'); ?></h3>
                                </div>
                            </div>
                        </div>


                        <form class="m-form validation-form" method="post" action="<?php echo e(route('admin.accounts.store')); ?>"
                              enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>


                            <div class="m-portlet__body">

                                <div class="languages-tabs">

                                    <?php if( config('languages') > 1 ): ?>
                                        <ul class="nav nav-tabs">
                                            <?php $__currentLoopData = config('languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="nav-item m-tabs__item">
                                                    <a class="nav-link m-tabs__link <?php echo e($loop->first ? 'active':''); ?>"
                                                       href="#tb-lang-<?php echo e($code); ?>" data-toggle="tab"><?php echo e($label); ?></a>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php endif; ?>

                                    <div class="tab-content">

                                    <?php $__currentLoopData = config('languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <!-- content tab start -->
                                            <div class="tab-pane <?php echo e($loop->first ? 'active':''); ?>"
                                                 id="tb-lang-<?php echo e($code); ?>">

                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-2 col-form-label"
                                                               for="account_labels[<?php echo e($code); ?>]"><?php echo app('translator')->getFromJson('inputs.name'); ?>
                                                            :</label>
                                                        <div class="col-10">
                                                            <input type="text" id="account_labels[<?php echo e($code); ?>]"
                                                                   class="form-control m-input"
                                                                   name="account_labels[<?php echo e($code); ?>]"
                                                                   value="<?php echo e(old('store_labels.'.$code)); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="m-form__section m-form__section--first">
                                                    <div class="form-group m-form__group row">
                                                        <label class="col-2 col-form-label"
                                                               for="account_names[<?php echo e($code); ?>]"><?php echo app('translator')->getFromJson('inputs.account_name'); ?>
                                                            :</label>
                                                        <div class="col-10">
                                                            <input type="text" id="account_names[<?php echo e($code); ?>]"
                                                                   class="form-control m-input"
                                                                   name="account_names[<?php echo e($code); ?>]"
                                                                   value="<?php echo e(old('store_labels.'.$code)); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- content tab end -->
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    </div>

                                </div>

                                <div class="m-section__content">
                                    <div class="m-demo" data-code-preview="true" data-code-html="true"
                                         data-code-js="false">
                                        <label class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.gallery'); ?></label>

                                        <div class="m-demo__preview">
                                            <div id="image_preview"
                                                 class="m-stack m-stack--ver m-stack--general m-stack--demo"></div>
                                        </div>

                                        <input type="file" id="upload_file" style="cursor:pointer" class="form-control"
                                               name="images[]" accept="image/*" onchange="preview_image();" multiple/>

                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="mobile"><?php echo app('translator')->getFromJson('inputs.mobile'); ?>:</label>
                                        <div class="col-10">
                                            <input type="text" id="mobile" class="form-control m-input" name="mobile"
                                                   value="<?php echo e(old('mobile')); ?>">
                                        </div>
                                    </div>
                                </div>

                                
                                
                                
                                
                                
                                
                                
                                

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="email"><?php echo app('translator')->getFromJson('inputs.email'); ?> :</label>
                                        <div class="col-10">
                                            <input type="email" id="email" class="form-control m-input" name="email"
                                                   value="<?php echo e(old('email')); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"
                                               for="account_type"><?php echo app('translator')->getFromJson('inputs.account_type'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" id="account_type" class="form-control m-input"
                                                   name="account_type" value="<?php echo e(old('account_type')); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="insta_url"><?php echo app('translator')->getFromJson('inputs.insta_url'); ?>
                                            :</label>
                                        <div class="col-10">
                                            <input type="text" id="insta_url" class="form-control m-input"
                                                   name="insta_url" value="<?php echo e(old('insta_url')); ?>"
                                                   placeholder="http://instagram.com/username">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"
                                               for="facebook_url"><?php echo app('translator')->getFromJson('inputs.facebook_url'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" id="facebook_url" class="form-control m-input"
                                                   name="facebook_url" value="<?php echo e(old('facebook_url')); ?>"
                                                   placeholder="http://facebook.com/username">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="whatsapp"><?php echo app('translator')->getFromJson('inputs.whatsapp'); ?>
                                            :</label>
                                        <div class="col-10">
                                            <input type="text" id="whatsapp" class="form-control m-input"
                                                   name="whatsapp" value="<?php echo e(old('whatsapp')); ?>"
                                                   placeholder="http://whatsapp.com/mobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"
                                               for="website_link"><?php echo app('translator')->getFromJson('inputs.website_link'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" id="website_link" class="form-control m-input"
                                                   name="website_link" value="<?php echo e(old('website_link')); ?>"
                                                   placeholder="http://website.com/link">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"
                                               for="youtube"><?php echo app('translator')->getFromJson('inputs.youtube'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" id="youtube" class="form-control m-input"
                                                   name="youtube" value="<?php echo e(old('youtube')); ?>"
                                                   placeholder="http://youtube.com/link">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="country"><?php echo app('translator')->getFromJson('inputs.country'); ?>
                                            :</label>
                                        <div class="col-10">
                                            <select id="country" name="country"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value=""><?php echo app('translator')->getFromJson('inputs.country'); ?></option>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="categories"><?php echo app('translator')->getFromJson('inputs.category'); ?>
                                            :</label>
                                        <div class="col-10">
                                            <select id="categories" name="categories[]"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    multiple>
                                            </select>
                                            <div class="categories-loader"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"
                                               for="sub_category"><?php echo app('translator')->getFromJson('inputs.sub_category'); ?> :</label>
                                        <div class="col-10">
                                            <select id="sub_category" name="categories[]"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    multiple></select>
                                            <div class="sub_category-loader"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="country"><?php echo app('translator')->getFromJson('inputs.tags'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control m-input" name="tags" id="tags"
                                                   value="<?php echo e(old('tags')); ?>" data-role="tagsinput">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="country"><?php echo app('translator')->getFromJson('inputs.app_tags'); ?>
                                            :</label>
                                        <div class="col-10">
                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    id="app_tags"
                                                    name="app_tags[]" multiple>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.started_at'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" id="m_datepicker_2" class="form-control m-input"
                                                   name="started_at" value="<?php echo e(old('started_at')); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.expire_at'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" id="m_datepicker_1" class="form-control m-input"
                                                   name="expire_at" value="<?php echo e(old('expire_at')); ?>">
                                            <p>Leave blank for unlimited</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="priority"><?php echo app('translator')->getFromJson('inputs.priority'); ?>
                                            :</label>
                                        <div class="col-10">
                                            <input type="number" id="priority" class="form-control m-input"
                                                   name="priority" value="<?php echo e(old('priority')); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label for="pageTitle" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.status'); ?>
                                            :</label>
                                        <div class="col-10">
                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    name="status">
                                                <?php $__currentLoopData = \App\Account::statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($id); ?>" <?php echo e(old('status') == $id ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.'.$status['key']); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label for="pageTitle" class="col-2 col-form-label">Is Featured :</label>
                                        <div class="col-10">
										<span class="m-switch m-switch--lg m-switch--info m-switch--icon">
												<label>
						                        <input type="checkbox" id="is_featured" name="is_featured" value="1">
						                        <span></span>
						                        </label>
						                    </span>
                                        </div>
                                    </div>
                                </div>


                                <div id="featured_between" class="form-group m-form__group row" style="display:none">
                                    <label class="col-form-label col-lg-3 col-sm-12"><?php echo app('translator')->getFromJson('inputs.featured_between'); ?></label>
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                        <div class="input-daterange input-group" id="m_datepicker_5">
                                            <input type="text" class="form-control m-input" name="start"
                                                   placeholder="<?php echo app('translator')->getFromJson('inputs.from'); ?>">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="end"
                                                   placeholder="<?php echo app('translator')->getFromJson('inputs.to'); ?>">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">
                                    <button type="submit"
                                            class="btn btn-accent m-btn m-btn--air m-btn--custom"><?php echo app('translator')->getFromJson('dashboard.save'); ?></button>
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

    <script src="<?php echo e(url('assets/admin/plugin/tagsinput/tagsinput.js')); ?>"></script>


    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script>

$('#tags').tagsinput({
    tagClass: 'label label-default label-slow',
    trimValue: true,
    allowDuplicates: true,
    freeInput: true
});

var tags = $('.bootstrap-tagsinput').find('span').map(function () {
    return $(this).text();
}).get();

$('.bootstrap-tagsinput').sortable({
    update: function () {
        temp = [];
        var $self = $(this);
        tags = $self.find('span').map(function () {
            return $(this).text();
        }).get();
        $self.parent().find('input[class!="ui-sortable-handle"]').val(tags.join(','));

        $('#tags').trigger('keyup');
    }
});
$('#image_preview').sortable();
$(document).ready(function () {

    $(document).on('keyup', '#tags', function () {

        $('#app_tags').html('').trigger("change");
        var myStr = $('#tags').val();
        var strArray = myStr.split(",");
        var options = '';
        // Display array values on page
        for (var i = 0; i < strArray.length; i++) {
            if (strArray[i] == '') continue;
            options += '<option selected>' + strArray[i] + '</option>';
        }

        // console.log(options);
        $('#app_tags').html(options).trigger("change");
        // $('#app_tags').selectpicker();
        $('#app_tags').selectpicker('refresh');
    });
});
    $("#m_datepicker_5").datepicker({
        leftArrow: '<i class="la la-angle-right"></i>',
        rightArrow: '<i class="la la-angle-left"></i>'
    });

    $("#m_datepicker_1").datepicker({
        leftArrow: '<i class="la la-angle-right"></i>',
        rightArrow: '<i class="la la-angle-left"></i>'
    });

    $("#m_datepicker_2").datepicker({
        leftArrow: '<i class="la la-angle-right"></i>',
        rightArrow: '<i class="la la-angle-left"></i>'
    });

    $('#is_featured').change(function () {
        if ($(this).is(':checked')) {
            $('#featured_between').show();
        } else {
            $('#featured_between').hide();
        }
    })

    </script>

    <script>

        var index = 3873;

        function preview_image() {

            var total_file = document.getElementById("upload_file").files.length;
            var files = document.getElementById("upload_file").files;

            for (var i = 0; i < total_file; i++) {
                $('#image_preview').append(`
                    <div id="index` + index + `" class="m-stack__item img-item">
                         <a data-fancybox="gallery" href="` + URL.createObjectURL(event.target.files[i]) + `">
                            <img src="` + URL.createObjectURL(event.target.files[i]) + `" style="width: 100px;height: 100px;">
                         </a>
                         <button type="button" class="btn btn-danger btn-sm remove-img index` + index + `"><?php echo app('translator')->getFromJson('dashboard.remove'); ?></button>
                    </div>
                `);

                if (i == 0) {

                    var x = $("#upload_file"),
                        y = x.clone();

                    y.insertAfter("#index" + index);

                    $("#upload_file").removeAttr('onchange', '');
                    $("#upload_file").attr('id', "file" + index).hide();

                    index++;

                }

            }

            var input = $("#upload_file");
            input.replaceWith(input.val('').clone(true));

        }

        $(document).on('click', '.remove-img', function () {
            $(this).closest('.img-item').remove();
        });

    </script>

    <script>

        $('#country').change(function () {

            var country = $(this).val();
            $('#categories').html('');
            $('#sub_category').html('');
            $('.categories-loader').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span><?php echo app('translator')->getFromJson('dashboard.plz_wait'); ?></span>');

            $.get('<?php echo e(route('ajax.categories')); ?>', {country: country}, function (data) {
                var html = "";
                $.each(data, function (key, value) {
                    html += "<option value='" + value.id + "'>" + value.name + "</option>";
                });

                $('#categories').html(html);
                $('.categories-loader').html('');

                $('.m_form_type').selectpicker('refresh');

            });

        });

        $('#categories').change(function () {

            var categories = $(this).val();
            var country = $('#country').val();
            var old_selected = $('#sub_category').val();

            $('#sub_category').html('');
            $('.sub_category-loader').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span><?php echo app('translator')->getFromJson('dashboard.plz_wait'); ?></span>');

            $.get('<?php echo e(route('ajax.sub_categories')); ?>', {
                categories: categories,
                old_selected: old_selected,
                country: country
            }, function (data) {
                var html = '';
                $.each(data, function (key, value) {
                    var isSelected = value.selected ? 'selected' : '';
                    console.log(isSelected);
                    html += "<option value='" + value.id + "' " + isSelected + ">" + value.name + " - " + value.parent_name + "</option>";
                });

                $('#sub_category').html(html);
                $('.sub_category-loader').html('');

                $('.m_form_type').selectpicker('refresh');

            });

        });

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'create_account' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>