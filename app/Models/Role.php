<?php

namespace App\Models;

use App\Traits\Encryptable;


class Role extends AppModel {

    use Encryptable;

    /**
     * Enum value for the "admin" user role (corresponds to role_id).
     * @const integer
     */
    const ROLE_ADMINISTRATOR = 1;

    /**
     * Enum value for the "owner" user role (corresponds to role_id).
     * @const integer
     */
    const ROLE_OWNER = 2;

    /**
     * Enum value for the "reporter" user role (corresponds to role_id).
     * @const integer
     */
    const ROLE_REPORTER = 3;

    /**
     * Enum value for the "reporter" user role (corresponds to role_id).
     * @const integer
     */
    const ROLE_HEALTHTECH = 4;

  /**
   * The machine name of the roles table.
   * @var string
   */
  protected $table = 'roles';

  /**
   * The primary key of the roles table.
   * @var string
   */
  protected $primaryKey = 'id';

  /**
   * The attributes that are mass assignable.
   * @var array
   */
  protected $fillable = ['name', 'description'];

    /**
     * Attributes that can be encrypted.
     * @var array
     */
  protected $encryptable = ['name', 'description'];
  /**
   * @see AppModel::readableName().
   */
  public function readableName() {
    return $this->name;
  }

  public function user()
  {
      return $this->belongsToMany('App\Models\User', 'users_roles', 'role_id', 'user_id');
  }
}
