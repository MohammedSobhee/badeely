<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function hasPermission($permission)
    {
        return auth('admins')->user()
            ->role->permissions
            ->where('permission',$permission)->first() ? true : false;
    }

    public function hasPermissions(array $permissions)
    {
        return auth('admins')->user()
            ->role->permissions
            ->whereIn('permission',$permissions)->first() ? true : false;
    }


    public function delete()
    {
        if($this->id == 1){
            return back()->with(['error'=>__('dashboard.permission_denied')]);
        }
        return parent::delete();
    }
}
