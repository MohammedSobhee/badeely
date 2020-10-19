@extends('layouts.admin',[ 'page'=> 'roles' ])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader ">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.roles')</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <span class="m-nav__link-text">@lang('pages.roles')</span>
                        </li>
                    </ul>
                </div>

                <div class="ml-auto m--align-right">
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                    <span>
                        <i class="la la-plus"></i>
                        <span>@lang('pages.create_role')</span>
                    </span>
                    </a>
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
                                <i class="flaticon-list-1"></i>
                            </span>
                                <h3 class="m-portlet__head-text">@lang('pages.roles')</h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__body">

                    <table class="table table-hover table-responsive" width="100%">
                        <thead class="thead-default">
                        <tr>
                            <th style="width: 10%">#</th>
                            <th>@lang('inputs.name')</th>
                            <th>@lang('inputs.roles')</th>
                            <th style="width: 10%"></th>
                        </tr>
                        </thead>
                        <tbody class="m-datatable__body" style="">
                        @foreach( $roles as $role)
                            <tr>
                                <th scope="row">{{ $role->id }}</th>
                                <td>{{ $role->name }}</td>
                                <td>{{ $role->permissions()->count() }}</td>
                                <td>

                                @if($role->id != 1)

                                        @can('admin.roles.edit')
                                            <a href="{{ route('admin.roles.edit' , [ 'id' => $role->id ] ) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                        @endcan

                                        @can('admin.roles.destroy')
                                            <form style="display: inline-block;" action="{{ route('admin.roles.destroy' , [ 'id' => $role->id ] ) }}" method="post">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="button" id="delete" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                                            </form>
                                        @endcan

                                    @endif


                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection