<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator"><?php echo app('translator')->getFromJson('pages.administrators'); ?></h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                        <li class="m-nav__item m-nav__item--home">
                            <a href="<?php echo e(route('admin_home')); ?>" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <a href="<?php echo e(route('admin.administrators.index')); ?>" class="m-nav__link">
                                <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.administrators'); ?></span>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.create_administrator'); ?></span>
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
                                    <h3 class="m-portlet__head-text"><?php echo app('translator')->getFromJson('pages.create_administrator'); ?></h3>
                                </div>
                            </div>
                        </div>

                        <form class="m-form validation-form" method="post" action="<?php echo e(route('admin.administrators.store')); ?>">
                            <?php echo e(csrf_field()); ?>


                            <div class="m-portlet__body">

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="name"><?php echo app('translator')->getFromJson('inputs.role'); ?> :</label>
                                        <div class="col-10">
                                            <select name="role_id" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type" required>
                                                <?php $__currentLoopData = \App\Role::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php echo e(old('role') == $role->id ? 'selected' : ''); ?> value="<?php echo e($role->id); ?>"><?php echo e($role->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="name"><?php echo app('translator')->getFromJson('inputs.name'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" id="name" class="form-control m-input" name="name" value="<?php echo e(old('name')); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="email"><?php echo app('translator')->getFromJson('inputs.email'); ?> :</label>
                                        <div class="col-10">
                                            <input type="email" id="email" class="form-control m-input" name="email" value="<?php echo e(old('email')); ?>" required>
                                        </div>
                                    </div>
                                </div>


                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="password"><?php echo app('translator')->getFromJson('inputs.password'); ?> :</label>
                                        <div class="col-10">
                                            <input type="password" id="password" class="form-control m-input" name="password" data-parsley-minlength="6" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="password_confirmation"><?php echo app('translator')->getFromJson('inputs.password_confirmation'); ?> :</label>
                                        <div class="col-10">
                                            <input type="password" id="password_confirmation" class="form-control m-input" name="password_confirmation" data-parsley-minlength="6" data-parsley-equalto="#password" required>
                                        </div>
                                    </div>
                                </div>


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
<?php echo $__env->make('layouts.admin',[ 'page' => 'create_administrator' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>