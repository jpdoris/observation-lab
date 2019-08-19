<?php

namespace App\Models;


class Owner extends AppModel
{

    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'owners';

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
     * @see AppModel::readableName().
     */
    public function readableName() {
        return $this->name;
    }

}
