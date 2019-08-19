<?php

namespace App\Models;

use App\Traits\Encryptable;


class Building extends AppModel
{

    use Encryptable;

    /**
     * Enum val for Building IDs
     */
    const BUILDING_ONE = 1;
    const BUILDING_TWO = 2;
    const BUILDING_THREE = 3;
    const BUILDING_FOUR = 4;
    const BUILDING_FIVE = 5;
    const BUILDING_SIX = 6;

    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'buildings';

    /**
     * The primary key of the roles table.
     * @var string
     */
    protected $primaryKey = 'id';

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

    public function room()
    {
        return $this->hasMany('App\Models\Room');
    }
}
