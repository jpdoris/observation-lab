<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\AnimalType;
use App\Models\AnimalSubtype;
use App\Models\Building;
use App\Models\Report;
use App\Models\Room;
use App\Models\Status;
use App\Models\Study;
use App\Models\ConcernQuality;
use App\Models\ConcernLocation;
use App\Models\Role;
use App\Traits\Encryptable;
use Illuminate\Http\Request;
use Validator;

class OptionsController extends Controller
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
        $this->middleware('role:' . Role::ROLE_ADMINISTRATOR);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('manage.options.index');
    }

    /**
     * Get and return model data to reload modal body on change
     * @param $field
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function getModalData($field)
    {
        $data = [];
        $model = "App\Models\\" . $field;
        if (class_exists($model)) {
            if ($field == "AnimalSubtype") {
                $data = [
                    'animaltype' => AnimalType::all(),
                    'animalsubtype' => AnimalSubtype::all(),
                ];
            }
            elseif ($field == "ConcernQuality") {
                $data = [
                    'animaltype' => AnimalType::all(),
                    'concernquality' => ConcernQuality::all(),
                ];
            }
            elseif ($field == "ConcernLocation") {
                $data = [
                    'concernquality' => ConcernQuality::all(),
                    'concernlocation' => ConcernLocation::all(),
                ];
            }
            elseif ($field == "Room") {
                $data = [
                    'building' => Building::all(),
                    'room' => Room::all(),
                ];
            } else {
                $lcfield = strtolower($field);
                $data = [
                    $lcfield => $model::all(),
                ];
            }

            return view('manage.options.modal.' . $field, ['fields' => $data]);
        }

        return response(abort(404));
    }

    /**
     * Get and return model data to reload modal body on change
     * @param $field
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function getNonModalData($field)
    {
        $data = [];
        $field = ucfirst($field);
        $model = "App\Models\\" . $field;
        if (class_exists($model)) {
            if ($field == "AnimalSubtype") {
                $data = [
                    'animaltype' => AnimalType::all(),
                    'animalsubtype' => AnimalSubtype::all(),
                ];
            }
            elseif ($field == "ConcernQuality") {
                $data = [
                    'animaltype' => AnimalType::all(),
                    'concernquality' => ConcernQuality::all(),
                ];
            }
            elseif ($field == "ConcernLocation") {
                $data = [
                    'concernquality' => ConcernQuality::all(),
                    'concernlocation' => ConcernLocation::all(),
                ];
            }
            elseif ($field == "Room") {
                $data = [
                    'building' => Building::all(),
                    'room' => Room::all(),
                ];
            } else {
                $lcfield = strtolower($field);
                $data = [
                    $lcfield => $model::all(),
                ];
            }
            return view('manage.options.edit', ['field' => $field, 'fields' => $data]);
        }

        return response(abort(404));
    }

    /**
     * Get concern qualities for given location
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getConcernQualityLocation(Request $request, $id)
    {
        if($request->ajax()){
            $data = [];
            $name = [];
            $checked = [];
            $matches = [];

            $qualitiesAll = ConcernQuality::all('id', 'name');
            if (false === stristr($id, 'new')) {
                $location = ConcernLocation::find($id);
                $matches = $location->concernquality()->pluck( 'concern_quality_id')->toArray();
            }

            foreach ($qualitiesAll as $quality) {
                $name[$quality->id] = $quality->name;
                $checked[$quality->id] = (in_array($quality->id, $matches) ? 'checked' : '');
            }

            return response()->json(['name' => $name, 'checked' => $checked]);
        }
        return response()->json(['error' => 'Invalid data sent.']);

    }
    
    /**
     * Store a newly created concern quality in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeConcernQuality(Request $request)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'concern_quality_name'  => 'required|string',
                'animal_type_id'        => 'required|array',
            ]);

            // store
            if ($validator->passes()) {
                $quality = ConcernQuality::create(['name' => $request->concern_quality_name]);
                $quality->animaltype()->sync($request->animal_type_id);

                return response()->json(['success' => 'Options saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Store a newly created concern location in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeConcernLocation(Request $request)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'concern_location_name' => 'required|string',
                'concern_quality_id'    => 'required|array',
            ]);

            // store
            if ($validator->passes()) {
                $location = ConcernLocation::create(['name' => $request->concern_location_name]);
                $location->concernquality()->sync($request->concern_quality_id);

                return response()->json(['success' => 'Options saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Store a newly created patient option in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePatient(Request $request)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'patient_name'  => 'required|string',
            ]);

            // store
            if ($validator->passes()) {
                $patient = Patient::create(['name' => $request->patient_name]);

                return response()->json(['success' => 'Option(s) saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Store a newly created animaltype option in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAnimalType(Request $request)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'animaltype_name'  => 'required|string',
            ]);

            // store
            if ($validator->passes()) {
                $animaltype = AnimalType::create(['name' => $request->animaltype_name]);

                return response()->json(['success' => 'Option(s) saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Store a newly created animal subtype in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAnimalSubtype(Request $request)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'animal_subtype_name'  => 'required|string',
                'animal_type_id'        => 'required|int',
            ]);

            // store
            if ($validator->passes()) {
                $subtype = AnimalSubtype::create([
                    'name' => $request->animal_subtype_name,
                    'animal_type_id' => $request->animal_type_id,
                ]);

                return response()->json(['success' => 'Options saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Store a newly created building option in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeBuilding(Request $request)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'building_name'  => 'required|string',
            ]);

            // store
            if ($validator->passes()) {
                $building = Building::create(['name' => $request->building_name]);

                return response()->json([
                    'success' => 'Option(s) saved.',
                    'option_id' => $building->id,
                    ]);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Store a newly created room in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRoom(Request $request)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'room_name'  => 'required|string',
                'building_id' => 'required|int',
            ]);

            // store
            if ($validator->passes()) {
                $room = Room::create([
                    'name' => $request->room_name,
                    'building_id' => $request->building_id,
                ]);

                return response()->json([
                    'success' => 'Options saved.',
                    'option_id' => $room->id,
                    ]);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Store a newly created study option in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStudy(Request $request)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'study_name'  => 'required|string',
            ]);

            // store
            if ($validator->passes()) {
                $study = Study::create(['name' => $request->study_name]);

                return response()->json(['success' => 'Option(s) saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Update the edited concern quality in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateConcernQuality(Request $request, $id)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'concern_quality_name'  => 'required|string',
                'animal_type_id'        => 'required|array',
            ]);

            // store
            if ($validator->passes()) {
                $quality                    = ConcernQuality::find($id);
                $quality->name              = $request->concern_quality_name;
                $quality->animaltype()->sync($request->animal_type_id);
                $quality->save();

                return response()->json(['success' => 'Options saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Update the edited concern location in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateConcernLocation(Request $request, $id)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'concern_location_name' => 'required|string',
            ]);

            // store
            if ($validator->passes()) {
                $location             = ConcernLocation::find($id);
                $location->name       = $request->concern_location_name;
                if (isset($request->concern_quality_id)) {
                    $location->concernquality()->sync($request->concern_quality_id);
                }
                $location->save();

                return response()->json(['success' => 'Options saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Update the edited patient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePatient(Request $request, $id)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'patient_name'  => 'required|string',
            ]);

            // store
            if ($validator->passes()) {
                $patient                    = Patient::find($id);
                $patient->name              = $request->patient_name;
                $patient->save();

                return response()->json(['success' => 'Option(s) saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Update the edited animaltype in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAnimalType(Request $request, $id)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'animaltype_name'  => 'required|string',
            ]);

            // store
            if ($validator->passes()) {
                $animaltype                    = AnimalType::find($id);
                $animaltype->name              = $request->animaltype_name;
                $animaltype->save();

                return response()->json(['success' => 'Option(s) saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Update the edited animal subtype in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAnimalSubtype(Request $request, $id)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'animal_subtype_name'  => 'required|string',
                'animal_type_id'        => 'required|int',
            ]);

            // store
            if ($validator->passes()) {
                $subtype                    = AnimalSubtype::find($id);
                $subtype->name              = $request->animal_subtype_name;
                $subtype->animal_type_id    = $request->animal_type_id;
                $subtype->save();

                return response()->json(['success' => 'Options saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Update the edited building in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateBuilding(Request $request, $id)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'building_name'  => 'required|string',
            ]);

            // store
            if ($validator->passes()) {
                $building                    = Building::find($id);
                $building->name              = $request->building_name;
                $building->save();

                return response()->json(['success' => 'Option(s) saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Update the edited room in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRoom(Request $request, $id)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'room_name'  => 'required|string',
                'building_id' => 'required|int',
            ]);

            // store
            if ($validator->passes()) {
                $room               = Room::find($id);
                $room->name         = $request->room_name;
                $room->building_id  = $request->building_id;
                $room->save();

                return response()->json(['success' => 'Options saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Update the edited study in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStudy(Request $request, $id)
    {
        if($request->ajax()){

            // validate
            $validator = Validator::make($request->all(), [
                'study_name'  => 'required|string',
            ]);

            // store
            if ($validator->passes()) {
                $study                    = Study::find($id);
                $study->name              = $request->study_name;
                $study->save();

                return response()->json(['success' => 'Option(s) saved.']);
            }
            return response()->json(['error' => $validator->errors()->all()]);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Delete a concern quality option
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteConcernQuality(Request $request, $id)
    {
        if($request->ajax()){
            $quality = ConcernQuality::find($id);
            $quality->animaltype()->detach();
            if ($this->checkBeforeDeleting('concern_quality_id', $id)) {
                return response()->json(['error' => 'This option is in use and cannot be deleted.']);
            }
            $quality->delete();
            return response()->json(['success' => 'Option deleted.']);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Delete a concern location option
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteConcernLocation(Request $request, $id)
    {
        if($request->ajax()){
            $location = ConcernLocation::find($id);
            $location->concernquality()->detach();
            if ($this->checkBeforeDeleting('concern_location_id', $id)) {
                return response()->json(['error' => 'This option is in use and cannot be deleted.']);
            }
            $location->delete();
            return response()->json(['success' => 'Option deleted.']);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Delete a patient option
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deletePatient(Request $request, $id)
    {
        if($request->ajax()){
            $patient = Patient::find($id);
            if ($this->checkBeforeDeleting('patient_id', $id)) {
                return response()->json(['error' => 'This option is in use and cannot be deleted.']);
            }
            $patient->delete();
            return response()->json(['success' => 'Option deleted.']);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Delete a animaltype option
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteAnimalType(Request $request, $id)
    {
        if($request->ajax()){
            $animaltype = AnimalType::find($id);
            if ($this->checkBeforeDeleting('animal_type_id', $id)) {
                return response()->json(['error' => 'This option is in use and cannot be deleted.']);
            }
            $animaltype->delete();
            return response()->json(['success' => 'Option deleted.']);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Delete a animal subtype option
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteAnimalSubtype(Request $request, $id)
    {
        if($request->ajax()){
            $subtype = AnimalSubtype::find($id);
            if ($this->checkBeforeDeleting('animal_subtype_id', $id)) {
                return response()->json(['error' => 'This option is in use and cannot be deleted.']);
            }
            $subtype->delete();
            return response()->json(['success' => 'Option deleted.']);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Delete a building option
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteBuilding(Request $request, $id)
    {
        if($request->ajax()){
            $building = Building::find($id);
            if ($this->checkBeforeDeleting('building_id', $id)) {
                return response()->json(['error' => 'This option is in use and cannot be deleted.']);
            }
            $building->delete();
            return response()->json(['success' => 'Option deleted.']);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Delete a room option
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteRoom(Request $request, $id)
    {
        if($request->ajax()){
            $room = Room::find($id);
            if ($this->checkBeforeDeleting('room_id', $id)) {
                return response()->json(['error' => 'This option is in use and cannot be deleted.']);
            }
            $room->delete();
            return response()->json(['success' => 'Option deleted.']);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }

    /**
     * Delete a study option
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteStudy(Request $request, $id)
    {
        if($request->ajax()){
            $study = Study::find($id);
            if ($this->checkBeforeDeleting('study_id', $id)) {
                return response()->json(['error' => 'This option is in use and cannot be deleted.']);
            }
            $study->delete();
            return response()->json(['success' => 'Option deleted.']);
        }
        return response()->json(['error' => 'Invalid data sent.']);
    }


    /**
     * Check whether selected option is set in an existing report record.
     *   If so, prevent deleting to avoid errors later.
     *
     * @param $field
     * @param $id
     * @return bool
     */
    private function checkBeforeDeleting($field, $id)
    {
        $report = Report::where($field, '=', $id)->get();

        if (count($report)) {
            return true;
        }

        return false;
    }
}
