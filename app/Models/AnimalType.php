<?php

namespace App\Models;

use App\Traits\Encryptable;

class AnimalType extends AppModel
{

    use Encryptable;

    /**
     * Enum val for animal types
     */
    const ANIMAL_TYPE_SMALL = 1;
    const ANIMAL_TYPE_LARGE = 2;

    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'animal_types';

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
        return $this->belongsToMany('App\Models\Report');
    }

    public function animalsubtype()
    {
        return $this->belongsTo('App\Models\AnimalSubtype', 'animal_type_id');
    }

    public function concernquality()
    {
        return $this->belongsToMany('App\Models\ConcernQuality', 'concern_quality_animal_type', 'animal_type_id', 'concern_quality_id');
    }

    public function concernqualityanimaltype()
    {
        return $this->belongsToMany('App\Models\ConcernQualityAnimalType', 'concern_quality_animal_type', 'animal_type_id', 'id')
            ->withPivot('name');
    }
}
