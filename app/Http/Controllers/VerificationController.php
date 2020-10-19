<?php

namespace App\Http\Controllers;

use App\User;
use DB;

class VerificationController extends Controller
{
    public function verify()
    {
        $activation = DB::table('user_activation')
            ->where('token', request('token'))
            ->first();

        if ($activation) {

            $user = User::find($activation->user_id);
            $user->is_confirmed = 1;
            $user->save();

            // delete user from activation tavle
            DB::table('user_activation')->where('user_id', $user->id)->delete();

            app()->setLocale($user->language);
            return view('verify_success',[
                'user' => $user
            ]);

        }

        return abort(404);

    }

}
