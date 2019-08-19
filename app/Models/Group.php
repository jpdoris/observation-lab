<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Encryptable;

class Group extends AppModel
{

    use Encryptable;

    /**
     * Enum value for a user in the "Medicine" role.
     * @const integer
     */
    const GROUP_MEDICINE = 1;

    /**
     * Enum value for a user in the "Medicine" role.
     * @const integer
     */
    const GROUP_OPERATIONS = 2;

    /**
     * Enum value for a user in the "Medicine" role.
     * @const integer
     */
    const GROUP_VETERINARIAN = 3;

    /**
     * The machine name of the groups table.
     * @var string
     */
    protected $table = 'groups';

    /**
     * The primary key of the groups table.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * List of attributes that may be encrypted before writing to
     *   the database.
     *
     * @var array
     */
    protected $encryptable = [
        'name',
    ];

    /**
     * @see AppModel::readableName().
     */
    public function readableName() {
        return $this->name;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
