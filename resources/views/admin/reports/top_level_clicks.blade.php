@extends('layouts.admin',[ 'page'=> 'top_level_clicks' ])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">



        <div class="m-subheader ">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.top_level_clicks')</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <span class="m-nav__link-text">@lang('pages.top_level_clicks')</span>
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

                                <h3 class="m-portlet__head-text">@lang('pages.top_level_clicks')</h3>

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
                                        <label>@lang('inputs.from_date') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" class="form-control" id="from" readonly="" name="from" value="{{ request('from') }}" placeholder="@lang('inputs.from_date')">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label>@lang('inputs.to_date') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" class="form-control" id="to" readonly="" name="to" value="{{ request('to') }}" placeholder="@lang('inputs.to_date')">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-2">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label>@lang('inputs.target') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <select id="target" name="target" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value="">@lang('inputs.all') ({{ \App\TopLevelView::where('target','<>','top')->count() }})</option>
                                                <option value="featured" {{ request('target') == 'featured' ? 'selected' : '' }}>Featured ({{ \App\TopLevelView::where('target', 'featured')->count() }})</option>
{{--                                                <option value="top" {{ request('target') == 'top' ? 'selected' : '' }}>Top ({{ \App\TopLevelView::where('target', 'top')->count() }})</option>--}}
                                                <option value="new" {{ request('target') == 'new' ? 'selected' : '' }}>New ({{ \App\TopLevelView::where('target', 'new')->count() }})</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-4">
                                <br />
                                <button type="submit" class="btn btn-warning m-btn--wide">@lang('dashboard.show_result')</button>
                                <a href="{{ route('admin.reports.top_level_clicks') }}" class="btn btn-info m-btn--wide">@lang('dashboard.show_all')</a>
                            </div>

                            <hr>
                        </form>

                    </div>


                    <table class="table table-hover table-responsive sortable" width="100%">

                        <thead class="thead-default">

                        <tr>

                            <th>@lang('inputs.target')</th>

                            <th>@lang('inputs.user')</th>

                            <th>@lang('inputs.created_at')</th>

                        </tr>

                        </thead>

                        <tbody class="m-datatable__body" style="">


                        @foreach($views as $view)

                            <tr>

                                <td>{{ ucfirst($view->target) }}</td>

                                <td>
                                    @if($view->user)
                                        <a href="{{ route('admin.users.edit',$view->user->id) }}">{{ $view->user->name }}</a>
                                    @else
                                        <span>-</span>
                                    @endif
                                </td>

                                <td>{{ date( 'd/m/Y - g:i A' , strtotime($view->created_at) ) }}</td>


                            </tr>

                        @endforeach



                        </tbody>

                    </table>

                    {!! $views->appends(request()->input())->links() !!}


                </div>



            </div>



        </div>



    </div>

@endsection

@section('scripts')

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

@endsection