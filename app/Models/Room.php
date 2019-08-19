<?php

namespace App\Models;

use App\Traits\Encryptable;


class Room extends AppModel
{

    use Encryptable;

    /**
     * Enum val for Room IDs
     */
    const ROOM_ONE = 1;
    const ROOM_TWO = 2;
    const ROOM_THREE = 3;
    const ROOM_FOUR = 4;
    const ROOM_FIVE = 5;
    const ROOM_SIX = 6;
    const ROOM_SEVEN = 7;

    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'rooms';

    /**
     * The primary key of the roles table.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['building_id', 'name'];

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

    public static function filterByBuilding($type)
    {
        $options = self::all()->where('building_id', $type)->pluck('name', 'id');
        return $options;
    }

    public static function collectionByBuilding($parentId)
    {
        return self::all()->where('building_id', $parentId);
    }

    public function building()
    {
        return $this->belongsTo('App\Models\Building');
    }
}
