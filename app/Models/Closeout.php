<?php

namespace App\Models;

use App\Traits\Encryptable;


class Closeout extends AppModel
{

    use Encryptable;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'report_id',
        'comments',
        'closed_by',
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

    public function closedby()
    {
        return $this->belongsTo('App\Models\User', 'closed_by', 'id');
    }

    public function report()
    {
        return $this->belongsTo('App\Models\Report');
    }
}
