<?php

namespace App\Http\Controllers\Api\Auth;

use App\Api\Controller;
use App\Http\Transformer\Profile;
use App\SocialProvider;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Socialite;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.api')->only('logout');
    }

    public function loginBySocial($provider)
    {

        if(request('id_token')){

            /* ID TOKEN GET */

            $ch = curl_init("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=".request('id_token'));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);

            try
            {
                $socialUser = json_decode($data,true);
                if(!isset($socialUser['sub'])){
                    return $this->error()->BadRequest('error_in_access_token');
                }
            }catch(\Exception $e) {
                return $this->error()->BadRequest('error_in_access_token');
            }

            //check if we have logged provider
            $socialProvider = SocialProvider::where('provider_id',$socialUser['sub'])->first();

            //check if user deleted and restore
//            $user = User::withTrashed()->where('email',$socialUser['email'])->first() ?? optional($socialProvider)->user;
//            if(optional($user)->delete_date){
//                $this->restoreUser($user);
//            }


            if(!$socialProvider)
            {
                //create a new user and provider
                $user = User::firstOrCreate(
                    ['email' => $socialUser['email']],
                    [
                        'name' => $socialUser['name'],
                        'image' => $socialUser['picture'],
                        'password'=>bcrypt(rand(10000,99999)),
                        'register_by' => 'facebook'
                    ]
                );

                $user->socialProviders()->create(
                    ['provider_id' => $socialUser['sub'], 'provider' => $provider]
                );
            }else{
                $user = $socialProvider->user;
            }

            /* ID TOKEN GET */

        }else{

            try
            {
                $socialUser = Socialite::driver($provider)->userFromToken(request('access_token'));
            }
            catch(\Exception $e)
            {
                return $this->error()->BadRequest('error_in_access_token');
            }

            //check if we have logged provider
            $socialProvider = SocialProvider::where('provider_id',$socialUser->getId())->first();

            //check if user deleted and restore
//            $user = User::withTrashed()->where('email',$socialUser->getEmail())->first() ?? optional($socialProvider)->user;
//            if(optional($user)->delete_date){
//                $this->restoreUser($user);
//            }


            if(!$socialProvider)
            {
                //create a new user and provider
                $user = User::firstOrCreate(
                    ['email' => $socialUser->getEmail()],
                    [
                        'name' => $socialUser->getName(),
                        'image' => $socialUser->getAvatar(),
                        'password'=>bcrypt(rand(10000,99999)),
                        'register_by' => 'facebook'
                ]
                );
                $user->socialProviders()->create(
                    ['provider_id' => $socialUser->getId(), 'provider' => $provider]
                );

            }else{
                $user = $socialProvider->user;
            }


        }

        // user login by JWT
        $token = JWTAuth::fromUser($user);

        if (request()->has('device_token')){
            $user->device_token = request('device_token');
        }

        $user->ip = get_client_ip();
        $user->is_confirmed = 1;
        $user->save();

        $user = $this->transformer(new Profile(),$user)->one();

        $user['token'] = $token;

        return $this->success($user)->data();

    }

    public function login(Request $request)
    {
        $this->validator([
            'password' => 'required',
        ]);

        $username = $request->input('username') ?? '#*JF#)I(F-#JFJ(#F#n20--90-2';
        $user = User::withTrashed('user')
            ->where('mobile',$username)
            ->orWhere('email',$username)
            ->first();

        if(!$user || !Hash::check($request->password, $user->password)){
            return $this->error()->unauthorized('invalid_credentials');
        }

//        if(!$user->is_confirmed){

//            return $this->error()->BadRequest('account_not_activated');

//        }else{

            try {

                if (! $token = JWTAuth::attempt(['email' => $user->email, 'password' => $request->password])) {
                    return $this->error()->unauthorized('invalid_credentials');
                }

            }catch (JWTException $e) {
                return $this->error()->server('could_not_create_token');
            }

//        }


        if ($request->has('device_token')){
            $user->device_token = $request->get('device_token');
        }

        $user->ip = get_client_ip();
        $user->save();

        $user = $this->transformer(new Profile(),$user)->one();

        $user['token'] = $token;

        return $this->success($user)->data();
    }

    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return $this->success()->custom('logout_success');
    }

//    private function restoreUser($user)
//    {
//        $user->restore();
//
//        $user->delete_date = null;
//        $user->save();
//    }

}