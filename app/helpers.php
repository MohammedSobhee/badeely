<?php

if(!function_exists('lreplace'))
{
    function lreplace($search, $replace, $subject){
        $pos = strrpos($subject, $search);
        if($pos !== false){
            $subject = substr_replace($subject, $replace, $pos, strlen($search));
        }
        return $subject;
    }
}

if(!function_exists('assets'))
{
    function assets($dir)
    {
        return url('assets/'.$dir);
    }
}


if(!function_exists('web_assets'))
{
    function web_assets($dir)
    {
        return url('assets/web/'.$dir);
    }
}


if(!function_exists('admin_assets'))
{
    function admin_assets($dir)
    {
        return url('assets/admin/'.$dir);
    }
}



if(!function_exists('api'))
{
    function api()
    {
        return new \App\Api\Controller;
    }
}

if(!function_exists('media'))
{
    function media()
    {
        return new App\Classes\Media();
    }
}


//if(!function_exists('sms'))
//{
//    function sms($mobile, $msg)
//    {
//        \Log::info($msg,[$mobile]);
////        $SMSProvider = new Malath_SMS(config('messages.sms_api_username'),
////            config('messages.sms_api_password'), 'E');
////
////        $SmS_Msg    =  $msg;
////        $Mobiles    = $mobile;
////        $Originator = 'LuxuryKSA';
////        $CheckUser = $SMSProvider->CheckUserPassword();
////
////        $SMSProvider->Send_SMS($Mobiles, $Originator, $SmS_Msg, $CheckUser);
//    }
//}

if(!function_exists('get_client_ip'))
{
    function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

}

if(!function_exists('generate_username'))
{
    function generate_username($name)
    {
        $username = \Illuminate\Support\Str::slug($name);
        $userRows  = \App\User::whereRaw("username REGEXP '^{$username}(-[0-9]*)?$'")->get();
        $countUser = count($userRows) + 1;

        return ($countUser > 1) ? "{$username}-{$countUser}" : $username;
    }
}

if(!function_exists('ends_with'))
{
    function ends_with($haystack, $needle)
    {
        $length = strlen($needle);
        return $length === 0 ||
            (substr($haystack, -$length) === $needle);
    }
}

if(!function_exists('instagramUsername'))
{
    function instagramUsername($url)
    {
        if(ends_with($url, '/')){
            $url = substr($url, 0, -1);
        }

        $url = explode('/',$url);

        return end($url) ?? '';
    }
}

