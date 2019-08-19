<?php

namespace App\Models;

use App\Traits\Encryptable;

class Status extends AppModel
{
    use Encryptable;

    /**
     * enum values for 'Reported' status
     */
    const STATUS_REPORTED   = 1;

    /**
     * enum values for 'Reviewed' status
     */
    const STATUS_REVIEWED   = 2;

    /**
     * enum values for 'Treatment' status
     */
    const STATUS_TREATMENT  = 3;

    /**
     * enum values for 'Closed' status
     */
    const STATUS_CLOSED     = 4;


    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'statuses';

    /**
     * The primary key of the roles table.
     * @var string
     */
    protected $primaryKey = 'id';

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $visible = [
        'id',
        'name',
    ];

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * The attributes that are encryptable.
     * @var array
     */
    protected $encryptable = ['name'];

    /**
     * @see AppModel::readableName().
     */
    public function readableName() {
        return $this->name;
    }

    public function report()
    {
        return $this->hasOne('App\Models\Report');
    }
}
