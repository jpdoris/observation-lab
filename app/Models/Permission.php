<?php

namespace App\Models;

use App\Models\Role;
use App\Models\RolePermission;
use App\Traits\Encryptable;

class Permission extends AppModel {

    use Encryptable;

    /**
    * The machine name of the permissions table.
    * @var string
    */
    protected $table = 'permissions';

    /**
    * The primary key of the permissions table.
    * @var string
    */
    protected $primaryKey = 'permission_id';

    /**
    * The attributes that are mass assignable.
    * @var array
    */
    protected $fillable = ['name', 'description'];

    /**
    * @see AppModel::readableName().
    */
    public function readableName() {
        return $this->name;
    }

    /**
     * Attributes that can be encrypted.
     * @var array
     */
    protected $encryptable = [
        'name',
        'description',
    ];

    /**
    * Award a role a given permission.
    *
    * @param \App\Models\Role $role
    *   a Role object that will be awarded a new permission
    * @return void
    */
    public function award(Role $role) {
        RolePermission::firstOrCreate([
            'role_id' => $role->id,
            'permission_id' => $this->permission_id,
        ]);
    }

    /**
     * @param \App\Models\Role $role
     * @throws \Exception
     */
    public function revoke(Role $role) {
        RolePermission::where([
            'role_id' => $role->id,
            'permission_id' => $this->permission_id,
        ])->delete();
    }
}
