<?php

namespace App\Http\Controllers\Api;

use App\Api\Controller;
use App\Http\Transformer\AccountsTransformer;
use App\Http\Transformer\Profile;

class UsersController extends Controller
{
    public function show()
    {
        $user = $this->user();

        $user = $this->transformer(new Profile(),$user)->one();

        return $this->success($user)
            ->data();
    }


    public function update()
    {
        $this->validator([
            'name' => 'string|max:255',
            'email' => request('email') ? 'max:255|unique:users,email,'.$this->user()->id : '',
            'mobile' => request('mobile') ? 'max:255|unique:users,mobile,'.$this->user()->id : '',
            'avatar' => request()->hasFile('avatar') ? 'image|max:10000' : '',
        ]);

            $data = request()->all();

            if(request('avatar')){
                $data['image'] = media()->upload(request('avatar'),'users',[
                    ['x' => null, 'y'=> null, true],
                    ['x' => 100, 'y'=> 100, false]
                ]);
                unset($data['avatar']);
            }

            $this->user()->update($data);

            $user = $this->transformer(new Profile(),$this->user())->one();

            return $this->success($user)
                ->updated();
    }

    public function password()
    {
        $this->validator([
            'new_password' => request('password') ? 'min:6' : '',
        ]);

        if(!\Hash::check(request('password'),auth()->user()->password)){
            return $this->error()->BadRequest('old_password_wrong');
        }

        $this->user()->update([
            'password' => bcrypt(request('new_password'))
        ]);

        $user = $this->transformer(new Profile(),$this->user())->one();

        return $this->success($user)
            ->updated('password_has_been_changed');
    }

    public function upVotes()
    {
        $user = $this->user();

        $accounts = $user->upVotes()->paginate(12);

        $data = $this->transformer(new AccountsTransformer(),$accounts)->collection();

        return $this->success($data)
            ->pagination($accounts);
    }

//    public function userById($id)
//    {
//        $user = User::find($id);
//
//        if(!$user){
//            return $this->error()->NotFound();
//        }
//
//        $user = $this->transformer(new Profile(),$user)->one();
//
//        return $this->success($user)
//            ->data();
//
//    }

}