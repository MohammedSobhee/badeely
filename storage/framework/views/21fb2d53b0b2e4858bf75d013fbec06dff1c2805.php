<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader ">

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
                            <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.users'); ?></span>
                        </li>
                    </ul>
                </div>

                <?php if (auth('admins')->user()->hasPermission('admin.users.create')): ?>

                    <div class="ml-auto m--align-right">
                        <a href="<?php echo e(route('admin.users.create')); ?>"
                           class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                        <span>
                            <i class="la la-plus"></i>
                            <span><?php echo app('translator')->getFromJson('pages.create_user'); ?></span>
                        </span>
                        </a>
                    </div>

                <?php endif; ?>

            </div>
        </div>

        <div class="m-content">


            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="row align-items-center">
                            <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-users"></i>
                            </span>
                                <h3 class="m-portlet__head-text"><?php echo app('translator')->getFromJson('pages.users'); ?></h3>
                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="<?php echo e(request()->fullUrlWithQuery(['export' => true ])); ?>"
                                   data-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                   title="" data-original-title="Export"><i class="fa fa-cloud-download"></i></a>
                            </li>
                        </ul>
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
                                            <input type="text" name="name" value="<?php echo e(request('name')); ?>"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label><?php echo app('translator')->getFromJson('inputs.email'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" name="email" value="<?php echo e(request('email')); ?>"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label class="m-label m-label--single"><?php echo app('translator')->getFromJson('inputs.gender'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                name="gender">
                                            <option value=""><?php echo app('translator')->getFromJson('inputs.all'); ?></option>
                                            <option value="male" <?php echo e(request('gender') == 'male' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.male'); ?></option>
                                            <option value="female" <?php echo e(request('gender') == 'female' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.female'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label class="m-label m-label--single"><?php echo app('translator')->getFromJson('inputs.age'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                name="age">
                                            <option value=""><?php echo app('translator')->getFromJson('inputs.all'); ?></option>
                                            <option value="under_15" <?php echo e(request('age') == 'under_15' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.under_15'); ?></option>
                                            <option value="15-25" <?php echo e(request('age') == '15-25' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.15-25'); ?></option>
                                            <option value="25-40" <?php echo e(request('age') == '25-40' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.25-40'); ?></option>
                                            <option value="40-60" <?php echo e(request('age') == '40-60' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.40-60'); ?></option>
                                            <option value="over_60" <?php echo e(request('age') == 'over_60' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.over_60'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label class="m-label m-label--single"><?php echo app('translator')->getFromJson('inputs.register_by'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                name="register_by">
                                            <option value=""><?php echo app('translator')->getFromJson('inputs.all'); ?></option>
                                            <option value="facebook" <?php echo e(request('register_by') == 'facebook' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.facebook'); ?></option>
                                            <option value="normal" <?php echo e(request('register_by') == 'normal' ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.normal'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label><?php echo app('translator')->getFromJson('inputs.country'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <select id="country" name="country"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
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

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label class="m-label m-label--single"><?php echo app('translator')->getFromJson('inputs.verified'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                name="is_confirmed">
                                            <option value=""><?php echo app('translator')->getFromJson('inputs.all'); ?></option>
                                            <option value="1" <?php echo e(request('is_confirmed') == 1 ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.verified'); ?></option>
                                            <option value="2" <?php echo e(request('is_confirmed') == 2 ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.not_verified'); ?></option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <br/>
                                <button type="submit"
                                        class="btn btn-warning m-btn--wide"><?php echo app('translator')->getFromJson('dashboard.show_result'); ?></button>
                                <a href="<?php echo e(route('admin.users.index')); ?>"
                                   class="btn btn-info m-btn--wide"><?php echo app('translator')->getFromJson('dashboard.show_all'); ?></a>
                            </div>

                            <hr>
                        </form>

                    </div>

                    <table class="table table-hover table-responsive sortable" id="users_tbl" width="100%">
                        <thead class="thead-default">
                        <tr>
                            <th style="width: 10%">#</th>
                            <th><?php echo app('translator')->getFromJson('inputs.name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.email'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.mobile'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.gender'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.age'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.register_by'); ?></th>

                            <th><?php echo app('translator')->getFromJson('inputs.follow'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.rate'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.clicks'); ?></th>

                            <th><?php echo app('translator')->getFromJson('inputs.country'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.verified'); ?></th>
                            <th style="width: 10%"><?php echo app('translator')->getFromJson('inputs.action'); ?></th>
                        </tr>
                        </thead>
                        <tbody class="m-datatable__body" style="">
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($user->id); ?></th>
                                <td><?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php echo e($user->mobile); ?></td>
                                <td>
                                    <?php if($user->gender): ?>
                                        <?php echo app('translator')->getFromJson('inputs.'.$user->gender); ?>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php echo e($user->age); ?>

                                </td>
                                <td>
                                    <?php if($user->register_by == 'facebook'): ?>
                                        <span style="color:#3c5898"><?php echo app('translator')->getFromJson('inputs.facebook'); ?></span>
                                    <?php elseif($user->register_by == 'normal'): ?>
                                        <span style="color:#13a085;"><?php echo app('translator')->getFromJson('inputs.normal'); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($user->follows()->count()); ?></td>
                                <td><?php echo e($user->upVotes()->count()); ?></td>
                                <td><?php echo e($user->views()->count()); ?></td>

                                <td><?php echo e($user->country->name ?? '-'); ?></td>
                                <td><?php echo $user->is_confirmed == 1 ? '<span class="m-badge m-badge--success m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-success">'. __('inputs.verified') .'</span>' :
                                               '<span class="m-badge m-badge--danger m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-danger">'. __('inputs.not_verified') .'</span>'; ?></td>
                                <td>

                                    <?php if (auth('admins')->user()->hasPermission('admin.users.edit')): ?>
                                        <a href="<?php echo e(route('admin.users.edit' , [ 'id' => $user->id ] )); ?>"
                                           class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i
                                                    class="la la-edit"></i></a>
                                    <?php endif; ?>

                                    <?php if (auth('admins')->user()->hasPermission('admin.users.destroy')): ?>
                                        <form style="display: inline-block;"
                                              action="<?php echo e(route('admin.users.destroy' , [ 'id' => $user->id ] )); ?>"
                                              method="post">
                                            <?php echo e(csrf_field()); ?>

                                            <?php echo e(method_field('DELETE')); ?>

                                            <button type="button" id="delete"
                                                    class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
                                                <i class="la la-trash"></i></button>
                                        </form>
                                    <?php endif; ?>

                                </td>

                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table>

                    

                </div>

            </div>

        </div>

    </div>

    <?php $__env->startPush('js'); ?>
        
        

        <script>






























































</script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'users' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>