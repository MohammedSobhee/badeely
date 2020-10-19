@extends('mail.layout')
@section('content')

    <tr>
        <td>
            <p style="color: #767B8B; font-size: 16px; margin: 0 0 20px; text-align: center;">@lang('dashboard.to_verify_your_account_click_link_below')</p>
        </td>
    </tr>
    <tr>
        <td align="center" style="padding:0;">
            <a href="{{ route('verification.verify',['token' => $token]) }}" style="display: inline-block; background-color: #0081bf; border-radius: 100px; color: #fff; font-size: 16px; font-weight: 600; padding: 13px 20px; text-align: center; margin-right: 0px; text-decoration: none; margin: 10px 0;">@lang('dashboard.verify_account')</a>
            <p style="color: #696969; font-size: 12px;">@lang('dashboard.if_you_have_problem_with_btn_copy')</p>
            <p style="color: #696969; font-size: 12px;"><a href="{{ route('verification.verify',['token' => $token]) }}">{{ route('verification.verify',['token' => $token]) }}</a></p>

        </td>
    </tr>

@endsection