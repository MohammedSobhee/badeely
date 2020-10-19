<?php

namespace App\Api\Auth;

use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Middleware\BaseMiddleware;

class UserTokenMiddleware extends BaseMiddleware
{

    public function handle($request, \Closure $next)
    {
        if($request->access_token){
            $token = 'Bearer '.$request->access_token;
            $request->headers->set('Authorization', $token);
        }

        if (! $token = $this->auth->setRequest($request)->getToken()) {
            return api()->error()->BadRequest('user_token_absent');
        }

        try {
            $user = $this->auth->authenticate($token);
        } catch (TokenExpiredException $e) {
            return api()->error()->BadRequest('user_token_expired');
        } catch (JWTException $e) {
            return api()->error()->BadRequest('user_token_invalid');
        }

        if (! $user) {
            return api()->error()->NotFound('user_not_found');
        }

        $this->events->fire('tymon.jwt.valid', $user);

        return $next($request);
    }

}
