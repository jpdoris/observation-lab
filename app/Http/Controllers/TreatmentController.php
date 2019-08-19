<?php

namespace App\Http\Controllers;

use App\Mail\TreatmentAdded;
use App\Models\Treatment;
use App\Models\Report;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\Encryptable;
use Illuminate\Support\Facades\Mail;

class treatmentController extends Controller
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

    public function check($id)
    {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($report_id)
    {
        $report = Report::with('patient', 'building', 'room', 'concernquality', 'concernlocation', 'status', 'assignedto', 'reviewedby')->find($report_id);
        $history = Report::getHistory($report_id);
        $healthtechs = User::getHealthTechs();
        $treatment = new Treatment();


        return view('treatment.create', ['report_id' => $report_id, 'report' => $report, 'treatment' => $treatment, 'history' => $history, 'healthtechs' => $healthtechs]);
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
            'report_id'     => 'required',
            'treatment'     => 'required',
            'treated_by'    => 'required',
        ]);

        // store
        $statusSearch = "Treatment";
        $status = Status::all()->filter(function($record, $key) use($statusSearch) {
            return $record->name == $statusSearch;
        });

        $report = Report::find($request->report_id);
        $report->update([
            'status_id' => $status->pluck('id')->first(),
            'assigned_to' => null
        ]);
        Treatment::create($request->all());

        // generate email and redirect
        $owner = $report->owner;
        $reporter = $report->reportedby;
        $healthtechs = User::getHealthTechs();
        $recipients = $healthtechs->push($reporter)->push($owner);
        $treatedby = User::find($request->treated_by);

        Mail::to($recipients)
            ->send(new TreatmentAdded($report, $treatedby));
        $request->session()->flash('success', 'Treatment created successfully.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $treatment = Treatment::find($id);
        $report_id = $treatment->pluck('report_id')->get();
        $report = Report::with('patient', 'building', 'room', 'concernquality', 'concernlocation', 'status', 'assignedto', 'reviewedby')->find($report_id);
        $healthtechs = User::getHealthTechs();
        return view('treatment.edit', ['report_id' => $report_id, 'report' => $report, 'id' => $id, 'treatment' => $treatment, 'healthtechs' => $healthtechs]);
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
        //
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
