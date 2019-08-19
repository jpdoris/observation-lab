<?php

namespace App\Models;

use App\Traits\Encryptable;

class ConcernLocation extends AppModel
{
    use Encryptable;

    /**
     * Enum val for Concern Locations
     */
    const CONCERN_LOCATION_FACE = 1;
    const CONCERN_LOCATION_NOSE = 2;
    const CONCERN_LOCATION_NECK = 3;
    const CONCERN_LOCATION_TAIL = 4;
    const CONCERN_LOCATION_LEG_RF = 5;
    const CONCERN_LOCATION_LEG_LF = 6;
    const CONCERN_LOCATION_LEG_RR = 7;
    const CONCERN_LOCATION_LEG_LR = 8;
    const CONCERN_LOCATION_FOOT_RF = 9;
    const CONCERN_LOCATION_FOOT_LF = 10;
    const CONCERN_LOCATION_FOOT_RR = 11;
    const CONCERN_LOCATION_FOOT_LR = 12;
    const CONCERN_LOCATION_R = 13;
    const CONCERN_LOCATION_L = 14;
    const CONCERN_LOCATION_CHEST = 15;
    const CONCERN_LOCATION_ABDOMEN = 16;
    const CONCERN_LOCATION_BACK = 17;
    const CONCERN_LOCATION_RUMP = 18;
    const CONCERN_LOCATION_HEAD = 19;
    const CONCERN_LOCATION_CIRCLING = 20;
    const CONCERN_LOCATION_HEAD_TILT = 21;

    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'concern_locations';

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
     * Attributes that can be encrypted.
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
    public static function filterByQuality($parentId)
    {
        $parent = ConcernQuality::find($parentId);
        return $parent->concernlocation->all();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
//    public function concernQualityLocation()
//    {
//        return $this->belongsToMany('App\Models\ConcernQualityLocation', 'concern_quality_location', 'concern_location_id', 'id')
//            ->withPivot('name');
//    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function concernquality()
    {
        return $this->belongsToMany('App\Models\ConcernQuality', 'concern_quality_location', 'concern_location_id', 'concern_quality_id');
    }
}
