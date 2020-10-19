<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Route;

class RolesController extends Controller
{
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index',[
            'roles' => $roles
        ]);
    }

    public function create()
    {
        return view('admin.roles.create',[
            'permissions' => $this->permissions(),
        ]);
    }

    public function edit($id)
    {
        $role = Role::find($id);
        $rolePermissions = $role->permissions()->pluck('permission')->toArray();

        return view('admin.roles.edit',[
            'role' => $role,
            'permissions' => $this->permissions(),
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function store()
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
        ]);

        if(!request('permissions')){
            return back()->with(['error'=>__('dashboard.must_choose_roles')]);
        }

        $role = Role::create($data);

        $permissions = array_map(function ($item) use ($role) {
            return new Permission([
                'role_id' => $role->id,
                'permission' => $item
            ]);
        }, request('permissions'));

        $role->permissions()->saveMany($permissions);

        return redirect()->to(url('admin/roles'))->with('success',__('dashboard.added'));
    }

    public function update($id)
    {
        $data = request()->validate([
            'name' => 'required|string|max:255',
        ]);

        $role = Role::find($id);

        if($role->id == 1){
            return back()->with(['error'=>__('dashboard.permission_denied')]);
        }

        $role->update($data);

        $role->syncPermissions(request('permissions'));

        return back()->with('success',__('dashboard.edited'));
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        return back()->with('success',__('dashboard.deleted'));
    }


    private function permissions()
    {
        $permissions = array_filter(Route::getRoutes()->getRoutesByName(), function($k) {
            return explode('.',$k)[0] == 'admin' && !str_contains($k, ['store', 'update']);
        }, ARRAY_FILTER_USE_KEY);

        $permissions = array_map(function ($v){
            return str_replace('admin.','',$v);
        },array_keys($permissions));

        unset($permissions[0]);

        $grouped = [];
        foreach ($permissions as $k => $value){

            $explode = explode('.',$value);

            $grouped[$explode[0]][] = $explode[1];

        }

        return $grouped;

    }

}
