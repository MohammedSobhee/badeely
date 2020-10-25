<?php

namespace App\Http\Controllers\Api\Auth;

use App\Api\Controller;
use App\Http\Transformer\Profile;
use App\SocialProvider;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;
use Socialite;

use Laravel\Socialite\Two\User as OAuthTwoUser;

class LoginController extends Controller
{
    protected $fields = ['name', 'email', 'gender', 'verified', 'link'];

    public function __construct()
    {
        $this->middleware('auth.api')->only('logout');
    }

    public function loginBySocial($provider)
    {

        if (request('access_token')) {

            if ($provider == 'facebook') {

                $ch = curl_init("https://graph.facebook.com/v3.3/me?access_token=" . request('access_token') . "&fields=" . implode(',', $this->fields) . "");
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                $data = curl_exec($ch);
                curl_close($ch);

                try {
                    $socialUser = json_decode($data, true);

                    if (!isset($socialUser['id'])) {
                        return $this->error()->BadRequest('error_in_access_token');
                    }
                } catch (\Exception $e) {
                    return $this->error()->BadRequest('error_in_access_token');
                }
//                $meUrl = $this->graphUrl.'/'.$this->version.'/me?access_token='.$token.'&fields='.implode(',', $this->fields);
//
//                if (! empty($this->clientSecret)) {
//                    $appSecretProof = hash_hmac('sha256', $token, $this->clientSecret);
//
//                    $meUrl .= '&appsecret_proof='.$appSecretProof;
//                }
//
//                $response = $this->getHttpClient()->get($meUrl, [
//                    'headers' => [
//                        'Accept' => 'application/json',
//                    ],
//                ]);
//
//                return json_decode($response->getBody(), true);
            } else if ($provider == 'apple') {
                $socialUser = $this->appleLogin(\request()->all());


                $socialUser['id'] = $socialUser['sub'];

                $socialUser['name'] = substr($socialUser['email'], 0, strpos($socialUser['email'],'@'));
            } else {
                return $this->error()->BadRequest('error_in_access_token');
            }
            /* ID TOKEN GET */

//            $ch = curl_init("https://www.googleapis.com/oauth2/v3/tokeninfo?id_token=".request('id_token'));
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//            curl_setopt($ch, CURLOPT_HEADER, 0);
//            $data = curl_exec($ch);
//            curl_close($ch);
//
//            try
//            {
//                $socialUser = json_decode($data,true);
//                if(!isset($socialUser['sub'])){
//                    return $this->error()->BadRequest('error_in_access_token');
//                }
//            }catch(\Exception $e) {
//                return $this->error()->BadRequest('error_in_access_token');
//            }


            //check if we have logged provider
            $socialProvider = SocialProvider::where('provider_id', $socialUser['id'])->first();

            //check if user deleted and restore
//            $user = User::withTrashed()->where('email',$socialUser['email'])->first() ?? optional($socialProvider)->user;
//            if(optional($user)->delete_date){
//                $this->restoreUser($user);
//            }


            if (!$socialProvider) {

                //create a new user and provider
                $user = User::firstOrCreate(
                    ['email' => $socialUser['email']],
                    [
                        'name' => $socialUser['name'],
//                        'image' => $socialUser['picture'],
                        'password' => bcrypt(rand(10000, 99999)),
                        'register_by' => $provider
                    ]
                );

                $user->socialProviders()->create(
                    ['provider_id' => $socialUser['id'], 'provider' => $provider]
                );
            } else {
                $user = $socialProvider->user;
            }

            /* ID TOKEN GET */

        } else {

            try {
                $socialUser = Socialite::driver($provider)->userFromToken(request('access_token'));
            } catch (\Exception $e) {
                return $this->error()->BadRequest('error_in_access_token');
            }

            //check if we have logged provider
            $socialProvider = SocialProvider::where('provider_id', $socialUser->getId())->first();

            //check if user deleted and restore
//            $user = User::withTrashed()->where('email',$socialUser->getEmail())->first() ?? optional($socialProvider)->user;
//            if(optional($user)->delete_date){
//                $this->restoreUser($user);
//            }


            if (!$socialProvider) {
                //create a new user and provider
                $user = User::firstOrCreate(
                    ['email' => $socialUser->getEmail()],
                    [
                        'name' => $socialUser->getName(),
                        'image' => $socialUser->getAvatar(),
                        'password' => bcrypt(rand(10000, 99999)),
                        'register_by' => $provider
                    ]
                );
                $user->socialProviders()->create(
                    ['provider_id' => $socialUser->getId(), 'provider' => $provider]
                );

            } else {
                $user = $socialProvider->user;
            }


        }

        // user login by JWT
        $token = JWTAuth::fromUser($user);

        if (request()->has('device_token')) {
            $user->device_token = request('device_token');
        }

        $user->ip = get_client_ip();
        $user->is_confirmed = 1;
        $user->save();

        $user = $this->transformer(new Profile(), $user)->one();

        $user['token'] = $token;

        return $this->success($user)->data();

    }

    function login(Request $request)
    {
        $this->validator([
            'password' => 'required',
        ]);

        $username = $request->input('username') ?? '#*JF#)I(F-#JFJ(#F#n20--90-2';
        $user = User::withTrashed('user')
            ->where('mobile', $username)
            ->orWhere('email', $username)
            ->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->error()->unauthorized('invalid_credentials');
        }

//        if(!$user->is_confirmed){

//            return $this->error()->BadRequest('account_not_activated');

//        }else{

        try {

            if (!$token = JWTAuth::attempt(['email' => $user->email, 'password' => $request->password])) {
                return $this->error()->unauthorized('invalid_credentials');
            }

        } catch (JWTException $e) {
            return $this->error()->server('could_not_create_token');
        }

//        }


        if ($request->has('device_token')) {
            $user->device_token = $request->get('device_token');
        }

        $user->ip = get_client_ip();
        $user->save();

        $user = $this->transformer(new Profile(), $user)->one();

        $user['token'] = $token;

        return $this->success($user)->data();
    }

    public
    function logout()
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

    public function appleLogin(array $data)
    {
        $provider = 'apple';

        $token = $data['access_token'];

        $socialUser = Socialite::driver($provider)->userFromToken($token);

//        $user = $this->getLocalUser($socialUser);

        return $socialUser;
    }

    /**
     * @param OAuthTwoUser $socialUser
     * @return User|null
     */
//    protected function getLocalUser(OAuthTwoUser $socialUser): ?User
//    {
//
//        $user = User::where('email', $socialUser->email)->first();
//
//        if (!$user) {
//            $user = $this->registerAppleUser($socialUser);
//        }
//
//        return $user;
//    }


    /**
     * @param OAuthTwoUser $socialUser
     * @return User|null
     */
//    protected function registerAppleUser(OAuthTwoUser $socialUser): ?User
//    {
//        $user = User::create(
//            [
//                'name' => request()->fullName ? request()->fullName : 'Apple User',
//                'email' => $socialUser->email,
//                'password' => Str::random(30), // Social users are password-less
//                'register_by' => 'apple', // Social users are password-less
//
//            ]
//        );
//        return $user;
//    }

}