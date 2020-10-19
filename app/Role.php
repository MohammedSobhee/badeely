<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $guarded = [];
    public $timestamps = false;

    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }


    public function syncPermissions($permissions)
    {
        $this->permissions()->delete();

        $permissions = array_map(function ($item) {
                    return new Permission([
                        'role_id' => $this->id,
                        'permission' => $item
                    ]);
                }, $permissions);

        $this->permissions()->saveMany($permissions);
    }

    public function delete()
    {
        if($this->id == 1){
            return back()->with(['error'=>__('dashboard.permission_denied')]);
        }
        return parent::delete();
    }

}
