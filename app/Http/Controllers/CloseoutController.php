<?php

namespace App\Http\Controllers;

use App\Mail\ReportClosed;
use App\Models\Closeout;
use App\Models\Report;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CloseoutController extends Controller
{
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

        $closeout = new Closeout();
        $closers = User::getClosers();

        return view('closeout.create', ['report_id' => $report_id, 'report' => $report, 'closeout' => $closeout, 'closers' => $closers, 'history' => $history]);
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
            'report_id'    => 'required',
            'comments'     => 'required',
            'closed_by'    => 'required',
        ]);

        // store
        $statusSearch = "Closed";
        $status = Status::all()->filter(function($record, $key) use($statusSearch) {
            return $record->name == $statusSearch;
        });

        $report = Report::find($request->report_id);
        $report->update([
            'status_id' => $status->pluck('id')->first(),
            'assigned_to' => null
        ]);
        Closeout::create($request->all());

        // generate email and redirect
        $owner = $report->owner;
        $reporter = $report->reportedby;
        $healthtechs = User::getHealthTechs();
        $recipients = $healthtechs->push($reporter)->push($owner);
        $closedby = User::find($request->closed_by);

        Mail::to($recipients)
            ->send(new ReportClosed($report, $closedby));
        $request->session()->flash('success', 'Report closed out successfully.');
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
        $closeout = Closeout::find($id);
        $report_id = $closeout->pluck('report_id')->get();
        $report = Report::with('patient', 'building', 'room', 'concernquality', 'concernlocation', 'status', 'assignedto', 'reviewedby')->find($report_id);
        return view('closeout.edit', ['report_id' => $report_id, 'report' => $report, 'id' => $id, 'closeout' => $closeout]);
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
