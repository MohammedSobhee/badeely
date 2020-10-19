@extends('mail.layout')
@section('content')

    <tr style="color: #696969;text-align: center;">
        <td>

            <h2 style="color: #696969; font-size: 14px; font-weight: bold; margin: 20px 0 30px;">@lang('dashboard.someone_request_to_reset_password_msg')</h2>
            <a href="{{ route('password.reset',['token' => $token]) }}" style="display:table; padding: 10px 30px; border-radius: 30px;margin:auto; color: #fff; font-weight: bold; font-size: 16px; background-color: #e43931; text-decoration: none;">@lang('dashboard.change_password')</a>
            <p style="color: #696969; font-size: 12px;">@lang('dashboard.if_you_have_problem_with_reset_link') </p>
            <p style="color: #696969; font-size: 12px;"><a href="{{ route('password.reset',['token' => $token]) }}">{{ route('password.reset',['token' => $token]) }}</a></p>
            <p style="color: #696969; font-size: 12px;">
                @lang('dashboard.if_you_have_doesnt_send_password_request')
            </p>


        </td>
    </tr>

@endsection