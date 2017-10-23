<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'display_name', 'description'];

    /**
     * Role can be assigne to many users
     *
     * @return \Mage2\Ecommerce\Models\Database\User
     */
    public function user()
    {
        return $this->belongsToMany('App\User');
    }


    /**
     * Role has many Permissions
     *
     * @return \Mage2\Ecommerce\Models\Database\Role
     */

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }

    public function hasPermission($permissionName)
    {
        $permissions = explode(',', $permissionName);

        $returnData = true;
        foreach ($permissions as $permission) {
            if ($this->permissions->pluck('name')->contains($permission) == false) {
                $returnData = false;
            }
        }
        return $returnData;
    }
}

