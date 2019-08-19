<?php

namespace App\Models;

use App\Traits\Encryptable;


class Reporter extends AppModel
{

    use Encryptable;

    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'reporters';

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
     * Attrbiutes that can be encrypted.
     * @var array
     */
    protected $encryptable = ['name'];
    /**
     * @see AppModel::readableName().
     */
    public function readableName() {
        return $this->name;
    }

}
