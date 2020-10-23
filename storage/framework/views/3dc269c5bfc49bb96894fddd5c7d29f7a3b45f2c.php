<?php $__env->startSection('content'); ?>

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

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
                            <a href="<?php echo e(route('admin.categories.index')); ?>" class="m-nav__link">
                                <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.categories'); ?></span>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.edit_category'); ?></span>
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
                                    <h3 class="m-portlet__head-text"><?php echo app('translator')->getFromJson('pages.edit_category'); ?></h3>
                                </div>
                            </div>
                        </div>

                        <form class="m-form validation-form" method="post"
                              action="<?php echo e(route('admin.categories.update',[ 'id' => $category->id ])); ?>"
                              enctype="multipart/form-data">
                            <?php echo e(csrf_field()); ?>

                            <?php echo e(method_field('PATCH')); ?>


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
                                                               for="category_labels[<?php echo e($code); ?>]"><?php echo app('translator')->getFromJson('inputs.name'); ?>
                                                            :</label>
                                                        <div class="col-10">
                                                            <input type="text" id="category_labels[<?php echo e($code); ?>]"
                                                                   class="form-control m-input"
                                                                   name="category_labels[<?php echo e($code); ?>]"
                                                                   value="<?php echo e($category->name($code)); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <!-- content tab end -->
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                    </div>

                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="parent_id"><?php echo app('translator')->getFromJson('inputs.parent'); ?>
                                            :</label>
                                        <div class="col-10">
                                            <select id="parent_id" name="parent_id"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value="0"><?php echo app('translator')->getFromJson('inputs.without'); ?></option>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($cat->id); ?>" <?php echo e($cat->id == $category->parent_id ? 'selected' : ''); ?>><?php echo e($cat->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label for="countries" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.countries'); ?>
                                            :</label>
                                        <div class="col-10">
                                            <select id="countries" name="countries[]"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    multiple>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($country->id); ?>" <?php echo e(in_array($country->id,$categoryCountry) ? 'selected' : ''); ?>><?php echo e($country->name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label for="pageTitle" class="col-2 col-form-label">Active :</label>
                                        <div class="col-10">
										<span class="m-switch m-switch--lg m-switch--info m-switch--icon">
												<label>
						                        <input type="checkbox" id="status" name="status"
                                                       value="1"
                                                <?php echo e($category->status ? 'checked' : ''); ?>>
						                        <span></span>
						                        </label>
						                    </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="image"><?php echo app('translator')->getFromJson('inputs.image'); ?> :</label>
                                        <div class="col-10">
                                            <img id="upload-pic" src="<?php echo e($category->image()); ?>" class="img-responsive"
                                                 width="500">
                                            <input type="file" id="file-upload" name="image"
                                                   class="form-control m-input">
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

    <script>
        $("#file-upload").on('change', function () {
            if (validFile(this)) {
                readURL(this, '#upload-pic');
            }
        });
    </script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'edit_category' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>