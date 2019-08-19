<?php

namespace App\Models;

use App\Traits\Encryptable;


class ConcernQuality extends AppModel
{

    use Encryptable;

    /**
     * Enum val for Concern Qualities
     */
    const CONCERN_GENERAL_BODY_CONDITION = 1;
    const CONCERN_QUALITY_WEIGHT_LOSS_GAIN = 2;
    const CONCERN_QUALITY_FOOD_CONSUMPTION = 3;
    const CONCERN_QUALITY_BEHAVIOR = 4;
    const CONCERN_QUALITY_ACTIVITY_LEVEL = 5;
    const CONCERN_QUALITY_HAIR_LOSS = 6;
    const CONCERN_QUALITY_SKIN = 7;
    const CONCERN_QUALITY_BRUISING = 8;
    const CONCERN_QUALITY_VOMIT = 9;
    const CONCERN_QUALITY_FECES = 10;
    const CONCERN_QUALITY_URINE = 11;
    const CONCERN_QUALITY_WOUND = 12;
    const CONCERN_QUALITY_EYE = 13;
    const CONCERN_QUALITY_EAR = 14;
    const CONCERN_QUALITY_ORAL_CAVITY = 15;

    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'concern_qualities';

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
     * Atributes that are to be encrypted
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
     * @param $parentId
     * @return mixed
     */
    public static function filterByAnimalType($parentId)
    {
        $animaltype = AnimalType::find($parentId);
        return $animaltype->concernquality->all();
    }


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function report()
    {
        return $this->hasMany('App\Models\Report');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
//    public function concernqualitylocation()
//    {
//        return $this->belongsToMany('App\Models\ConcernQualityLocation', 'concern_quality_location', 'concern_quality_id', 'id')
//            ->withPivot('name');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function animaltype()
    {
        return $this->belongsToMany('App\Models\AnimalType', 'concern_quality_animal_type', 'concern_quality_id', 'animal_type_id')->select('animal_types.id', 'name');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function concernlocation()
    {
        return $this->belongsToMany('App\Models\ConcernLocation', 'concern_quality_location', 'concern_quality_id', 'concern_location_id');
    }
}
