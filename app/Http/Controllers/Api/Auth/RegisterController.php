<?php

namespace App\Http\Controllers\Api\Auth;

use App\Api\Controller;
use App\Http\Transformer\Profile;
use App\User;
use Illuminate\Http\Request;
use JWTAuth;
use DB;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        $request->merge([
            'ip' => get_client_ip()
        ]);

        $this->validator([
            'name' => 'required|string|max:255',
            'email' => $request->email ? 'string|max:255|unique:users' : '',
            'mobile' => $request->mobile ? 'max:255|unique:users' : '',
            'password' => 'required|string|min:6',
        ]);

        $user = $request->all();
        $user['password'] = bcrypt($request->input('password'));
        $user['register_by'] = 'normal';
        $user['is_confirmed'] = !request('email') ? 1 : 0;

        $user = User::create($user);

//        if(!request('email')){
//            $jwtToken = JWTAuth::fromUser($user);
//        }

        if (request('email')) {
            $token = $user->sendVerificationEmail();
        } else {
            $token = $user->sendVerificationSMS();
        }

        DB::table('user_activation')->insert(['user_id' => $user->id, 'token' => $token]);

        $user = User::find($user->id);
        if ($request->has('device_token')) {
            $user['device_token'] = $request->get('device_token');
            $user->save();

        }
        $jwtToken = JWTAuth::fromUser($user);

        $user = $this->transformer(new Profile(), $user)->one();

        $user['token'] = $jwtToken;

//        if(isset($jwtToken)){
//            $user['token'] = $jwtToken;
//        }


        return $this->success($user)->created('user_registered');
    }

//    public function verification()
//    {
//        $this->validator([
//            'username' => 'required',
//            'code' => 'required',
//        ]);
//
//        $user = User::where('username', request('username'))->first();
//
//        if (!$user) {
//
//            return $this->error()->NotFound('user_not_found');
//
//        } elseif ($user->is_confirmed) {
//
//            return $this->success()->custom('account_already_verification');
//
//        }
//
//        $check = DB::table('user_activation')
//            ->where('token', request('code'))
//            ->where('user_id', $user->id)
//            ->first();
//
//        if ($check) {
//
//            $user->is_confirmed = 1;
//
//            if (request()->has('device_token')){
//                $user->device_token = request('device_token');
//            }
//
//            $user->save();
//
//            DB::table('user_activation')->where('token', request('code'))->delete();
//
//            $token = JWTAuth::fromUser($user);
//
//            $user = $this->transformer(new Profile(),$user)->one();
//
//            $user['token'] = $token;
//
//            return $this->success($user)->data();
//
//        }
//
//        return $this->error()->BadRequest('error_in_verification_code');
//    }

    public function resendVerification()
    {
        $this->validator([
            'email' => 'required',
        ]);

        $user = User::where('email', request('email'))->first();

        if (!$user) {
            return $this->error()->NotFound('user_not_found');
        }

        if ($user->is_confirmed) {
            return $this->success()->custom('account_already_verification');
        }

        if (request('email')) {
            $token = $user->sendVerificationEmail();
        } else {
//            $token = $user->sendVerificationSMS();
        }

        DB::table('user_activation')->insert(['user_id' => $user->id, 'token' => $token]);


        return $this->success()->custom('account_verification_sent_successfully');

    }

}