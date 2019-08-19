<?php

namespace App\Models;

use App\Traits\Encryptable;

class AnimalSubtype extends AppModel
{

    use Encryptable;

    /**
     * Enum val for animal subtypes
     */
    const ANIMAL_SUBTYPE_RAT = 1;
    const ANIMAL_SUBTYPE_MOUSE = 2;
    const ANIMAL_SUBTYPE_CANINE = 3;
    const ANIMAL_SUBTYPE_NHP = 4;

    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'animal_subtypes';

    /**
     * The primary key of the roles table.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = ['animal_type_id', 'name'];

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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function animaltype()
    {
        return $this->hasOne('App\Models\AnimalType', 'id', 'animal_type_id');
    }

    /**
     * @param $type
     * @return \Illuminate\Support\Collection
     */
    public static function filterByType($type)
    {
        $options = self::all()->where('animal_type_id', $type)->pluck('name', 'id');
        return $options;
    }

    /**
     * @param $parentId
     * @return mixed
     */
    public static function collectionByType($parentId)
    {
        return self::all()->where('animal_type_id', $parentId);
    }
}
