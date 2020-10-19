@extends('layouts.admin',[ 'page'=> 'countries' ])

@section('content')

<div class="m-grid__item m-grid__item--fluid m-wrapper">
                    
    <!-- BEGIN: Subheader -->
    <div class="m-subheader ">

        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.countries')</h3>
                <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                    <li class="m-nav__item m-nav__item--home">
                        <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                           <i class="m-nav__link-icon la la-home"></i>
                        </a>
                    </li>
                    <li class="m-nav__separator">-</li>
                    <li class="m-nav__item">
                        <a href="" class="m-nav__link">
                            <span class="m-nav__link-text">@lang('pages.countries')</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="ml-auto m--align-right">

                @can('admin.countries.create')
                    <a href="{{ route('admin.countries.create') }}"
                       class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                        <span>
                            <i class="la la-plus"></i>
                            <span>@lang('pages.create_country')</span>
                        </span>

                    </a>
                @endcan

            </div>


        </div>
    </div>
    <!-- END: Subheader -->             

    <div class="m-content">
        

        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="row align-items-center">
                        <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-map-location"></i>
                            </span>
                            <h3 class="m-portlet__head-text">
                                @lang('pages.countries')
                            </h3>
                        </div>
                    </div>
                </div>
                <div class="m-portlet__head-tools">
                  
                </div>
            </div>
            <div class="m-portlet__body">

              

                <table class="table table-hover table-responsive" width="100%">
                    <thead class="thead-default">
                        <tr>
                            <th style="width: 10%">#</th>
                            <th>@lang('inputs.name')</th>
                            <th>@lang('inputs.code')</th>
                            <th>@lang('inputs.call_key')</th>
                            <th>@lang('inputs.status')</th>

                            <th style="width: 20%"></th>
                        </tr>
                    </thead>
                    <tbody class="m-datatable__body" style="">
					@if( $countries )
						@foreach( $countries as $country )
                        <tr>
                            <th scope="row">{{ $country->id }}</th>
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->code }}</td>
                            <td>{{ $country->call_key }}</td>
                            <td>{!! $country->is_active == 1 ? '<span class="m-badge m-badge--success m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-success">'. __('inputs.active') .'</span>' :
                                                                       '<span class="m-badge m-badge--danger m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-danger">'. __('inputs.inactive') .'</span>' !!}</td>

                            <td>
                                @can('admin.countries.edit')

                                    <a href="{{ route('admin.countries.edit',[ 'id' => $country->id ]) }}"
                                       class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"
                                       title="Edit details"> <i class="la la-edit"></i>

                                    </a>

                                @endcan

                                @can('admin.countries.destroy')
                                    <form style="display: inline-block;" action="{{ route('admin.countries.destroy' , [ 'id' => $country->id ] ) }}" method="post">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button type="button" id="delete" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                                    </form>
                                @endcan
                            </td>


                        </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>

            </div>

        </div>   

    </div>
            
</div>

@endsection
 