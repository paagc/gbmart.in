<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = ['name', 'display_name', 'description'];

    public static function getPermissionByName($name)
    {
        $instance = new static;
        return $instance->where('name', '=', $name)->first();
    }

    /**
     * Permission belongs to many role
     *
     * @return \Mage2\User\Models\Role
     */

    public function roles()
    {
        return $this->hasMany(Role::class);
    }
}
