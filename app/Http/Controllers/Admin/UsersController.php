<?php

namespace App\Http\Controllers\Admin;

use App\Country;
use App\Http\Controllers\Controller;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        $users = new User();

        if (request('name')) {
            $users = $users->where('name', 'like', '%' . request('name') . '%');
        }

        if (request('gender')) {
            $users = $users->where('gender', request('gender'));
        }

        if (request('age')) {
            $users = $users->where('age', request('age'));
        }

        if (request('email')) {
            $users = $users->where('email', 'like', '%' . request('email') . '%');
        }

        if (request('register_by')) {
            $users = $users->where('register_by', request('register_by'));
        }

        if (request('country')) {
            $users = $users->where('country_id', request('country'));
        }

        if (request('is_confirmed')) {
            $users = $users->where('is_confirmed', request('is_confirmed') == 1 ? 1 : 0);
        }

        $users = $users->latest();

        /* EXPORT */
        if (request('export')) {
            $collection = User::usersTransformer($users);
            $this->exportExcel($collection, 'Users list');
        }
        /* EXPORT */

        $users = $users->paginate(15);

        $countries = Country::all();

        return view('admin.users.index', [
            'users' => $users,
            'countries' => $countries,
        ]);
    }

    function anyData()
    {
        $users = User::orderByDesc('updated_at');

        return datatables()->of($users)
            ->addColumn('action', function ($user) {

                return '<div class="table-actions">
                                        <a href="#" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="View"><i class="la la-eye"></i></a>
                                        <a href="' . url('users/edit-admin/' . $user->id) . '" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill edit-admin-mdl" title="Edit"><i class="la la-edit"></i></a>
                                       
                                    </div>';
            })->addIndexColumn()
            ->rawColumns(['action'])->toJson();
    }

    public function edit(User $user)
    {
        $countries = Country::where('is_active', 1)->get();

        return view('admin.users.edit', [
            'user' => $user,
            'countries' => $countries,
        ]);
    }

    public function create()
    {
        $countries = Country::where('is_active', 1)->get();

        return view('admin.users.create', [
            'countries' => $countries
        ]);
    }

    public function update(User $user)
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => request('email') ? 'max:255|unique:users,email,' . $user->id : '',
            'mobile' => request('mobile') ? 'max:255|unique:users,mobile,' . $user->id : '',
            'password' => request('password') ? 'min:6' : '',
        ]);

        $user->name = request('name');
        $user->email = request('email');
        $user->mobile = request('mobile');
        $user->country_id = request('country');
        $user->language = request('language');
        $user->age = request('age');
        $user->gender = request('gender');


        if (request('password')) {
            $user->password = bcrypt(request('password'));
        }

        $user->is_confirmed = request('is_confirmed') ? 1 : 0;

        $user->save();

        return back()->with('success', __('dashboard.edited'));
    }

    public function store()
    {
        request()->validate([
            'name' => 'required|string|max:255',
            'email' => request('email') ? 'max:255|unique:users' : '',
            'mobile' => request('mobile') ? 'max:255|unique:users' : '',
            'password' => 'required|min:6',
        ]);

        $user = new User();
        $user->name = request('name');
        $user->email = request('email');
        $user->mobile = request('mobile');
        $user->country_id = request('country');
        $user->language = request('language');
        $user->age = request('age');
        $user->gender = request('gender');
        $user->register_by = 'normal';

        if (request('password')) {
            $user->password = bcrypt(request('password'));
        }

        $user->is_confirmed = request('is_confirmed') ? 1 : 0;

        $user->save();

        return redirect(route('admin.users.index'))->with('success', __('dashboard.added'));
    }

    public function destroy(User $user)
    {
        if (!$user->delete()) {
            return back()->with(['error' => __('dashboard.permission_denied')]);
        }

        $user->forceDelete();

        return back()->with('success', __('dashboard.deleted'));
    }
}
