@extends('layouts.admin',[ 'page'=> 'edit_account' ])

@section('styles')
    <link href="{{ url('assets/admin/plugin/tagsinput/tagsinput.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')

    <div class="m-grid__item m-grid__item--fluid m-wrapper">

        <div class="m-subheader">

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
                            <a href="{{ route('admin.accounts.index') }}" class="m-nav__link">
                                <span class="m-nav__link-text">@lang('pages.accounts')</span>
                            </a>
                        </li>

                        <li class="m-nav__separator">-</li>

                        <li class="m-nav__item">
                            <span class="m-nav__link-text">@lang('pages.edit_account')</span>
                        </li>

                    </ul>
                </div>

            </div>
        </div>

        <div class="m-subheader ">

            @if($account->user)
                <div class="row">
                    <div class="col-lg-12">
                        <div class="m-portlet">
                            <div class="m-portlet__head">
                                <div class="m-portlet__head-caption">
                                    <div class="m-portlet__head-title">
                                    <span class="m-portlet__head-icon m--hide">
                                    <i class="la la-gear"></i>
                                    </span>
                                        <h3 class="m-portlet__head-text">@lang('dashboard.added_by') :
                                            <a href="{{ route('admin.users.edit',$account->user->id) }}">{{ $account->user->name }}</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <label class="col-2 col-form-label" for="notes">@lang('inputs.notes') :</label>
                                    <div class="col-10">
                                        <textarea name="notes" id="notes" class="form-control m-input" cols="30"
                                                  rows="10"
                                                  readonly>{{ $account->note ?? __('inputs.undefined') }}</textarea>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="m-portlet">
                        <div class="m-portlet__head">
                            <div class="m-portlet__head-caption">
                                <div class="m-portlet__head-title">
								<span class="m-portlet__head-icon m--hide">
								<i class="la la-gear"></i>
								</span>
                                    <h3 class="m-portlet__head-text">@lang('pages.edit_account')</h3>
                                </div>
                            </div>
                        </div>

                        <form class="m-form validation-form" method="post"
                              action="{{ route('admin.accounts.update',[ 'id' => $account->id ]) }}"
                              enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="m-portlet__body">

                                <div class="languages-tabs">

                                    <div class="tab-content">

                                        <div class="tab-pane active">

                                            @if( config('languages') > 1 )
                                                <ul class="nav nav-tabs">
                                                    @foreach( config('languages') as $code => $label )
                                                        <li class="nav-item m-tabs__item">
                                                            <a class="nav-link m-tabs__link {{ $loop->first ? 'active':''}}"
                                                               href="#tb-lang-{{ $code }}"
                                                               data-toggle="tab">{{ $label }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                            <div class="tab-content">

                                            @foreach( config('languages')  as $code => $label )
                                                <!-- content tab start -->
                                                    <div class="tab-pane {{ $loop->first ? 'active':''}}"
                                                         id="tb-lang-{{ $code }}">

                                                        <div class="m-form__section m-form__section--first">
                                                            <div class="form-group m-form__group row">
                                                                <label class="col-2 col-form-label"
                                                                       for="account_labels[{{ $code }}]">@lang('inputs.name')
                                                                    :</label>
                                                                <div class="col-10">
                                                                    <input type="text" id="account_labels[{{ $code }}]"
                                                                           class="form-control m-input"
                                                                           name="account_labels[{{ $code }}]"
                                                                           value="{{ $account->name($code) }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="m-form__section m-form__section--first">
                                                            <div class="form-group m-form__group row">
                                                                <label class="col-2 col-form-label"
                                                                       for="account_names[{{ $code }}]">@lang('inputs.account_name')
                                                                    :</label>
                                                                <div class="col-10">
                                                                    <input type="text" id="account_names[{{ $code }}]"
                                                                           class="form-control m-input"
                                                                           name="account_names[{{ $code }}]"
                                                                           value="{{ $account->description($code) }}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <!-- content tab end -->
                                                @endforeach


                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="m-section__content">
                                    <div class="m-demo" data-code-preview="true" data-code-html="true"
                                         data-code-js="false">
                                        <label class="col-2 col-form-label">@lang('inputs.gallery')</label>
                                        <div class="m-demo__preview">

                                            <div id="image_preview"
                                                 class="m-stack m-stack--ver m-stack--general m-stack--demo">
                                                @if($gallery = json_decode($account->images))
                                                    @foreach($gallery as $image)
                                                        <div id="index{{ $loop->index }}"
                                                             class="m-stack__item img-item">
                                                            <a data-fancybox="gallery"
                                                               href="{{ media()->url('accounts',$image) }}">
                                                                <img src="{{ media()->url('accounts',$image) }}"
                                                                     style="width: 100px;height: 100px;">
                                                            </a>
                                                            <input type="hidden" name="old_images[]"
                                                                   value="{{ $image }}">
                                                            <button type="button"
                                                                    class="btn btn-danger btn-sm remove-img index{{ $loop->index }}">@lang('dashboard.remove')</button>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <input type="file" id="upload_file" style="cursor:pointer" class="form-control"
                                               name="images[]" accept="image/*" onchange="preview_image();" multiple/>

                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="mobile">@lang('inputs.mobile'):</label>
                                        <div class="col-10">
                                            <input type="text" id="mobile" class="form-control m-input" name="mobile"
                                                   value="{{ $account->mobile }}">
                                        </div>
                                    </div>
                                </div>

                                {{--<div class="m-form__section m-form__section--first">--}}
                                {{--<div class="form-group m-form__group row">--}}
                                {{--<label class="col-2 col-form-label" for="phone">@lang('inputs.phone') :</label>--}}
                                {{--<div class="col-10">--}}
                                {{--<input type="text" id="phone" class="form-control m-input" name="phone" value="{{ $account->phone }}">--}}
                                {{--</div>--}}
                                {{--</div>--}}
                                {{--</div>--}}

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="email">@lang('inputs.email') :</label>
                                        <div class="col-10">
                                            <input type="email" id="email" class="form-control m-input" name="email"
                                                   value="{{ $account->email }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"
                                               for="account_type">@lang('inputs.account_type') :</label>
                                        <div class="col-10">
                                            <input type="text" id="account_type" class="form-control m-input"
                                                   name="account_type" value="{{ $account->account_type }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="insta_url">@lang('inputs.insta_url')
                                            :</label>
                                        <div class="col-10">
                                            <input type="text" id="insta_url" class="form-control m-input"
                                                   name="insta_url" value="{{ $account->insta_url }}"
                                                   placeholder="http://instagram.com/username">
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="m-form__section m-form__section--first">--}}
{{--                                    <div class="form-group m-form__group row">--}}
{{--                                        <label class="col-2 col-form-label" for="insta_url">@lang('inputs.insta_url')--}}
{{--                                            :</label>--}}
{{--                                        <div class="col-10">--}}
{{--                                            <input type="text" id="insta_url" class="form-control m-input"--}}
{{--                                                   name="insta_url" value="{{ old('insta_url') }}"--}}
{{--                                                   placeholder="http://instagram.com/username">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"
                                               for="facebook_url">@lang('inputs.facebook_url') :</label>
                                        <div class="col-10">
                                            <input type="text" id="facebook_url" class="form-control m-input"
                                                   name="facebook_url" value="{{ $account->facebook_url }}"
                                                   placeholder="http://facebook.com/username">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="whatsapp">@lang('inputs.whatsapp')
                                            :</label>
                                        <div class="col-10">
                                            <input type="text" id="whatsapp" class="form-control m-input"
                                                   name="whatsapp" value="{{ $account->whatsapp }}"
                                                   placeholder="http://whatsapp.com/mobile">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"
                                               for="website_link">@lang('inputs.website_link') :</label>
                                        <div class="col-10">
                                            <input type="text" id="website_link" class="form-control m-input"
                                                   name="website_link" value="{{ $account->website_link }}"
                                                   placeholder="http://website.com/link">
                                        </div>
                                    </div>
                                </div>
                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"
                                               for="youtube">@lang('inputs.youtube') :</label>
                                        <div class="col-10">
                                            <input type="text" id="youtube" class="form-control m-input"
                                                   name="youtube" value="{{ $account->youtube }}"
                                                   placeholder="http://youtube.com/link">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="country">@lang('inputs.country')
                                            :</label>
                                        <div class="col-10">
                                            <select id="country" name="country"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type">
                                                <option value="">@lang('inputs.country')</option>
                                                @foreach( $countries as $country)
                                                    <option value="{{ $country->id }}" {{ $country->id == $account->country_id ? 'selected' : '' }}>{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="categories">@lang('inputs.category')
                                            :</label>
                                        <div class="col-10">
                                            <select id="categories" name="categories[]"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    multiple>
                                                @foreach( $categories as $category)
                                                    <option value="{{ $category->id }}"
                                                            {{ in_array($category->id,$accountCategories) ? 'selected' : '' }}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="categories-loader"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label"
                                               for="sub_category">@lang('inputs.sub_category') :</label>
                                        <div class="col-10">
                                            <select id="sub_category" name="categories[]"
                                                    class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    multiple>
                                                @foreach( $subCategories as $category)
                                                    <option value="{{ $category->id }}"
                                                            data-parent="{{ $category->parent->id ?? '' }}"
                                                            {{ in_array($category->id,$accountCategories) ? 'selected' : '' }}>{{ $category->name }}
                                                        - {{ $category->parent->name ?? '' }}</option>
                                                @endforeach
                                            </select>
                                            <div class="sub_category-loader"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="country">@lang('inputs.tags') :</label>
                                        <div class="col-10">
                                            <input type="text" class="form-control m-input" name="tags" id="tags"
                                                   value="{{ $account->tags }}" data-role="tagsinput">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="country">@lang('inputs.app_tags')
                                            :</label>
                                        <div class="col-10">
                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    id="app_tags"
                                                    name="app_tags[]" multiple>

                                                @if(isset($account->app_tags))
                                                    @foreach(explode(',', $account->app_tags) as $item)
                                                        <option selected>{{$item}}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">@lang('inputs.started_at') :</label>
                                        <div class="col-10">
                                            @php
                                                $expire = $account->started_at ?
                                                date('m/d/Y',strtotime($account->started_at)) : null;
                                            @endphp
                                            <input type="text" id="m_datepicker_2" class="form-control m-input"
                                                   name="started_at" value="{{ $expire }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label">@lang('inputs.expire_at') :</label>
                                        <div class="col-10">
                                            @php
                                                $expire = $account->expire_at ?
                                                date('m/d/Y',strtotime($account->expire_at)) : null;
                                            @endphp
                                            <input type="text" id="m_datepicker_1" class="form-control m-input"
                                                   name="expire_at" value="{{ $expire }}">
                                            <p>Leave blank for unlimited</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label class="col-2 col-form-label" for="priority">@lang('inputs.priority')
                                            :</label>
                                        <div class="col-10">
                                            <input type="number" id="priority" class="form-control m-input"
                                                   name="priority" value="{{ $account->priority }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label for="pageTitle" class="col-2 col-form-label">@lang('inputs.status')
                                            :</label>
                                        <div class="col-10">
                                            <select class="form-control m-bootstrap-select m-bootstrap-select--solid m_form_type"
                                                    name="status">
                                                @foreach(\App\Account::statuses as $id => $status)
                                                    <option value="{{ $id }}" {{ $account->status == $id ? 'selected' : '' }}>@lang('inputs.'.$status['key'])</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="m-form__section m-form__section--first">
                                    <div class="form-group m-form__group row">
                                        <label for="pageTitle" class="col-2 col-form-label">Is Featured :</label>
                                        <div class="col-10">
										<span class="m-switch m-switch--lg m-switch--info m-switch--icon">
												<label>
						                        <input type="checkbox" id="is_featured" name="is_featured" value="1"
                                                        {{ $account->featured_from && $account->featured_to ? 'checked' : '' }}>
						                        <span></span>
						                        </label>
						                    </span>
                                        </div>
                                    </div>
                                </div>

                                <div id="featured_between" class="form-group m-form__group row"
                                     style="{{ $account->featured_from && $account->featured_to ? '' : 'display:none' }}">
                                    <label class="col-form-label col-lg-3 col-sm-12">@lang('inputs.featured_between')</label>
                                    <div class="col-lg-4 col-md-9 col-sm-12">
                                        <div class="input-daterange input-group" id="m_datepicker_5">
                                            @php
                                                $start = date('m/d/Y',strtotime($account->featured_from));
                                                $end = date('m/d/Y',strtotime($account->featured_to));
                                            @endphp
                                            <input type="text" class="form-control m-input" name="start"
                                                   value="{{ $start }}" placeholder="@lang('inputs.from')">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="la la-ellipsis-h"></i></span>
                                            </div>
                                            <input type="text" class="form-control" name="end" value="{{ $end }}"
                                                   placeholder="@lang('inputs.to')">
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="m-portlet__foot m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions">

                                    <button type="submit"
                                            class="btn btn-accent m-btn m-btn--air m-btn--custom">@lang('dashboard.save')</button>

                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>


@endsection

@section('scripts')

    <script src="{{ url('assets/admin/plugin/tagsinput/tagsinput.js') }}"></script>

    <script>
$(document).ready(function () {

    $(document).on('keyup', '#tags', function () {
        $('#app_tags').html('').trigger("change");
        var myStr = this.value;
        var strArray = myStr.split(",");
        var options = '';
        // Display array values on page
        for (var i = 0; i < strArray.length; i++) {

            options += '<option selected>' + strArray[i] + '</option>';
        }
        $('#app_tags').html(options).trigger("change");
        // $('#app_tags').selectpicker();
        $('#app_tags').selectpicker('refresh');
    });
});
$("#m_datepicker_5").datepicker({
    leftArrow: '<i class="la la-angle-right"></i>',
    rightArrow: '<i class="la la-angle-left"></i>'
});

$("#m_datepicker_1").datepicker({
    leftArrow: '<i class="la la-angle-right"></i>',
    rightArrow: '<i class="la la-angle-left"></i>'
});

$("#m_datepicker_2").datepicker({
    leftArrow: '<i class="la la-angle-right"></i>',
    rightArrow: '<i class="la la-angle-left"></i>'
});

$('#is_featured').change(function () {
    if ($(this).is(':checked')) {
        $('#featured_between').show();
    } else {
        $('#featured_between').hide();
    }
})

    </script>

    <script>

        var index = 3873;

        function preview_image() {

            var total_file = document.getElementById("upload_file").files.length;
            var files = document.getElementById("upload_file").files;

            for (var i = 0; i < total_file; i++) {
                $('#image_preview').append(`
                    <div id="index` + index + `" class="m-stack__item img-item">
                         <a data-fancybox="gallery" href="` + URL.createObjectURL(event.target.files[i]) + `">
                            <img src="` + URL.createObjectURL(event.target.files[i]) + `" style="width: 100px;height: 100px;">
                         </a>
                         <button type="button" class="btn btn-danger btn-sm remove-img index` + index + `">@lang('dashboard.remove')</button>
                    </div>
                `);

                if (i == 0) {

                    var x = $("#upload_file"),
                        y = x.clone();

                    y.insertAfter("#index" + index);

                    $("#upload_file").removeAttr('onchange', '');
                    $("#upload_file").attr('id', "file" + index).hide();

                    index++;

                }

            }

            var input = $("#upload_file");
            input.replaceWith(input.val('').clone(true));

        }

        $(document).on('click', '.remove-img', function () {
            $(this).closest('.img-item').remove();
        });

    </script>

    <script>

        $('#country').change(function () {

            var country = $(this).val();
            $('#categories').html('');
            $('#sub_category').html('');
            $('.categories-loader').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span>@lang('dashboard.plz_wait')</span>');

            $.get('{{ route('ajax.categories') }}', {country: country}, function (data) {
                var html = '';
                $.each(data, function (key, value) {
                    html += "<option value='" + value.id + "'>" + value.name + "</option>";
                });

                $('#categories').html(html);
                $('.categories-loader').html('');

                $('.m_form_type').selectpicker('refresh');

            });

        });

        $('#categories').change(function () {

            var categories = $(this).val();
            var country = $('#country').val();
            var old_selected = $('#sub_category').val();

            $('#sub_category').html('');
            $('.sub_category-loader').html('<i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span>@lang('dashboard.plz_wait')</span>');

            $.get('{{ route('ajax.sub_categories') }}', {
                categories: categories,
                old_selected: old_selected,
                country: country
            }, function (data) {
                var html = '';
                $.each(data, function (key, value) {
                    var isSelected = value.selected ? 'selected' : '';
                    console.log(isSelected);
                    html += "<option value='" + value.id + "' " + isSelected + ">" + value.name + " - " + value.parent_name + "</option>";
                });

                $('#sub_category').html(html);
                $('.sub_category-loader').html('');

                $('.m_form_type').selectpicker('refresh');

            });

        });


    </script>

@endsection