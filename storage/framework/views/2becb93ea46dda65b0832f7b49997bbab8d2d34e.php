<?php $__env->startSection('content'); ?><div class="m-grid__item m-grid__item--fluid m-wrapper">    <!-- BEGIN: Subheader -->    <div class="m-subheader ">        <div class="d-flex align-items-center">            <div class="mr-auto">                <h3 class="m-subheader__title m-subheader__title--separator"><?php echo app('translator')->getFromJson('pages.countries'); ?></h3>                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">                    <li class="m-nav__item m-nav__item--home">                        <a href="<?php echo e(route('admin_home')); ?>" class="m-nav__link m-nav__link--icon">                           <i class="m-nav__link-icon la la-home"></i>                        </a>                    </li>                    <li class="m-nav__separator">-</li>                    <li class="m-nav__item">                        <a href="<?php echo e(route('admin.countries.index')); ?>" class="m-nav__link">                            <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.countries'); ?></span>                        </a>                    </li>                    <li class="m-nav__separator">-</li>                    <li class="m-nav__item">                        <span class="m-nav__link-text"><?php echo app('translator')->getFromJson('pages.create_country'); ?></span>                    </li>                </ul>            </div>        </div>    </div>    <!-- END: Subheader -->                 <!-- BEGIN: Subheader -->    <div class="m-subheader ">		<div class="row">			<div class="col-lg-12">				<!--begin::Portlet-->				<div class="m-portlet">					<div class="m-portlet__head">						<div class="m-portlet__head-caption">							<div class="m-portlet__head-title">								<span class="m-portlet__head-icon m--hide">								<i class="la la-gear"></i>								</span>								<h3 class="m-portlet__head-text">									<?php echo app('translator')->getFromJson('pages.create_country'); ?>								</h3>							</div>						</div>					</div>					<!--begin::Form-->					<form class="m-form" method="post" action="<?php echo e(route('admin.countries.store')); ?>">						<?php echo e(csrf_field()); ?>						<div class="m-portlet__body">							<div class="m-form__section m-form__section--first">								<div class="form-group m-form__group row">									<label class="col-2 col-form-label" for="name"><?php echo app('translator')->getFromJson('inputs.name'); ?> :</label>									<div class="col-10">										<input type="text" id="name" class="form-control m-input" name="name" value="<?php echo e(old('name')); ?>" required>									</div>								</div>							</div>							<div class="m-form__section m-form__section--first">								<div class="form-group m-form__group row">									<label class="col-2 col-form-label" for="code"><?php echo app('translator')->getFromJson('inputs.code'); ?> :</label>									<div class="col-10">										<input type="text" id="code" class="form-control m-input" name="code" value="<?php echo e(old('code')); ?>" required>									</div>								</div>							</div>							<div class="m-form__section m-form__section--first">								<div class="form-group m-form__group row">									<label class="col-2 col-form-label" for="call_key"><?php echo app('translator')->getFromJson('inputs.call_key'); ?> :</label>									<div class="col-10">										<input type="text" id="call_key" class="form-control m-input" name="call_key" value="<?php echo e(old('call_key')); ?>" required>									</div>								</div>							</div>                            <div class="m-form__section m-form__section--first">								<div class="form-group m-form__group row">									<label for="pageTitle" class="col-2 col-form-label"><?php echo app('translator')->getFromJson('inputs.status'); ?> :</label>									<div class="col-10">										<span class="m-switch m-switch--lg m-switch--info m-switch--icon">												<label>						                        <input type="checkbox" name="is_active" value="1" checked>						                        <span></span>						                        </label>						                    </span>									</div>								</div>							</div>						</div>			            <div class="m-portlet__foot m-portlet__foot--fit">							<div class="m-form__actions m-form__actions">								<button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom"><?php echo app('translator')->getFromJson('dashboard.save'); ?></button>							</div>						</div>					</form>					<!--end::Form-->				</div>				<!--end::Portlet-->			</div>		</div>	</div></div><?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin',[ 'page'=> 'create_country' ], array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>