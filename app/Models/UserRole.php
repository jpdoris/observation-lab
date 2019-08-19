<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserRole extends AppModel
{

    /**
     * The machine name of the users table.
     * @var string
     */
    protected $table = 'users_roles';

    /**
     * The primary key of the users table.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'role_id',
        'user_id',
    ];
    /**
     * @see AppModel::readableName().
     */
    public function readableName() {
        //
    }
}
