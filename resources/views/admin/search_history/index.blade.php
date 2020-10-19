@extends('layouts.admin',[ 'page'=> 'search_history' ])
@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader ">

            <div class="d-flex align-items-center">
                <div class="mr-auto">
                    <h3 class="m-subheader__title m-subheader__title--separator">@lang('pages.search_history')</h3>
                    <ul class="m-subheader__breadcrumbs m-nav m-nav--inline">
                        <li class="m-nav__item m-nav__item--home">
                            <a href="{{ route('admin_home') }}" class="m-nav__link m-nav__link--icon">
                                <i class="m-nav__link-icon la la-home"></i>
                            </a>
                        </li>
                        <li class="m-nav__separator">-</li>
                        <li class="m-nav__item">
                           <span class="m-nav__link-text">@lang('pages.search_history')</span>
                        </li>
                    </ul>
                </div>

            </div>
        </div>

        <div class="m-content">


            <div class="m-portlet m-portlet--mobile">
                <div class="m-portlet__body">

                    <table class="table table-hover table-responsive" width="100%">
                        <thead class="thead-default">
                        <tr>
                            <th style="width: 10%">#</th>
                            <th>@lang('inputs.text')</th>
                            <th>@lang('inputs.user')</th>
                            <th>@lang('inputs.ip_address')</th>
                            <th>@lang('inputs.created_at')</th>
                            <th style="width: 10%"></th>
                        </tr>
                        </thead>
                        <tbody class="m-datatable__body" style="">
                            @foreach( $histories as $history )
                                <tr>
                                    <th scope="row">{{ $history->id }}</th>
                                    <td>{{ $history->search }}</td>
                                    <td>
                                        @if($history->user)
                                            <a href="{{ route('admin.users.edit',$history->user_id) }}">{{ $history->user->name }}</a>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($history->ip)
                                            <a href="https://www.infobyip.com/ip-{{ $history->ip }}.html" target="_blank">{{ $history->ip }}</a>
                                        @else
                                            <span>-</span>
                                        @endif
                                    </td>
                                    <td>{{ $history->created_at->format('d/m/Y - h:i A') }}</td>
                                    <td>

                                        {{--@can('admin.notifications.destroy')--}}
                                            {{--<form style="display: inline-block;" action="{{ route('admin.notifications.destroy' , [ 'id' => $history->id ] ) }}" method="post">--}}
                                                {{--{{ csrf_field() }}--}}
                                                {{--{{ method_field('DELETE') }}--}}
                                                {{--<button type="button" id="delete" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill"><i class="la la-trash"></i></button>--}}
                                            {{--</form>--}}
                                        {{--@endcan--}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {!! $histories->appends(request()->input())->links() !!}

                </div>

            </div>

        </div>

    </div>


@endsection