<?php

namespace App\Http\Controllers;

use App\Models\AnimalSubtype;
use App\Models\AnimalType;
use App\Models\Building;
use App\Models\ConcernQuality;
use App\Models\ConcernLocation;
use App\Models\Patient;
use App\Models\Report;
use App\Models\Room;
use App\Models\Status;
use App\Models\Study;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\Encryptable;
use App\Mail\ReportCreated;
use Illuminate\Support\Facades\Mail;
use Validator;

class ReportController extends Controller
{

    use Encryptable;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('report');
    }


    /**
     * Show the form for creating a new report resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $report = new Report();
        $report->reporter_id = (int)auth()->user()->id;

        $lookups = [
            'patients' => Patient::all(),
            'animaltypes' => AnimalType::all(),
            'animalsubtypes' => [],
            'buildings' => Building::all(),
            'rooms' => [],
            'owners' => User::getOwners(),
            'studies' => Study::all(),
            'concernqualities' => [],
            'concernlocations' => [],
            'reporters' => User::getReporters(),
        ];

        if (old('animal_type_id')) {
            $lookups['animalsubtypes'] = AnimalSubtype::collectionByType(old('animal_type_id'));
            $lookups['concernqualities'] = ConcernQuality::filterByAnimalType(old('animal_type_id'));
        }
        if (old('building_id')) {
            $lookups['rooms'] = Room::collectionByBuilding(old('building_id'));
        }
        if (old('concern_quality_id')) {
            $lookups['concernlocations'] = ConcernLocation::filterByQuality(old('concern_quality_id'));
        }

        return view('report.create', ['id' => null, 'report' => $report, 'lookups' => $lookups]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        $this->validate($request, [
            'patient-name' => 'required',
            'animal_type_id' => 'required',
            'animal_subtype_id' => 'required',
            'building_id' => 'required',
            'room_id' => 'required',
            'owner_id' => 'required',
            'study-name' => 'required',
            'concern_quality_id' => 'required',
        ]);

        // set
        $report = new Report();
        $status_id = Status::find(Status::STATUS_REPORTED)->value('id');
        $patient_id = $request->input('patient');
        $study_id = $request->input('study');

        // check for new autocomplete values - need to insert those to their tables
        $patientMatch = Patient::checkExisting($request->input('patient-name'));
        if ($patientMatch !== false) {
            $patient_id = $patientMatch;
        } else {
            $insert = Patient::create(['name' => $request->input('patient-name')]);
            $patient_id = $insert->id;
        }

        $studyMatch = Study::checkExisting($request->input('study-name'));
        if ($studyMatch !== false) {
            $study_id = $studyMatch;
        } else {
            $insert = Study::create(['name' => $request->input('study-name')]);
            $study_id = $insert->id;
        }

        // store
        $report->status_id              = $status_id;
        $report->patient_id             = $patient_id;
        $report->animal_type_id         = $request->input('animal_type_id');
        $report->animal_subtype_id      = $request->input('animal_subtype_id');
        $report->building_id            = $request->input('building_id');
        $report->room_id                = $request->input('room_id');
        $report->owner_id               = $request->input('owner_id');
        $report->study_id               = $study_id;
        $report->concern_quality_id     = $request->input('concern_quality_id');
        $report->concern_location_id    = $request->input('concern_location_id') !== "" ? $request->input('concern_location_id') : null;
        $report->reporter_id            = $request->input('reporter_id');
        $report->save();

        // generate email and redirect
        $mailTo = User::where('id', $report->owner_id)->get();
        $mailCc = User::getHealthTechs();
        $createdReport = Report::find($report->id);
        Mail::to($mailTo)
            ->cc($mailCc)
            ->send(new ReportCreated($createdReport));
        $request->session()->flash('success', 'Report created successfully.');
        return redirect('/dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::with('review', 'treatment', 'closeout')->find($id);
        $history = Report::getHistory($id);
        if ($report) {
            return view('report.show', ['id' => $id, 'report' => $report, 'history' => $history]);
        }
        return redirect('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);

        if ($report->status->name == "Closed") {
            return redirect(route('dashboard'));
        }

        $lookups = [
            'patients' => Patient::all(),
            'animaltypes' => AnimalType::all(),
            'animalsubtypes' => AnimalSubtype::where('animal_type_id', $report->animal_type_id)->get(),
            'buildings' => Building::all(),
            'rooms' => Room::where('building_id', $report->building_id)->get(),
            'owners' => User::getOwners(),
            'studies' => Study::all(),
            'concernqualities' => ConcernQuality::select('concern_qualities.name','concern_qualities.id')
                ->join('concern_quality_animal_type','concern_quality_animal_type.concern_quality_id', '=', 'concern_qualities.id')
                ->where('animal_type_id', $report->animal_type_id)
                ->get(),
            'concernlocations' => ConcernLocation::select('concern_locations.name', 'concern_locations.id')
                ->join('concern_quality_location', 'concern_quality_location.concern_location_id', '=', 'concern_locations.id')
                ->where('concern_quality_id', $report->concern_quality_id)
                ->get(),
            'reporters' => User::getReporters(),
        ];

        return view('report.edit', ['id' => $id, 'report' => $report, 'lookups' => $lookups]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate
        $this->validate($request, [
            'patient-name'      => 'required',
            'animal_type_id'    => 'required',
            'animal_subtype_id' => 'required',
            'building_id'       => 'required',
            'room_id'           => 'required',
            'owner_id'          => 'required',
            'study-name'        => 'required',
            'concern_quality_id'=> 'required',
        ]);

        // store
        $report = Report::find($id);
        $status_id = Status::find(Status::STATUS_REPORTED)->value('id');
        $patient_id = $request->input('patient');
        $study_id = $request->input('study');

        // check for new autocomplete values - need to insert those to their tables
        $patientMatch = Patient::checkExisting($request->input('patient-name'));
        if ($patientMatch !== false) {
            $patient_id = $patientMatch;
        } else {
            $insert = Patient::create(['name' => $request->input('patient-name')]);
            $patient_id = $insert->id;
        }

        $studyMatch = Study::checkExisting($request->input('study-name'));
        if ($studyMatch !== false) {
            $study_id = $studyMatch;
        } else {
            $insert = Study::create(['name' => $request->input('study-name')]);
            $study_id = $insert->id;
        }

        $report->status_id              = $status_id;
        $report->patient_id             = $patient_id;
        $report->animal_type_id         = $request->input('animal_type_id');
        $report->animal_subtype_id      = $request->input('animal_subtype_id');
        $report->building_id            = $request->input('building_id');
        $report->room_id                = $request->input('room_id');
        $report->owner_id               = $request->input('owner_id');
        $report->study_id               = $study_id;
        $report->concern_quality_id     = $request->input('concern_quality_id');
        $report->concern_location_id    = $request->input('concern_location_id') !== "" ? $request->input('concern_location_id') : null;
        $report->reporter_id            = $request->input('reporter_id');
        $report->save();

        // redirect
        $request->session()->flash('success', 'Report updated successfully.');
        return redirect(route('dashboard'));
    }

    /**
     * Assign report to authenticated user from Dashboard
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assign(Request $request) {
        if ($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'report_id'  => 'required',
                'user_id'    => 'required',
            ]);

            if ($validator->passes()) {
                $report_id = $request->report_id;
                $user_id = $request->user_id;
                $report = Report::find($report_id);
                $report->update(['assigned_to' => $user_id]);
                $report->save();

                return response()->json(['success' => 'Options saved.', 'username' => $report->assignedto->readableName()]);
            }
        }
        return response()->json(['error' => $validator->errors()->all()]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
