<?php

namespace App\Http\Controllers;

use App\Models\AnimalType;
use App\Models\AnimalSubtype;
use App\Models\ConcernQuality;
use App\Models\Role;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getAnimalSubtypes(Request $request) {
        if($request->ajax() && isset($request->animal_type_id)){
            $subtypes = AnimalSubtype::filterByType($request->animal_type_id);
            $data = view('report.animalsubtype',compact('subtypes'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function getRooms(Request $request) {
        if($request->ajax() && isset($request->building_id)){
            $rooms = Room::filterByBuilding($request->building_id);
            $data = view('report.room',compact('rooms'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function getConcernQualities(Request $request) {
        if($request->ajax() && isset($request->animal_type_id)){
            $animaltype = AnimalType::find($request->animal_type_id);
            $qualities = $animaltype->concernquality->pluck('name', 'id');
            $data = view('report.concernquality', compact('qualities'))->render();
            return response()->json(['options'=>$data]);
        }
    }

    public function getConcernLocations(Request $request) {
        if($request->ajax() && isset($request->concern_quality_id)){
            $quality = ConcernQuality::find($request->concern_quality_id);
            $locations = $quality->concernlocation->pluck('name', 'id');
            $data = view('report.concernlocation',compact('locations'))->render();
            return response()->json(['options'=>$data]);
        }
    }


    public function getReviewers(Request $request) {
        if($request->ajax()){
            $reviewers = User::getReviewers();

            $data = view('review.reviewer',compact('reviewers'))->render();
            return response()->json(['options'=>$data]);
        }
    }
}
