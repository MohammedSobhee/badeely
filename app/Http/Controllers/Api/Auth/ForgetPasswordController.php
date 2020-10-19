<?php

namespace App\Http\Controllers\Api\Auth;

use App\Api\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use JWTAuth;
use Password;

class ForgetPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function getResetToken()
    {
        $this->validator([
            'email' => 'required|exists:users',
        ]);

        /* Email Send */
        $this->sendResetLinkEmail(request());

        return $this->success()->custom('reset_password_email_has_been_sent');
    }

    /**
     * Send a reset link to the given user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function sendResetLinkEmail(Request $request)
    {
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );

        return $response == Password::RESET_LINK_SENT
            ? $this->sendResetLinkResponse($response)
            : $this->sendResetLinkFailedResponse($request, $response);
    }

}