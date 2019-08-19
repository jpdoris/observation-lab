<?php

namespace App\Models;

use App\Traits\Encryptable;


class Patient extends AppModel
{

    use Encryptable;

    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'patients';

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
     * Attributess that are encryptable.
     * @var array
     */
    protected $encryptable = ['name'];
    /**
     * @see AppModel::readableName().
     */

    public function readableName() {
        return $this->name;
    }

    /**
     * Get a trimmed, lowercase array of patient names
     *
     * @return array
     */
    public static function getAllNames()
    {
        $returnArray = [];
        $items = self::all();
        foreach($items as $item) {
            $returnArray[$item->id] = trim(strtolower($item->name));
        }
        return $returnArray;
    }

    /**
     * Check existing patient names against request input to prevent duplicates
     *
     * @param $input
     * @return false|int|string
     */
    public static function checkExisting($input)
    {
        $existingPatients = self::getAllNames();
        return array_search(trim(strtolower($input)), $existingPatients);
    }

    public function report()
    {
        return $this->hasOne('App\Models\Report');
    }

}
