@extends('layouts.admin',[ 'page'=> 'edit_role' ])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.roles') </h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">

                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <a href="{{ route('admin.roles.index') }}" class="m-nav__link">
                                <span class="m-nav__link-text">@lang('pages.roles') </span>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text">@lang('pages.edit_role')</span>
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
                                    <h3 class="m-portlet__head-text">@lang('pages.edit_role')</h3>
                                </div>
                            </div>
                        </div>

                        <form class="m-form validation-form" method="post" action="{{ route('admin.roles.update',[ 'id' => $role->id ]) }}">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="m-portlet__body">

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="name">@lang('inputs.name') :</label>
                                        <div class="col-10">
                                            <input type="text" id="name" class="form-control m-input" name="name" value="{{ $role->name }}" required>
                                        </div>
                                    </div>
                                </div>

                                @foreach($permissions as $group => $permission)

                                    <div class="row">

                                        <div class="col-sm-12"><h4 class="edit-title">@lang('permissions.'.$group)</h4></div>

                                        @foreach($permission as $p)

                                            <div class="col-sm-4">




                                                <div class="prem-edit m-form__group m-radio-inline">
                                                    <label class="m-checkbox remmber-rg">
                                                        <input class="" id="name" name="permissions[]"
                                                               @if($loop->index == 0) data-parsley-mincheck="1" @endif
                                                               type="checkbox" value="admin.{{ $group }}.{{ $p }}" {{ in_array("admin.$group.$p",$rolePermissions) ? 'checked' : ''}}>
                                                        <span></span>
                                                        @lang('permissions.'.$p)
                                                    </label>
                                                </div>


                                            </div>

                                        @endforeach

                                        <div class="col-sm-12"><hr></div>

                                    </div>

                                @endforeach

                            </div>

                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">

                                    <button type="submit" class="btn btn-accent m-btn m-btn--air m-btn--custom">@lang('dashboard.save')</button>

                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection