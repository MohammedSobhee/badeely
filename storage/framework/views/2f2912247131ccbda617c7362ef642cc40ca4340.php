<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader ">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator"><?php echo app('translator')->getFromJson('pages.categories'); ?></h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="<?php echo e(route('admin_home')); ?>" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                           <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.categories'); ?></span>
                        </li>
                    </ul>
                </div>

                <div class="ml-auto m--align-right">
                    <a href="<?php echo e(route('admin.categories.create')); ?>" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                    <span>
                        <i class="la la-plus"></i>
                        <span><?php echo app('translator')->getFromJson('pages.create_category'); ?></span>
                    </span>
                    </a>
                </div>
            </div>
        </div>

        <div class="m-content">


            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="row align-items-center">
                            <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-list-3"></i>
                            </span>
                                <h3 class="m-portlet__head-text"><?php echo app('translator')->getFromJson('pages.categories'); ?></h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <div class="collapse show" id="collapseExample">

                        <form class="form-group m-form__group row align-items-center">

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label><?php echo app('translator')->getFromJson('inputs.name'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" name="name" value="<?php echo e(request('name')); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label><?php echo app('translator')->getFromJson('inputs.country'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <select id="country" name="country" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value=""><?php echo app('translator')->getFromJson('inputs.all'); ?></option>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->id); ?>" <?php echo e($country->id == request('country') ? 'selected' : ''); ?>><?php echo e($country->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-6">
                                <br />
                                <button type="submit" class="btn btn-warning m-btn--wide"><?php echo app('translator')->getFromJson('dashboard.show_result'); ?></button>
                                <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-info m-btn--wide"><?php echo app('translator')->getFromJson('dashboard.show_all'); ?></a>
                            </div>

                            <hr>
                        </form>

                    </div>

                    <div id="accordion" class="limited_drop_targets">

                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="card" data-id="<?php echo e($category->id); ?>" style="margin-bottom:20px">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#collapse<?php echo e($category->id); ?>">

                                        <div class="pull-<?php echo e(app()->isLocale('ar') ? 'right' : 'left'); ?>">
                                            <img src="<?php echo e($category->image()); ?>" style="border-radius:50%;width:40px;height:40px;margin-right:8px;margin-left:8px;">
                                            <span><?php echo e($category->name); ?></span>
                                        </div>

                                        <div class="pull-<?php echo e(app()->isLocale('ar') ? 'left' : 'right'); ?>">

                                            <div class="card-loading" style="display:none"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></div>

                                            <?php if (auth('admins')->user()->hasPermission('admin.categories.create')): ?>
                                                <a href="<?php echo e(route('admin.categories.create')); ?>?cat_id=<?php echo e($category->id); ?>"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-plus-square-o"></i></a>
                                            <?php endif; ?>

                                            <?php if (auth('admins')->user()->hasPermission('admin.categories.edit')): ?>
                                                <a href="<?php echo e(route('admin.categories.edit' , [ 'id' => $category->id ] )); ?>"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                            <?php endif; ?>

                                            <?php if (auth('admins')->user()->hasPermission('admin.categories.destroy')): ?>
                                                <form style="display: inline-block;" action="<?php echo e(route('admin.categories.destroy' , [ 'id' => $category->id ] )); ?>" method="post">
                                                    <?php echo e(csrf_field()); ?>

                                                    <?php echo e(method_field('DELETE')); ?>

                                                    <button type="button" id="delete"
                                                            class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                                                </form>
                                            <?php endif; ?>


                                        </div>
                                    </a>
                                </div>

                                <div id="collapse<?php echo e($category->id); ?>" class="collapse <?php echo e($loop->first ? 'show' : ''); ?>" data-parent="#accordion">
                                    <div class="card-body">

                                        <?php if($category->children->isNotEmpty()): ?>
                                            <table class="table table-hover table-responsive" width="100%">
                                                <tbody class="m-datatable__body" style="">
                                                    <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td><img style="width: 80px;" src="<?php echo e($category->image()); ?>"></td>
                                                            <td><?php echo e($category->name); ?></td>
                                                            <td>
                                                                <?php if (auth('admins')->user()->hasPermission('admin.categories.edit')): ?>
                                                                    <a href="<?php echo e(route('admin.categories.edit' , [ 'id' => $category->id ] )); ?>" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                                                <?php endif; ?>
                                                                <?php if (auth('admins')->user()->hasPermission('admin.categories.destroy')): ?>
                                                                    <form style="display: inline-block;" action="<?php echo e(route('admin.categories.destroy' , [ 'id' => $category->id ] )); ?>" method="post">
                                                                        <?php echo e(csrf_field()); ?>

                                                                        <?php echo e(method_field('DELETE')); ?>

                                                                        <button type="button" id="delete" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                                                                    </form>
                                                                <?php endif; ?>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        <?php else: ?>
                                            <div class="alert alert-info"> <?php echo app('translator')->getFromJson('dashboard.there_is_no_sub_category'); ?> </div>
                                        <?php endif; ?>

                                    </div>
                                </div>


                    </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </div>


                </div>

            </div>

        </div>

    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $( function() {

            $( "#accordion" ).sortable({
                stop: function(event, ui) {

                    var loader = $(ui.item).find('.card-loading');
                    var items_sort = '';

                    loader.css('display','inline-block');

                    $("#accordion .card").each(function(){
                        items_sort += $(this).data('id');
                        items_sort += ',';
                    });

                    $.get('<?php echo e(route('admin.categories.index')); ?>?items_sort='+items_sort, function(data){
                        loader.fadeOut();
                    });

                }
            }).disableSelection();

        } );
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'categories' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>