@extends('layouts.admin',[ 'page'=> 'accounts' ])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader ">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.accounts')</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                            <span class="m-nav__link-text">@lang('pages.accounts')</span>
                        </li>
                    </ul>
                </div>

                @can('admin.accounts.create')

                    <div class="ml-auto m--align-right">
                        <a href="{{ route('admin.accounts.create') }}" class="btn btn-accent m-btn m-btn--custom m-btn--icon m-btn--air m-btn--pill">
                        <span>
                            <i class="la la-plus"></i>
                            <span>@lang('pages.create_account')</span>
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
                                <i class="flaticon-cart"></i>
                            </span>
                                <h3 class="m-portlet__head-text">@lang('pages.accounts')</h3>
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

                            <div class="col-md-2">
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

                            <div class="col-md-2">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label>@lang('inputs.mobile') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" name="mobile" value="{{ request('mobile') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-2">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label>@lang('inputs.tags') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <input type="text" name="tags" value="{{ request('tags') }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-2">
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

                            <div class="col-md-2">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label>@lang('inputs.category') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <select id="category" name="category" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value="">@lang('inputs.all')</option>
                                                @foreach( $categories as $category )
                                                    <option value="{{ $category->id }}" {{ $category->id == request('category') ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
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
                                        <label>@lang('inputs.filter') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <div class="">
                                            <select id="filters" name="filters" class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value="">@lang('inputs.all')</option>
                                                <option value="is_featured" {{ request('filters') == 'is_featured' ? 'selected' : '' }}>Featured</option>
                                                <option value="rate" {{ request('filters') == 'rate' ? 'selected' : '' }}>UpVotes</option>
                                                <option value="clicks" {{ request('filters') == 'clicks' ? 'selected' : '' }}>Clicks</option>
                                                <option value="instagram_clicks" {{ request('filters') == 'instagram_clicks' ? 'selected' : '' }}>Instagram Clicks</option>
                                                <option value="id" {{ request('filters') == 'id' ? 'selected' : '' }}>New</option>
                                                <option value="priority" {{ request('filters') == 'priority' ? 'selected' : '' }}>Priority</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-md-none m--margin-bottom-10"></div>
                            </div>

                            <div class="col-md-3">
                                <div class="m-form__group m-form__group--inline">
                                    <div class="m-form__label">
                                        <label class="m-label m-label--single">@lang('inputs.status') :</label>
                                    </div>
                                    <div class="m-form__control">
                                        <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type" name="status">
                                            <option value="">@lang('inputs.all')</option>
                                            @foreach(\App\Account::statuses as $id => $status)
                                                <option value="{{ $id }}" {{ request('status') == $id ? 'selected' : '' }}>@lang('inputs.'.$status['key'])</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                                <br />
                                <button type="submit" class="btn btn-warning m-btn--wide">@lang('dashboard.show_result')</button>
                                <a href="{{ route('admin.accounts.index') }}" class="btn btn-info m-btn--wide">@lang('dashboard.show_all')</a>
                            </div>

                            <hr>
                        </form>

                    </div>

                    <table class="table table-hover table-responsive" width="100%">
                        <thead class="thead-default">
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>@lang('inputs.account_name')</th>
                            <th>@lang('inputs.user')</th>
                            <th>@lang('inputs.category')</th>
                            <th>@lang('inputs.rate')</th>
                            <th>@lang('inputs.clicks')</th>
{{--                            <th>@lang('inputs.instagram_clicks')</th>--}}
                            <th>@lang('inputs.filters')</th>
                            <th>@lang('inputs.remaining_days')</th>
                            <th>@lang('inputs.priority')</th>
                            <th>@lang('inputs.live_at')</th>
                            <th>@lang('inputs.status')</th>
                            <th style="width: 10%"></th>
                        </tr>
                        </thead>
                        <tbody class="m-datatable__body" style="">
                            @foreach( $accounts as $account )
                                <tr style="{{ $account->seen != 1 ? 'font-weight:700;':'' }}">
                                    <th scope="row">{{ $account->id }}</th>
                                    <td>{{ $account->description }}</td>
                                    <td>
                                        @if($account->user)
                                            <a href="{{ route('admin.users.edit',$account->user->id) }}">{{ $account->user->name }}</a>
                                        @else
                                            <span>@lang('inputs.admin')</span>
                                        @endif
                                    </td>
                                    <td>
                                        @foreach( $account->categories as $category )
                                            <span class="m-badge m-badge--warning m-badge--wide">{{ $category->name }}</span>
                                        @endforeach
                                    </td>
                                    <td>{{ $account->rate }}</td>
                                    <td>{{ $account->views }}</td>
{{--                                    <td>{{ $account->instagram_clicks }}</td>--}}
                                    <td>
                                        @if($account->isFeature())
                                            <span class="m-badge m-badge--warning m-badge--wide">Featured</span>
                                        @else

                                        @endif
                                    </td>
                                    <td>
                                        @include('admin.accounts.remaining_days')
                                    </td>
                                    <td>
                                        <label class="priority-label" style="cursor:pointer;"><b>{{ $account->priority }}</b></label>
                                        <div class="control-btn" style="display:none">
                                            <input type="number" class="form-control priority-input" data-id="{{ $account->id }}" value="{{ $account->priority }}">
                                            <a href="#"
                                               style="width:30px;height:30px;margin-top:4px;margin-left:3px;margin-right:3px"
                                               class="btn m-btn m-btn--hover-primary m-btn--icon m-btn--icon-only priority-save"><i class="la la-save"></i></a>
                                        </div>
                                    </td>
                                    <td>{{ date( 'd/m/Y - g:i A' , strtotime($account->created_at) ) }}</td>
                                    <td>
                                        @if(isset(\App\Account::statuses[$account->status]))
                                            <span class="m-badge m-badge--{{ \App\Account::statuses[$account->status]['color'] }} m-badge--wide">
                                                @lang('inputs.'.\App\Account::statuses[$account->status]['key'])</span>
                                        @endif
                                    </td>
                                    <td>

                                        @can('admin.accounts.edit')
                                            <a href="{{ route('admin.accounts.edit' , [ 'id' => $account->id ] ) }}"
                                               class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-edit"></i></a>
                                        @endcan

                                        @can('admin.accounts.destroy')
                                            <form style="display: inline-block;" action="{{ route('admin.accounts.destroy' , [ 'id' => $account->id ] ) }}" method="post">
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

                    {!! $accounts->appends(request()->input())->links() !!}

                </div>

            </div>

        </div>

    </div>


@endsection

@section('scripts')

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

            $.get('{{ route('admin.accounts.index') }}?priority='+priority+'&id='+id, function(data){

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
            $('.category-loader').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span>@lang('dashboard.plz_wait')</span>');

            $.get( '{{ route('ajax.categories') }}', { country : country } ,function( data ) {
                var html = "";
                $.each( data, function( key, value ) {
                    html += "<option value='"+ value.id +"'>"+ value.name +"</option>";
                });

                $('#category').html(html);
                $('.category-loader').html('');

                $('.m_form_type').selectpicker('refresh');

            });

        });


        {{--$('#country').change(function () {--}}

            {{--var country = $(this).val();--}}

            {{--$('#category').html('');--}}
            {{--$('.category-loader').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span>@lang('dashboard.plz_wait')</span>');--}}

            {{--$.get( '{{ route('ajax.sub_categories_by_country') }}', { country : country } ,function( data ) {--}}
                {{--var html = "<option value=''>@lang('inputs.all')</option>";--}}
                {{--$.each( data, function( key, value ) {--}}
                    {{--html += "<option value='"+ value.id +"'>"+ value.name +"</option>";--}}
                {{--});--}}

                {{--$('#category').html(html);--}}
                {{--$('.category-loader').html('');--}}

                {{--$('.m_form_type').selectpicker('refresh');--}}

            {{--});--}}

        {{--});--}}

    </script>

@endsection