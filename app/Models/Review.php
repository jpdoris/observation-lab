<?php

namespace App\Models;

use App\Traits\Encryptable;


class Review extends AppModel
{

    use Encryptable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'report_id',
        'comments',
        'reviewed_by',
    ];

    /**
     * Attributes that can be encrypted.
     * @var array
     */
    protected $encryptable = ['comments'];

    public function readableName()
    {
        // TODO: Implement readableName() method.
    }


    public function report()
    {
        return $this->belongsTo('App\Models\Report');
    }

    public function reviewedby()
    {
        return $this->belongsTo('App\Models\User', 'reviewed_by', 'id');
    }
}
