<?php

namespace App\Models;

class RolePermission extends AppModel {

  /**
   * The machine name of the role permissions table.
   * @var string
   */
  protected $table = 'role_permissions';

  /**
   * The primary key of the role permissions table.
   * @var string
   */
  protected $primaryKey = 'id';

  /**
   * The attributes that are mass assignable.
   * @var array
   */
  protected $fillable = ['role_id', 'permission_id'];

  /**
   * @see AppModel::readableName().
   */
  public function readableName() {
    return $this->name;
  }
}
