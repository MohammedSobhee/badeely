<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator"><?php echo app('translator')->getFromJson('pages.users'); ?></h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                        <li class="m-nav__item m-nav__item--home">
                            <a href="<?php echo e(route('admin_home')); ?>" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <a href="<?php echo e(route('admin.users.index')); ?>" class="m-nav__link">
                                <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.users'); ?></span>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.edit_user'); ?></span>
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
                                    <h3 class="m-portlet__head-text"><?php echo app('translator')->getFromJson('pages.edit_user'); ?></h3>
                                </div>
                            </div>
                        </div>

                        <form class="m-form validation-form" method="post" action="<?php echo e(route('admin.users.update',[ 'id' => $user->id ])); ?>">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PATCH')); ?>

                            <div class="m-portlet__body">

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="name"><?php echo app('translator')->getFromJson('inputs.name'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" id="name" class="form-control m-input" name="name" value="<?php echo e($user->name); ?>" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="email"><?php echo app('translator')->getFromJson('inputs.email'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" id="email" class="form-control m-input" name="email" value="<?php echo e($user->email); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="mobile"><?php echo app('translator')->getFromJson('inputs.mobile'); ?> :</label>
                                        <div class="col-10">
                                            <input type="text" id="mobile" class="form-control m-input" name="mobile" value="<?php echo e($user->mobile); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="country"><?php echo app('translator')->getFromJson('inputs.country'); ?> :</label>
                                        <div class="col-10">
                                            <select id="country" name="country" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value=""><?php echo app('translator')->getFromJson('inputs.country'); ?></option>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->id); ?>" <?php echo e($user->country_id ==  $country->id ? 'selected' : ''); ?>><?php echo e($country->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="language"><?php echo app('translator')->getFromJson('inputs.language'); ?> :</label>
                                        <div class="col-10">
                                            <select id="language" name="language" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value="">اللغة</option>
                                                <?php $__currentLoopData = config('languages'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($key); ?>" <?php echo e($user->language ==  $key ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="gender"><?php echo app('translator')->getFromJson('inputs.gender'); ?> :</label>
                                        <div class="col-10">
                                            <select id="gender" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type" name="gender">
                                                <option value=""><?php echo app('translator')->getFromJson('inputs.gender'); ?></option>
                                                <option value="male" <?php echo e($user->gender == 'male' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.male'); ?></option>
                                                <option value="female" <?php echo e($user->gender == 'female' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.female'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="age"><?php echo app('translator')->getFromJson('inputs.age'); ?> :</label>
                                        <div class="col-10">
                                            <select id="age" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type" name="age">
                                                <option value=""><?php echo app('translator')->getFromJson('inputs.age'); ?></option>
                                                <option value="16-24" <?php echo e($user->age == '16-24' ? 'selected' : ''); ?>>16-24</option>
                                                <option value="25-29" <?php echo e($user->age == '25-29' ? 'selected' : ''); ?>>25-29</option>
                                                <option value="30-40" <?php echo e($user->age == '30-40' ? 'selected' : ''); ?>>30-40</option>
                                                <option value="+40" <?php echo e($user->age == '+40' ? 'selected' : ''); ?>>+40</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="password"><?php echo app('translator')->getFromJson('inputs.password'); ?> :</label>
                                        <div class="col-10">
                                            <input type="password" id="password" class="form-control m-input" name="password" data-parsley-minlength="6">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="password_confirmation"><?php echo app('translator')->getFromJson('inputs.password_confirmation'); ?> :</label>
                                        <div class="col-10">
                                            <input type="password" id="password_confirmation" class="form-control m-input" name="password_confirmation" data-parsley-minlength="6" data-parsley-equalto="#password">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label for="pageTitle" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.verified'); ?> :</label>
                                        <div class="col-10">
										<span class="m-switch m-switch--lg m-switch--info m-switch--icon">
												<label>
						                        <input type="checkbox" <?php echo e($user->is_confirmed == 1 ? 'checked="checked"' : ''); ?> name="is_confirmed" value="1">
						                        <span></span>
						                        </label>
						                    </span>
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
<?php echo $__env->make('layouts.admin',[ 'page'=> 'edit_user' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>