<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Admin;

class AdministratorsController extends Controller
{
    public function index()
    {
        $administrators = Admin::all();

        return view('admin.administrators.index',[
            'administrators' => $administrators
        ]);
    }

    public function create()
    {
        return view('admin.administrators.create');
    }

    public function edit(Admin $administrator)
    {
        if($administrator->id == 1){
            return back()->with(['error'=> 'permission denied !!']);
        }

        return view('admin.administrators.edit',[
            'administrator' => $administrator
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|min:6',
            'role_id' => 'required'
        ]);

        $data['password'] = bcrypt(request('password'));

        Admin::create($data);

        return redirect(route('admin.administrators.index'))->with('success',__('dashboard.added'));
    }

    public function update(Admin $administrator)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,'.$administrator->id,
            'password' => request('password') ? 'min:6' : '',
            'role' => $administrator->id != 1 ? 'required' : ''
        ]);

        if(request('password')){
            $data['password'] = bcrypt(request('password'));
        }else{
            unset($data['password']);
        }

        $administrator->update($data);

        return back()->with('success',__('dashboard.edited'));
    }

    public function destroy(Admin $administrator)
    {
        if(!$administrator->delete()){
            return back()->with(['error'=> 'permission denied !!']);
        }

        return back()->with('success',__('dashboard.deleted'));
    }

}
