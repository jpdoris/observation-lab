<?php

namespace App\Models;

class ConcernQualityAnimalType extends AppModel
{

    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'concern_quality_animal_type';

    /**
     * The primary key of the roles table.
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'concern_quality_id',
        'animal_type_id',
    ];

    /**
     * @see AppModel::readableName().
     */
    public function readableName() {
        return $this->id;
    }

    public function concernquality()
    {
        return $this->hasMany('App\Models\ConcernQuality', 'id', 'concern_quality_id');
    }

    public function animaltype()
    {
        return $this->hasMany('App\Models\AnimalType', 'id');
    }
}
