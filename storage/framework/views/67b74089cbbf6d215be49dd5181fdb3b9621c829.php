<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader ">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator"><?php echo app('translator')->getFromJson('pages.search_history'); ?></h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="<?php echo e(route('admin_home')); ?>" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                           <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.search_history'); ?></span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="m-content">


            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">

                    <table class="table table-hover table-responsive" width="100%">
                        <thead class="thead-default">
                        <tr>
                            <th style="width: 10%">#</th>
                            <th><?php echo app('translator')->getFromJson('inputs.text'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.user'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.ip_address'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.created_at'); ?></th>
                            <th style="width: 10%"></th>
                        </tr>
                        </thead>
                        <tbody class="m-datatable__body" style="">
                            <?php $__currentLoopData = $histories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <th scope="row"><?php echo e($history->id); ?></th>
                                    <td><?php echo e($history->search); ?></td>
                                    <td>
                                        <?php if($history->user): ?>
                                            <a href="<?php echo e(route('admin.users.edit',$history->user_id)); ?>"><?php echo e($history->user->name); ?></a>
                                        <?php else: ?>
                                            <span>-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($history->ip): ?>
                                            <a href="https://www.infobyip.com/ip-<?php echo e($history->ip); ?>.html" target="_blank"><?php echo e($history->ip); ?></a>
                                        <?php else: ?>
                                            <span>-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($history->created_at->format('d/m/Y - h:i A')); ?></td>
                                    <td>

                                        
                                            
                                                
                                                
                                                
                                            
                                        

                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>

                    <?php echo $histories->appends(request()->input())->links(); ?>


                </div>

            </div>

        </div>

    </div>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'search_history' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>