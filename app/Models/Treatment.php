<?php

namespace App\Models;

use App\Traits\Encryptable;


class Treatment extends AppModel
{

    use Encryptable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'report_id',
        'treatment',
        'treated_by',
    ];

    /**
     * Attributes that can be encrypted.
     * @var array
     */
    protected $encryptable = [
        'treatment'
    ];

    public function readableName()
    {
        // TODO: Implement readableName() method.
    }

    public function report()
    {
        return $this->belongsTo('App\Models\Report');
    }

    public function treatedby()
    {
        return $this->belongsTo('App\Models\User', 'treated_by', 'id');
    }

}
