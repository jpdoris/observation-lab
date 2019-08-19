<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Status;
use Illuminate\Http\Request;

class DashboardController extends Controller
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


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $statusIds = [
            'reported' => Status::STATUS_REPORTED,
            'reviewed' => Status::STATUS_REVIEWED,
            'treatment' => Status::STATUS_TREATMENT,
            'closed' => Status::STATUS_CLOSED,
        ];

        $sort_options = $this->getSortOptions();

        $activeReports = Report::where('status_id', '!=', Status::STATUS_CLOSED)
            ->with('patient', 'concernquality', 'concernlocation', 'status', 'assignedto')
            ->orderBy($sort_options['reports']['sortby'], $sort_options['reports']['order'])
            ->paginate(5);
        $closedReports = Report::where('status_id', '=', Status::STATUS_CLOSED)
            ->with('patient', 'concernquality', 'concernlocation', 'status', 'assignedto')
            ->orderBy($sort_options['history']['sortby'], $sort_options['history']['order'])
            ->take(20)
            ->get();
        return view('dashboard', ['activeReports' => $activeReports, 'closedReports' => $closedReports,
            'status' => $statusIds, 'sort_options' => $sort_options]);
    }

    /**
     * Show the application history dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $statusIds = [
            'reported' => Status::STATUS_REPORTED,
            'reviewed'=> Status::STATUS_REVIEWED,
            'treatment' => Status::STATUS_TREATMENT,
            'closed' => Status::STATUS_CLOSED,
        ];

        $sort_options = $this->getSortOptions();

        $closedReports = Report::where('status_id', '=', Status::STATUS_CLOSED)
            ->with('patient', 'concernquality', 'concernlocation', 'status', 'assignedto')
            ->orderBy($sort_options['history']['sortby'], $sort_options['history']['order'])
            ->paginate(10);
        return view('history', ['status' => $statusIds, 'closedReports' => $closedReports, 'sort_options' => $sort_options]);
    }

    public function getSortOptions()
    {
        $sort_options = [];

        // replace sorting options from cookie values
        if (array_key_exists('sort_options', $_COOKIE) && null !== $_COOKIE['sort_options']) {
            $sort_options = json_decode($_COOKIE['sort_options'], JSON_OBJECT_AS_ARRAY );
        } else {
            // set default sorting options as array
            $sort_options = [
                'reports' => [
                    'sortby' => 'created_at',
                    'order' => 'asc',
                    'reverse' => 'desc',
                    'arrow' => 'up',
                ],
                'history' => [
                    'sortby' => 'updated_at',
                    'order' => 'asc',
                    'reverse' => 'desc',
                    'arrow' => 'down',
                ]
            ];
        }

        return $sort_options;
    }
}
