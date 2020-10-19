<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader ">

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
                            <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.accounts'); ?></span>
                        </li>
                    </ul>
                </div>

                <?php if (auth('admins')->user()->hasPermission('admin.accounts.create')): ?>

                    <div class="ml-auto m--align-right">
                        <a href="<?php echo e(route('admin.accounts.create')); ?>" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                        <span>
                            <i class="la la-plus"></i>
                            <span><?php echo app('translator')->getFromJson('pages.create_account'); ?></span>
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
                                <i class="flaticon-cart"></i>
                            </span>
                                <h3 class="m-portlet__head-text"><?php echo app('translator')->getFromJson('pages.accounts'); ?></h3>
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

                            <div class="col-md-2">
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

                            <div class="col-md-2">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label><?php echo app('translator')->getFromJson('inputs.mobile'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" name="mobile" value="<?php echo e(request('mobile')); ?>" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-2">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label><?php echo app('translator')->getFromJson('inputs.tags'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" name="tags" value="<?php echo e(request('tags')); ?>" class="form-control">
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

                            <div class="col-md-2">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label><?php echo app('translator')->getFromJson('inputs.category'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <select id="category" name="category" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value=""><?php echo app('translator')->getFromJson('inputs.all'); ?></option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($category->id); ?>" <?php echo e($category->id == request('category') ? 'selected' : ''); ?>><?php echo e($category->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                            <div class="category-loader"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-2">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label><?php echo app('translator')->getFromJson('inputs.filter'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <select id="filters" name="filters" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value=""><?php echo app('translator')->getFromJson('inputs.all'); ?></option>
                                                <option value="is_featured" <?php echo e(request('filters') == 'is_featured' ? 'selected' : ''); ?>>Featured</option>
                                                <option value="rate" <?php echo e(request('filters') == 'rate' ? 'selected' : ''); ?>>UpVotes</option>
                                                <option value="clicks" <?php echo e(request('filters') == 'clicks' ? 'selected' : ''); ?>>Clicks</option>
                                                <option value="instagram_clicks" <?php echo e(request('filters') == 'instagram_clicks' ? 'selected' : ''); ?>>Instagram Clicks</option>
                                                <option value="id" <?php echo e(request('filters') == 'id' ? 'selected' : ''); ?>>New</option>
                                                <option value="priority" <?php echo e(request('filters') == 'priority' ? 'selected' : ''); ?>>Priority</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label class="m-label m-label--single"><?php echo app('translator')->getFromJson('inputs.status'); ?> :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type" name="status">
                                            <option value=""><?php echo app('translator')->getFromJson('inputs.all'); ?></option>
                                            <?php $__currentLoopData = \App\Account::statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($id); ?>" <?php echo e(request('status') == $id ? 'selected' : ''); ?>><?php echo app('translator')->getFromJson('inputs.'.$status['key']); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <br />
                                <button type="submit" class="btn btn-warning m-btn--wide"><?php echo app('translator')->getFromJson('dashboard.show_result'); ?></button>
                                <a href="<?php echo e(route('admin.accounts.index')); ?>" class="btn btn-info m-btn--wide"><?php echo app('translator')->getFromJson('dashboard.show_all'); ?></a>
                            </div>

                            <hr>
                        </form>

                    </div>

                    <table class="table table-hover table-responsive" width="100%">
                        <thead class="thead-default">
                        <tr>
                            <th style="width: 5%">#</th>
                            <th><?php echo app('translator')->getFromJson('inputs.account_name'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.user'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.category'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.rate'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.clicks'); ?></th>

                            <th><?php echo app('translator')->getFromJson('inputs.filters'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.remaining_days'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.priority'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.live_at'); ?></th>
                            <th><?php echo app('translator')->getFromJson('inputs.status'); ?></th>
                            <th style="width: 10%"></th>
                        </tr>
                        </thead>
                        <tbody class="m-datatable__body" style="">
                            <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr style="<?php echo e($account->seen != 1 ? 'font-weight:700;':''); ?>">
                                    <th scope="row"><?php echo e($account->id); ?></th>
                                    <td><?php echo e($account->description); ?></td>
                                    <td>
                                        <?php if($account->user): ?>
                                            <a href="<?php echo e(route('admin.users.edit',$account->user->id)); ?>"><?php echo e($account->user->name); ?></a>
                                        <?php else: ?>
                                            <span><?php echo app('translator')->getFromJson('inputs.admin'); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php $__currentLoopData = $account->categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="m-badge m-badge--warning m-badge--wide"><?php echo e($category->name); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </td>
                                    <td><?php echo e($account->rate); ?></td>
                                    <td><?php echo e($account->views); ?></td>

                                    <td>
                                        <?php if($account->isFeature()): ?>
                                            <span class="m-badge m-badge--warning m-badge--wide">Featured</span>
                                        <?php else: ?>

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php echo $__env->make('admin.accounts.remaining_days', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                                    </td>
                                    <td>
                                        <label class="priority-label" style="cursor:pointer;"><b><?php echo e($account->priority); ?></b></label>
                                        <div class="control-btn" style="display:none">
                                            <input type="number" class="form-control priority-input" data-id="<?php echo e($account->id); ?>" value="<?php echo e($account->priority); ?>">
                                            <a href="#"
                                               style="width:30px;height:30px;margin-top:4px;margin-left:3px;margin-right:3px"
                                               class="btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only priority-save"><i class="la la-save"></i></a>
                                        </div>
                                    </td>
                                    <td><?php echo e(date( 'd/m/Y - g:i A' , strtotime($account->created_at) )); ?></td>
                                    <td>
                                        <?php if(isset(\App\Account::statuses[$account->status])): ?>
                                            <span class="m-badge m-badge--<?php echo e(\App\Account::statuses[$account->status]['color']); ?> m-badge--wide">
                                                <?php echo app('translator')->getFromJson('inputs.'.\App\Account::statuses[$account->status]['key']); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <td>

                                        <?php if (auth('admins')->user()->hasPermission('admin.accounts.edit')): ?>
                                            <a href="<?php echo e(route('admin.accounts.edit' , [ 'id' => $account->id ] )); ?>"
                                               class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                        <?php endif; ?>

                                        <?php if (auth('admins')->user()->hasPermission('admin.accounts.destroy')): ?>
                                            <form style="display: inline-block;" action="<?php echo e(route('admin.accounts.destroy' , [ 'id' => $account->id ] )); ?>" method="post">
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

                    <?php echo $accounts->appends(request()->input())->links(); ?>


                </div>

            </div>

        </div>

    </div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

    <script>

        $('.priority-label').dblclick(function () {

            $('.control-btn').hide();
            $('.priority-label').show();

            var parent = $(this).parent();
            $(this).hide();
            parent.find('.control-btn').css('display','inline-flex');

        });

        $('.priority-save').click(function (e) {
            e.preventDefault();

            var parent = $(this).parent().parent();
            var btn = $(this);
            var id = parent.find('.priority-input').data('id');
            var priority = parent.find('.priority-input').val();

            if(!priority){
                priority = 0;
            }

            btn.html('<i class="fa fa-spinner fa-spin fa-1x fa-fw" style="margin-left:-10px;margin-right:-10px"></i>');

            $.get('<?php echo e(route('admin.accounts.index')); ?>?priority='+priority+'&id='+id, function(data){

                parent.find('.control-btn').hide();
                parent.find('.priority-label').show();
                parent.find('.priority-label b').text(priority);
                parent.find('.priority-input').val(priority);

                btn.html('<i class="la la-save"></i>');
            });

        });

        $('#country').change(function () {

            var country = $(this).val();
            $('#category').html('');
            $('.category-loader').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span><?php echo app('translator')->getFromJson('dashboard.plz_wait'); ?></span>');

            $.get( '<?php echo e(route('ajax.categories')); ?>', { country : country } ,function( data ) {
                var html = "";
                $.each( data, function( key, value ) {
                    html += "<option value='"+ value.id +"'>"+ value.name +"</option>";
                });

                $('#category').html(html);
                $('.category-loader').html('');

                $('.m_form_type').selectpicker('refresh');

            });

        });


        

            

            
            

            
                
                
                    
                

                
                

                

            

        

    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'accounts' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>