<?php

namespace App\Models;


class ConcernQualityLocation extends AppModel
{

    /**
     * The machine name of the roles table.
     * @var string
     */
    protected $table = 'concern_quality_location';

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
        'concern_location_id',
    ];

    /**
     * @see AppModel::readableName().
     */
    public function readableName() {
        return $this->id;
    }

    public function concernQuality()
    {
        return $this->hasMany('App\Models\ConcernQuality', 'id');
    }

    public function concernLocation()
    {
        return $this->hasMany('App\Models\ConcernLocation', 'id');
    }
}
