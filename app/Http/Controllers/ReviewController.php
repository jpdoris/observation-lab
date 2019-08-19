<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Report;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\ReviewAdded;
use Illuminate\Support\Facades\Mail;
use App\Traits\Encryptable;

class ReviewController extends Controller
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
        $report = Report::with('status')->find($id);

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
        $report = Report::with('patient', 'building', 'room', 'concernquality', 'concernlocation',
            'status', 'assignedto', 'reviewedby')
                ->find($report_id);

        $history = Report::getHistory($report_id);
        $review = new Review();
        $reviewers = User::getReviewers();

        return view('review.create', ['report_id' => $report_id, 'report' => $report, 'review' => $review, 'reviewers' => $reviewers, 'history' => $history]);
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
            'reviewed_by'  => 'required',
        ]);

        // store
        $statusSearch = "Reviewed";
        $status = Status::all()->filter(function($record, $key) use($statusSearch) {
            return $record->name == $statusSearch;
        });

        $report = Report::find($request->report_id);
        $report->update([
            'status_id' => $status->pluck('id')->first(),
            'assigned_to' => null
        ]);
        Review::create($request->all());

        // generate email and redirect
        $owner = $report->owner;
        $reporter = $report->reportedby;
        $healthtechs = User::getHealthTechs();
        $recipients = $healthtechs->push($reporter)->push($owner);
        $reviewer = User::find($request->reviewed_by);

        Mail::to($recipients)
            ->send(new ReviewAdded($report, $reviewer));
        $request->session()->flash('success', 'Review created successfully.');
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
        $review = Review::find($id);
        $report_id = $review->pluck('report_id')->get();
        $report = Report::with('patient', 'building', 'room', 'concernquality', 'concernlocation', 'status', 'assignedto', 'reviewedby')->find($report_id);
        return view('review.edit', ['report_id' => $report_id, 'report' => $report, 'id' => $id, 'treatment' => $review]);
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
