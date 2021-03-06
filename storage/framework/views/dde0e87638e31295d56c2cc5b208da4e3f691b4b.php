<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader ">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator"><?php echo app('translator')->getFromJson('pages.notifications'); ?></h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="<?php echo e(route('admin_home')); ?>" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.notifications'); ?></span>
                        </li>
                    </ul>
                </div>

                <?php if (auth('admins')->user()->hasPermission('admin.notifications.send')): ?>

                    <div class="ml-auto m--align-right">
                        <a href="#" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill"
                           data-toggle="modal" data-target="#send-modal">
                            <span>
                                <i class="la la-send"></i>
                                <span style="padding-right:5px"> <?php echo app('translator')->getFromJson('inputs.send_notification'); ?> </span>
                            </span>
                        </a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="send-modal" tabindex="-1" role="dialog"
                         aria-labelledby="send-modal-label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="send-modal-label"><?php echo app('translator')->getFromJson('inputs.send_notification'); ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form class="m-form validation-form" method="post"
                                      action="<?php echo e(route('admin.notifications.send')); ?>">
                                    <?php echo e(csrf_field()); ?>

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="title"
                                                   class="col-form-label"><?php echo app('translator')->getFromJson('inputs.countries_collection'); ?> :</label>

                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    name="country_id" id="country_id" required>
                                                <option value=""></option>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title"
                                                   class="col-form-label"><?php echo app('translator')->getFromJson('inputs.followers_collection'); ?> :</label>

                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    name="followers_collection" id="followers_collection">
                                                <option value=""><?php echo app('translator')->getFromJson('inputs.all'); ?></option>
                                                
                                                
                                                
                                            </select>
                                        </div>

                                        <div class="form-group actions">
                                            <label for="title"
                                                   class="col-form-label"><?php echo app('translator')->getFromJson('inputs.notification_action_type'); ?>
                                                :</label>

                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    name="action" id="action">
                                                <option value=""></option>
                                                <option value="general"><?php echo app('translator')->getFromJson('inputs.general'); ?></option>
                                                <option value="account"><?php echo app('translator')->getFromJson('inputs.account'); ?></option>
                                                <option value="collection"><?php echo app('translator')->getFromJson('inputs.collection'); ?></option>
                                            </select>
                                        </div>

                                        <div class="form-group actions">
                                            <label for="title"
                                                   class="col-form-label"><?php echo app('translator')->getFromJson('inputs.items'); ?> :</label>

                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    name="action_id" id="action_id">

                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="title" class="col-form-label"><?php echo app('translator')->getFromJson('inputs.title'); ?> :</label>
                                            <input type="text" class="form-control" name="title" id="title" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="content" class="col-form-label"><?php echo app('translator')->getFromJson('inputs.content'); ?>
                                                :</label>
                                            <textarea class="form-control" name="content" id="content" rows="6"
                                                      required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary"><?php echo app('translator')->getFromJson('inputs.send'); ?></button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                <?php endif; ?>

            </div>
        </div>

        <div class="m-content">
            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">

                    <table class="table table-hover table-responsive" width="100%">
                        <thead class="thead-default">
                        <tr>
                            <th style="width: 10%">#</th>
                            <th><?php echo app('translator')->getFromJson('inputs.title'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.content'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.category'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.notification_action_type'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.items'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.created_at'); ?></th>
                            <th style="width: 10%"></th>
                        </tr>
                        </thead>
                        <tbody class="m-datatable__body" style="">


                        <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($notification->id); ?></th>
                                <td><?php echo e($notification->title); ?></td>
                                <td><?php echo e($notification->content); ?></td>
                                <td><?php echo e($notification->category); ?></td>
                                <td><?php echo e(ucfirst($notification->action)); ?></td>
                                <td><?php echo e($notification->action_name); ?></td>
                                <td><?php echo e($notification->created_at->format('d/m/Y - h:i A')); ?></td>
                                <td>

                                    <?php if (auth('admins')->user()->hasPermission('admin.notifications.destroy')): ?>
                                        <form style="display: inline-block;"
                                              action="<?php echo e(route('admin.notifications.destroy' , [ 'id' => $notification->id ] )); ?>"
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

                    <?php echo $notifications->appends(request()->input())->links(); ?>


                </div>

            </div>

        </div>

    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'notifications' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>