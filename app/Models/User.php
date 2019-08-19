<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Notifications\Notifiable;
use App\Traits\Encryptable;

class User extends AppModel implements AuthenticatableContract, AuthorizableContract, CanResetPasswordContract {

    use Authenticatable, Authorizable, CanResetPassword, Notifiable;
    use Encryptable;

    /**
     * Enum value for a user account with the "admin" role.
     * @const integer
     */
    const USER_ADMIN = 1;

    /**
     * Enum value for a user account with the "owner" role.
     * @const integer
     */
    const USER_OWNER = 2;

    /**
     * Enum value for a user account with the "reporter" role.
     * @const integer
     */
    const USER_REPORTER = 3;

    /**
     * Enum value for a user account with the "healthtech" role.
     * @const integer
     */
    const USER_HEALTHTECH = 4;

    /**
    * Enum value for an "inactive" user account.
    * @const integer
    */
    const STATUS_INACTIVE = 0;

    /**
    * Enum value for an "active" user account.
    * @const integer
    */
    const STATUS_ACTIVE = 1;

    /**
     * regex for password validation
     */
    const PASSWORD_REGEX = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/";

    /**
     * The machine name of the users table.
     * @var string
     */
    protected $table = 'users';

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
        'first_name',
        'last_name',
        'email',
        'password',
        'status',
        'group_id',
    ];

    /**
     * List of attributes that may be encrypted before writing to
     *   the database.
     *
     * @var array
     */
    protected $encryptable = [
        'first_name',
        'last_name',
    ];

    /**
    * The attributes that should be hidden for arrays.
    * @var array
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
    * Computed attributes added to serialized Users.
    * @var array
    */
    protected $appends = [
        'role_name',
    ];

    /**
    * @see AppModel::readableName().
    */
    public function readableName() {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * Display Last Name first
     *
     * @return string
     */
    public function lastNameFirst() {
        return $this->last_name . ', ' . $this->first_name;
    }

    /**
    * A computed value that outputs this user's role name.
    * @return string
    */
    public function getRoleNameAttribute() {
        if (!is_null($this->role)) {
            return $this->role->pluck('name');
        }
    }

    /**
    * @see AppModel::formFilters().
    */
    public static function formFilters() {
        $filters = [];

        switch (\Request::method()) {
          case 'POST':
            $filters = [
              'role_id' => ['numeric', 'min:' . self::ROLE_ADMINISTRATOR, 'max:' . self::ROLE_REPORTER],
              'email' => ['sometimes', 'required', 'email', 'unique:users'],
              'password' => ['required', 'regex:' . self::PASSWORD_REGEX],
              'password_confirmation' => ['required', 'same:password'],
            ];
            break;

          case 'PUT':
            $filters = [
              'role_id' => ['numeric', 'min:' . self::ROLE_ADMINISTRATOR, 'max:' . self::ROLE_REPORTER],
              'status' => ['sometimes', 'numeric', 'min:' . self::STATUS_INACTIVE, 'max:' . self::STATUS_ACTIVE],
              'email' => ['sometimes', 'required', 'email', 'unique:users'],
              'password' => ['sometimes', 'regex:' . self::PASSWORD_REGEX],
              'password_confirmation' => ['required_with:password', 'same:password'],
            ];
            break;
        }

        return $filters;
    }

    /**
    * Get an array of the role types available to a user.
    *
    * @return array
    */
    public static function roleOptions() {
        $options = [
            self::ROLE_ADMININSTRATOR => Role::where('id', self::ROLE_ADMIN)->first()->readableName(),
            self::ROLE_OWNER => Role::where('id', self::ROLE_OWNER)->first()->readableName(),
            self::ROLE_REPORTER => Role::where('id', self::ROLE_REPORTER)->first()->readableName(),
            self::ROLE_HEALTHTECH => Role::where('id', self::ROLE_HEALTHTECH)->first()->readableName(),
        ];

        // Only admins can create other admins.
        if (\Auth::user()->isRole(self::ROLE_ADMININSTRATOR)) {
            $options[self::ROLE_ADMININSTRATOR] = Role::where('id', self::ROLE_ADMININSTRATOR)->first()->readableName();
        }

        return $options;
    }

    /**
    * Get an array of the status types available to a user.
    *
    * @return array
    */
    public static function statusOptions() {
        return [
            self::STATUS_INACTIVE => 'Inactive',
            self::STATUS_ACTIVE => 'Active',
        ];
    }

    /**
    * Get an array of users to use as select options.
    *
    * @param integer $user_id
    *   if given, restrict to a single user
    * @return array
    */
    public static function userOptions($user_id = NULL) {
        $users = [];

        if (is_numeric($user_id)) {
            $user = User::find($user_id);
            $users[$user->id] = $user->readableName();
        }
        else {
            foreach (User::all() as $user) {
                $users[$user->id] = $user->readableName();
            }
        }

        return $users;
    }

    /**
     * Get all roles asigned to this user
     *
     * @return mixed
     */
    public function getRoles() {
        $roles = $this->role->pluck('name', 'id')->toArray();
        return $roles;
    }

    /**
     * @return Collection|static[]
     */
    public static function getReporters()
    {
        $reporters = User::whereHas('role', function($q){
            $q->whereIn('roles.id', [Role::ROLE_ADMINISTRATOR, Role::ROLE_REPORTER]);
        })->get();

        return $reporters;
    }

    /**
     * @return Collection|static[]
     */
    public static function getOwners()
    {
        $owners = User::whereHas('role', function($q){
            $q->whereIn('roles.id', [Role::ROLE_ADMINISTRATOR, Role::ROLE_OWNER]);
        })->get();

        return $owners;
    }

    public static function getReviewers()
    {
        $reviewers = User::whereHas('role', function($q){
            $q->whereIn('roles.id', [Role::ROLE_ADMINISTRATOR, Role::ROLE_OWNER]);
        })->get();
        return $reviewers;
    }

    public static function getClosers()
    {
        $closers = User::whereHas('role', function($q){
            $q->whereIn('roles.id', [Role::ROLE_ADMINISTRATOR, Role::ROLE_OWNER]);
        })->get();
        return $closers;
    }

    /**
     * Get all users with the given role
     *
     * @return Collection|static[]
     */
    public static function getHealthTechs()
    {
        $healthtechs = User::whereHas('role', function($q){
            $q->whereIn('roles.id', [Role::ROLE_HEALTHTECH]);
        })->get();
        return $healthtechs;
    }

    /**
     * Determine if this user has a given role
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role)
    {
        return in_array($role, array_fetch($this->getRoles(), 'name'));
    }

    /**
    * Determine if this user has been awarded a given permission.
    *
    * @param string
    *   the name of the permission
    * @return boolean
    *   TRUE if the current user has been awarded the permission
    */
    public function isAllowedTo($name)
    {
        $roles = $this->getRoles();
        if (array_key_exists(Role::ROLE_ADMINISTRATOR, $roles)) {
            return true;
        }
        foreach($roles as $key => $value) {
            $allowed = RolePermission::where([
                'role_id' => $key,
                'permission_id' => $this->getPermissionId($name),
            ])->first();
            if (true === (bool)$allowed) {
                return true;
            }
        }

        return (bool)$allowed;
    }

    /**
     * Private method used by isAllowedTo()
     *
     * @param $name
     * @return int
     */
    private function getPermissionId($name)
    {
        $pid = Permission::where([
            'name' => $name,
        ])->pluck('permission_id')->first();

        return (int)$pid;
    }

    /**
    * Determine if this user has a given role.
    *
    * @param int $role_id
    *   the role_id of the role
    * @return boolean
    *   TRUE if the current user has the role
    */
    public function isRole($role_id) {
        if (array_key_exists($role_id, $this->getRoles())) {
            return true;
        }
        return false;
    }


    public function reportassigned()
    {
        return $this->hasOne('App\Models\Report', 'assigned_to', 'id');
    }

    public function reportentered()
    {
        return $this->hasOne('App\Models\Report', 'reporter_id', 'id');
    }

    public function reportreviewed()
    {
        return $this->hasOne('App\Models\Report', 'reviewed_by', 'id');
    }

    public function reportowned()
    {
        return $this->hasOne('App\Models\Report', 'owner_id', 'id');
    }

    public function review()
    {
        return $this->hasMany('App\Models\Report', 'reviewed_by', 'id');
    }



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function role()
    {
        return $this->belongsToMany('App\Models\Role', 'users_roles', 'user_id', 'role_id')->select('roles.id', 'name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function group()
    {
        return $this->hasOne('App\Models\Group', 'id', 'group_id');
    }
}
