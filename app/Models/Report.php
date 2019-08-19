<?php

namespace App\Models;


class Report extends AppModel
{

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'status_id',
        'assigned_to',
        'patient_id',
        'animal_type_id',
        'animal_subtype_id',
        'building_id',
        'room_id',
        'owner_id',
        'study_id',
        'concern_quality_id',
        'concern_location_id',
        'reporter_id'
    ];

    /**
     * Get an array of the animal types available to select.
     *
     * @return array
     */
    public static function animalTypeOptions()
    {
        $options = [
            AnimalType::ANIMAL_TYPE_SMALL => AnimalType::where('id', AnimalType::ANIMAL_TYPE_SMALL)->first()->readableName(),
            AnimalType::ANIMAL_TYPE_LARGE => AnimalType::where('id', AnimalType::ANIMAL_TYPE_LARGE)->first()->readableName(),
        ];

        return $options;
    }

    public static function animalSubtypes($type)
    {
        $options = AnimalSubtype::all(['id', 'name'])->where('animal_type_id', $type)->pluck('id', 'name');
        return $options;
    }

    /**
     * Get an array of the animal types available to select.
     *
     * @return array
     */
    public static function patientOptions()
    {
        $options = Patient::all(['id', 'name'])->pluck('id', 'name');
        return $options;
    }

    public function getOwner()
    {
     return User::where('id', '=', $this->value('owner_id'))->get();
    }

    /**
     * Get historical action items from this report record
     *
     * @return mixed
     */
    public static function getHistory($report_id)
    {
        $reporthistory = Report::with('review', 'treatment', 'closeout')->find($report_id);
        $reviewhistory = $reporthistory->review;
        $treatmenthistory = $reporthistory->treatment;
        $closeouthistory = $reporthistory->closeout;
        $merged = $reviewhistory->push($treatmenthistory)->push($closeouthistory);
        $history = $merged->flatten()->sortBy('created_at');
        return $history;
    }

    public function readableName()
    {
        return $this->name;
    }

    public function assignedto()
    {
        return $this->belongsTo('App\Models\User', 'assigned_to', 'id');
    }

    public function reportedby()
    {
        return $this->belongsTo('App\Models\User', 'reporter_id', 'id');
    }

    public function reviewedby()
    {
        return $this->belongsTo('App\Models\User', 'reviewed_by', 'id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status')->select('id', 'name');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient', 'patient_id')->select('id', 'name');
    }

    public function animalType()
    {
        return $this->belongsTo('App\Models\AnimalType')->select('id', 'name');
    }

    public function animalSubtype()
    {
        return $this->belongsTo('App\Models\AnimalSubtype')->select('id', 'name');
    }

    public function building()
    {
        return $this->belongsTo('App\Models\Building')->select('id', 'name');
    }

    public function room()
    {
        return $this->belongsTo('App\Models\Room')->select('id', 'name');
    }

    public function owner()
    {
        return $this->belongsTo('App\Models\User', 'owner_id');
    }

    public function study()
    {
        return $this->belongsTo('App\Models\Study')->select('id', 'name');
    }

    public function concernQuality()
    {
        return $this->belongsTo('App\Models\ConcernQuality')->select('id', 'name');
    }

    public function concernLocation()
    {
        return $this->belongsTo('App\Models\ConcernLocation')->select('id', 'name');
    }

    public function reporter()
    {
        return $this->belongsTo('App\Models\Reporter')->select('id', 'name');
    }


    public function review()
    {
        return $this->hasMany('App\Models\Review')->orderBy('reviews.updated_at');
    }
    public function treatment()
    {
        return $this->hasMany('App\Models\Treatment')->orderBy('treatments.updated_at');
    }
    public function closeout()
    {
        return $this->hasMany('App\Models\Closeout')->orderBy('closeouts.updated_at');
    }
}
