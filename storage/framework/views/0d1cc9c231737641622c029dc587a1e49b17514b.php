<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator"><?php echo app('translator')->getFromJson('pages.roles'); ?> </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                        <li class="m-nav__item m-nav__item--home">
                            <a href="<?php echo e(route('admin_home')); ?>" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <a href="<?php echo e(route('admin.roles.index')); ?>" class="m-nav__link">
                                <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.roles'); ?> </span>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.edit_role'); ?></span>
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
                                    <h3 class="m-portlet__head-text"><?php echo app('translator')->getFromJson('pages.edit_role'); ?></h3>
                                </div>
                            </div>
                        </div>

                        <form class="m-form validation-form" method="post" action="<?php echo e(route('admin.roles.update',[ 'id' => $role->id ])); ?>">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PATCH')); ?>


                            <div class="m-portlet__body">

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="name"><?php echo app('translator')->getFromJson('inputs.name'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" id="name" class="form-control m-input" name="name" value="<?php echo e($role->name); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group => $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <div class="row">

                                        <div class="col-sm-12"><h4 class="edit-title"><?php echo app('translator')->getFromJson('permissions.'.$group); ?></h4></div>

                                        <?php $__currentLoopData = $permission; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <div class="col-sm-4">




                                                <div class="prem-edit m-form__group m-radio-inline">
                                                    <label class="m-checkbox remmber-rg">
                                                        <input class="" id="name" name="permissions[]"
                                                               <?php if($loop->index == 0): ?> data-parsley-mincheck="1" <?php endif; ?>
                                                               type="checkbox" value="admin.<?php echo e($group); ?>.<?php echo e($p); ?>" <?php echo e(in_array("admin.$group.$p",$rolePermissions) ? 'checked' : ''); ?>>
                                                        <span></span>
                                                        <?php echo app('translator')->getFromJson('permissions.'.$p); ?>
                                                    </label>
                                                </div>


                                            </div>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <div class="col-sm-12"><hr></div>

                                    </div>

                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>

                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">

                                    <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom"><?php echo app('translator')->getFromJson('dashboard.save'); ?></button>

                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'edit_role' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>