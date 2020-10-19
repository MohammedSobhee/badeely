<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">



        <div class="m-subheader ">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator"><?php echo app('translator')->getFromJson('pages.vote_report'); ?></h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="<?php echo e(route('admin_home')); ?>" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.vote_report'); ?></span>
                        </li>
                    </ul>
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

                                <i class="flaticon-line-graph"></i>

                            </span>

                                <h3 class="m-portlet__head-text"><?php echo app('translator')->getFromJson('pages.vote_report'); ?></h3>

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
                                        <label><?php echo app('translator')->getFromJson('inputs.from_date'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" class="form-control" id="from" readonly="" name="from" value="<?php echo e(request('from')); ?>" placeholder="<?php echo app('translator')->getFromJson('inputs.from_date'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label><?php echo app('translator')->getFromJson('inputs.to_date'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" class="form-control" id="to" readonly="" name="to" value="<?php echo e(request('to')); ?>" placeholder="<?php echo app('translator')->getFromJson('inputs.to_date'); ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>
                            <div class="col-md-2">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label><?php echo app('translator')->getFromJson('inputs.country'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <select id="country_id" name="country_id"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value=""><?php echo app('translator')->getFromJson('inputs.all'); ?></option>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->id); ?>" <?php if(request('country_id') == $country->id): ?> selected <?php endif; ?>><?php echo e($country->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>
                            <div class="col-md-4">
                                <br />
                                <button type="submit" class="btn btn-warning m-btn--wide"><?php echo app('translator')->getFromJson('dashboard.show_result'); ?></button>
                                <a href="<?php echo e(route('admin.reports.vote_report')); ?>" class="btn btn-info m-btn--wide"><?php echo app('translator')->getFromJson('dashboard.show_all'); ?></a>
                            </div>

                            <hr>
                        </form>

                    </div>


                    <table class="table table-hover table-responsive sortable" width="100%">

                        <thead class="thead-default">

                        <tr>

                            <th><?php echo app('translator')->getFromJson('inputs.name'); ?></th>

                            <th><?php echo app('translator')->getFromJson('inputs.votes'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.country'); ?></th>

                            <th><?php echo app('translator')->getFromJson('inputs.percentage'); ?></th>

                        </tr>

                        </thead>

                        <tbody class="m-datatable__body" style="">



                        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr>

                                <td><?php echo e($account->name); ?></td>

                                <td><?php echo e($account->votes()->betweenDate()->count()); ?></td>
                                <td><?php echo e($account->country->name ?? ''); ?></td>

                                <td>
                                    <?php if($count): ?>
                                        <?php echo e((float) number_format( ($account->votes()->betweenDate()->count() / $count) * 100 , 2 , '.' , '' )); ?>%
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </td>

                            </tr>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



                        </tbody>

                    </table>

                    <?php echo $accounts->appends(request()->input())->links(); ?>



                </div>



            </div>



        </div>



    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script>
        $('#from, #to').datepicker({
            orientation: "bottom right",
            format : "yyyy-mm-dd",
            templates: {
                leftArrow: '<i class="la la-angle-left"></i>',
                rightArrow: '<i class="la la-angle-right"></i>'
            }
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'vote_report' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>