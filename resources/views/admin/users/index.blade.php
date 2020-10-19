@extends('layouts.admin',[ 'page'=> 'users' ])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader ">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.users')</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <span class="m-nav__link-text">@lang('pages.users')</span>
                        </li>
                    </ul>
                </div>

                @can('admin.users.create')

                    <div class="ml-auto m--align-right">
                        <a href="{{ route('admin.users.create') }}"
                           class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                        <span>
                            <i class="la la-plus"></i>
                            <span>@lang('pages.create_user')</span>
                        </span>
                        </a>
                    </div>

                @endcan

            </div>
        </div>

        <div class="m-content">


            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__head">
                    <div class="m-portlet__head-caption">
                        <div class="row align-items-center">
                            <div class="m-portlet__head-title">
                            <span class="m-portlet__head-icon">
                                <i class="flaticon-users"></i>
                            </span>
                                <h3 class="m-portlet__head-text">@lang('pages.users')</h3>
                            </div>
                        </div>
                    </div>

                    <div class="m-portlet__head-tools">
                        <ul class="m-portlet__nav">
                            <li class="m-portlet__nav-item">
                                <a href="{{ request()->fullUrlWithQuery(['export' => true ]) }}"
                                   data-portlet-tool="remove" class="m-portlet__nav-link m-portlet__nav-link--icon"
                                   title="" data-original-title="Export"><i class="fa fa-cloud-download"></i></a>
                            </li>
                        </ul>
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
                                            <input type="text" name="name" value="{{ request('name') }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label>@lang('inputs.email') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" name="email" value="{{ request('email') }}"
                                                   class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label class="m-label m-label--single">@lang('inputs.gender') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                name="gender">
                                            <option value="">@lang('inputs.all')</option>
                                            <option value="male" {{ request('gender') == 'male' ? 'selected' : '' }}>@lang('inputs.male')</option>
                                            <option value="female" {{ request('gender') == 'female' ? 'selected' : '' }}>@lang('inputs.female')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label class="m-label m-label--single">@lang('inputs.age') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                name="age">
                                            <option value="">@lang('inputs.all')</option>
                                            <option value="under_15" {{ request('age') == 'under_15' ? 'selected' : '' }}>@lang('inputs.under_15')</option>
                                            <option value="15-25" {{ request('age') == '15-25' ? 'selected' : '' }}>@lang('inputs.15-25')</option>
                                            <option value="25-40" {{ request('age') == '25-40' ? 'selected' : '' }}>@lang('inputs.25-40')</option>
                                            <option value="40-60" {{ request('age') == '40-60' ? 'selected' : '' }}>@lang('inputs.40-60')</option>
                                            <option value="over_60" {{ request('age') == 'over_60' ? 'selected' : '' }}>@lang('inputs.over_60')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label class="m-label m-label--single">@lang('inputs.register_by') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                name="register_by">
                                            <option value="">@lang('inputs.all')</option>
                                            <option value="facebook" {{ request('register_by') == 'facebook' ? 'selected' : '' }}>@lang('inputs.facebook')</option>
                                            <option value="normal" {{ request('register_by') == 'normal' ? 'selected' : '' }}>@lang('inputs.normal')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label>@lang('inputs.country') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <select id="country" name="country"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
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

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label class="m-label m-label--single">@lang('inputs.verified') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                name="is_confirmed">
                                            <option value="">@lang('inputs.all')</option>
                                            <option value="1" {{ request('is_confirmed') == 1 ? 'selected' : '' }}>@lang('inputs.verified')</option>
                                            <option value="2" {{ request('is_confirmed') == 2 ? 'selected' : '' }}>@lang('inputs.not_verified')</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <br/>
                                <button type="submit"
                                        class="btn btn-warning m-btn--wide">@lang('dashboard.show_result')</button>
                                <a href="{{ route('admin.users.index') }}"
                                   class="btn btn-info m-btn--wide">@lang('dashboard.show_all')</a>
                            </div>

                            <hr>
                        </form>

                    </div>

                    <table class="table table-hover table-responsive sortable" id="users_tbl" width="100%">
                        <thead class="thead-default">
                        <tr>
                            <th style="width: 10%">#</th>
                            <th>@lang('inputs.name')</th>
                            <th>@lang('inputs.email')</th>
                            <th>@lang('inputs.mobile')</th>
                            <th>@lang('inputs.gender')</th>
                            <th>@lang('inputs.age')</th>
                            <th>@lang('inputs.register_by')</th>

                            <th>@lang('inputs.follow')</th>
                            <th>@lang('inputs.rate')</th>
                            <th>@lang('inputs.clicks')</th>

                            <th>@lang('inputs.country')</th>
                            <th>@lang('inputs.verified')</th>
                            <th style="width: 10%">@lang('inputs.action')</th>
                        </tr>
                        </thead>
                        <tbody class="m-datatable__body" style="">
                        @foreach( $users as $user )
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->mobile }}</td>
                                <td>
                                    @if($user->gender)
                                        @lang('inputs.'.$user->gender)
                                    @endif
                                </td>
                                <td>
                                    {{ $user->age }}
                                </td>
                                <td>
                                    @if($user->register_by == 'facebook')
                                        <span style="color:#3c5898">@lang('inputs.facebook')</span>
                                    @elseif($user->register_by == 'normal')
                                        <span style="color:#13a085;">@lang('inputs.normal')</span>
                                    @endif
                                </td>
                                <td>{{ $user->follows()->count() }}</td>
                                <td>{{ $user->upVotes()->count() }}</td>
                                <td>{{ $user->views()->count() }}</td>

                                <td>{{ $user->country->name ?? '-' }}</td>
                                <td>{!! $user->is_confirmed == 1 ? '<span class="m-badge m-badge--success m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-success">'. __('inputs.verified') .'</span>' :
                                               '<span class="m-badge m-badge--danger m-badge--dot"></span>&nbsp;<span class="m--font-bold m--font-danger">'. __('inputs.not_verified') .'</span>' !!}</td>
                                <td>

                                    @can('admin.users.edit')
                                        <a href="{{ route('admin.users.edit' , [ 'id' => $user->id ] ) }}"
                                           class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i
                                                    class="la la-edit"></i></a>
                                    @endcan

                                    @can('admin.users.destroy')
                                        <form style="display: inline-block;"
                                              action="{{ route('admin.users.destroy' , [ 'id' => $user->id ] ) }}"
                                              method="post">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="button" id="delete"
                                                    class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill">
                                                <i class="la la-trash"></i></button>
                                        </form>
                                    @endcan

                                </td>

                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                    {{--                    {!! $users->appends(request()->input())->links() !!}--}}

                </div>

            </div>

        </div>

    </div>

    @push('js')
        {{--        <script src="{{url('/')}}/assets/admin/demo/default/custom/components/datatables/base/html-table.js"--}}
        {{--                type="text/javascript"></script>--}}

        <script>
{{--var users_tbl = $('#users_tbl').mDatatable({--}}
{{--    data: {--}}
{{--        saveState: {--}}
{{--            cookie: true,--}}
{{--            webstorage: true--}}
{{--        },--}}
{{--        type: 'remote',--}}
{{--        source: {--}}
{{--            read: {--}}
{{--                url: '{{url('/admin/users-data')}}',--}}
{{--                method: 'GET',--}}
{{--                // custom headers--}}
{{--                // headers: {'x-my-custom-header': 'some value', 'x-test-header': 'the value'},--}}
{{--                params: {--}}
{{--                    // custom parameters--}}
{{--                    // generalSearch: '',--}}
{{--                    // token: csrf_token--}}
{{--                },--}}
{{--                map: function (raw) {--}}
{{--                    // sample data mapping--}}
{{--                    var dataSet = raw;--}}
{{--                    if (typeof raw.data !== 'undefined') {--}}
{{--                        dataSet = raw.data;--}}
{{--                    }--}}
{{--                    return dataSet;--}}
{{--                },--}}
{{--            }--}}
{{--        },--}}
{{--        pageSize: 10,--}}
{{--        serverPaging: true,--}}
{{--        serverFiltering: true,--}}
{{--        serverSorting: true,--}}
{{--    },--}}
{{--    pagination: true,--}}
{{--    search: {--}}
{{--        input: $('#admins_user_search')--}}
{{--    },--}}
{{--    columns: [--}}
{{--        {--}}
{{--            field: "id",--}}
{{--            title: "#",--}}
{{--        }, {--}}
{{--            field: "name",--}}
{{--            title: "@lang('inputs.name')",--}}
{{--        }, {--}}
{{--            field: "email",--}}
{{--            title: "@lang('inputs.email')",--}}
{{--        }, {--}}
{{--            field: "mobile",--}}
{{--            title: "@lang('inputs.mobile')",--}}
{{--        }, {--}}
{{--            field: "gender",--}}
{{--            title: "@lang('inputs.gender')",--}}
{{--        }, {--}}
{{--            field: "age",--}}
{{--            title: "@lang('inputs.age')",--}}
{{--        }, {--}}
{{--            field: "action",--}}
{{--            title: "Action",--}}
{{--        }--}}
{{--    ]--}}
{{--});--}}
</script>
    @endpush
@endsection