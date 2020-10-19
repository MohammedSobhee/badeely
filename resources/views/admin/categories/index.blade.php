@extends('layouts.admin',[ 'page'=> 'categories' ])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader ">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.categories')</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                           <span class="m-nav__link-text">@lang('pages.categories')</span>
                        </li>
                    </ul>
                </div>

                <div class="ml-auto m--align-right">
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                    <span>
                        <i class="la la-plus"></i>
                        <span>@lang('pages.create_category')</span>
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
                                <i class="flaticon-list-3"></i>
                            </span>
                                <h3 class="m-portlet__head-text">@lang('pages.categories')</h3>
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
                                        <label>@lang('inputs.name') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" name="name" value="{{ request('name') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label>@lang('inputs.country') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <select id="country" name="country" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value="">@lang('inputs.all')</option>
                                                @foreach( $countries as $country )
                                                    <option value="{{ $country->id }}" {{ $country->id == request('country') ? 'selected' : '' }}>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-6">
                                <br />
                                <button type="submit" class="btn btn-warning m-btn--wide">@lang('dashboard.show_result')</button>
                                <a href="{{ route('admin.categories.index') }}" class="btn btn-info m-btn--wide">@lang('dashboard.show_all')</a>
                            </div>

                            <hr>
                        </form>

                    </div>

                    <div id="accordion" class="limited_drop_targets">

                        @foreach( $categories as $category )

                            <div class="card" data-id="{{ $category->id }}" style="margin-bottom:20px">
                                <div class="card-header">
                                    <a class="card-link" data-toggle="collapse" href="#collapse{{ $category->id }}">

                                        <div class="pull-{{ app()->isLocale('ar') ? 'right' : 'left'}}">
                                            <img src="{{ $category->image() }}" style="border-radius:50%;width:40px;height:40px;margin-right:8px;margin-left:8px;">
                                            <span>{{ $category->name }}</span>
                                        </div>

                                        <div class="pull-{{ app()->isLocale('ar') ? 'left' : 'right'}}">

                                            <div class="card-loading" style="display:none"><i class="fa fa-spinner fa-spin fa-1x fa-fw"></i></div>

                                            @can('admin.categories.create')
                                                <a href="{{ route('admin.categories.create') }}?cat_id={{ $category->id }}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-warning m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-plus-square-o"></i></a>
                                            @endcan

                                            @can('admin.categories.edit')
                                                <a href="{{ route('admin.categories.edit' , [ 'id' => $category->id ] ) }}"
                                                   class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                            @endcan

                                            @can('admin.categories.destroy')
                                                <form style="display: inline-block;" action="{{ route('admin.categories.destroy' , [ 'id' => $category->id ] ) }}" method="post">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}
                                                    <button type="button" id="delete"
                                                            class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                                                </form>
                                            @endcan


                                        </div>
                                    </a>
                                </div>

                                <div id="collapse{{ $category->id }}" class="collapse {{ $loop->first ? 'show' : '' }}" data-parent="#accordion">
                                    <div class="card-body">

                                        @if($category->children->isNotEmpty())
                                            <table class="table table-hover table-responsive" width="100%">
                                                <tbody class="m-datatable__body" style="">
                                                    @foreach($category->children as $category)
                                                        <tr>
                                                            <td><img style="width: 80px;" src="{{ $category->image() }}"></td>
                                                            <td>{{ $category->name }}</td>
                                                            <td>
                                                                @can('admin.categories.edit')
                                                                    <a href="{{ route('admin.categories.edit' , [ 'id' => $category->id ] ) }}" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                                                @endcan
                                                                @can('admin.categories.destroy')
                                                                    <form style="display: inline-block;" action="{{ route('admin.categories.destroy' , [ 'id' => $category->id ] ) }}" method="post">
                                                                        {{ csrf_field() }}
                                                                        {{ method_field('DELETE') }}
                                                                        <button type="button" id="delete" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>
                                                                    </form>
                                                                @endcan
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @else
                                            <div class="alert alert-info"> @lang('dashboard.there_is_no_sub_category') </div>
                                        @endif

                                    </div>
                                </div>


                    </div>

                        @endforeach

                    </div>


                </div>

            </div>

        </div>

    </div>


@endsection

@section('scripts')

    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $( function() {

            $( "#accordion" ).sortable({
                stop: function(event, ui) {

                    var loader = $(ui.item).find('.card-loading');
                    var items_sort = '';

                    loader.css('display','inline-block');

                    $("#accordion .card").each(function(){
                        items_sort += $(this).data('id');
                        items_sort += ',';
                    });

                    $.get('{{ route('admin.categories.index') }}?items_sort='+items_sort, function(data){
                        loader.fadeOut();
                    });

                }
            }).disableSelection();

        } );
    </script>

@endsection