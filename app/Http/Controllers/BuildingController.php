<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Room;
use App\Traits\Encryptable;
use Illuminate\Http\Request;

class BuildingController extends Controller
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
        $data = Building::all();

        return view('manage.options.page.show-building', ['buildings' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created building in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Store a newly created room in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeRoom(Request $request)
    {

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
        $data = [
            'building' => Building::find($id),
            'rooms' => Room::where('building_id', '=', $id)->get(),
        ];

        return view('manage.options.page.edit-building', ['data' => $data]);
    }

    /**
     * Show the form for editing rooms for a given building
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editRooms($id)
    {
        $data = [
            'building' => Building::find($id),
            'rooms' => Room::all(),
            'roomsinbuilding' => Room::where('building_id', '=', $id)->get(),
        ];

        return view('manage.options.page.edit-buildingrooms', ['data' => $data]);
    }

    /**
     * Show the form for editing a given room name
     *
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function editRoom($id)
    {
        $room = Room::find($id);

        return view('manage.options.page.edit-room', ['id' => $id, 'room' => $room]);
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
            'name' => 'required|string',
        ]);

        // remove existing building_id pointers from each room
        Room::where('building_id', '=', $id)->update(['building_id' => 0]);

        if ($request->room) {
            foreach ($request->room as $key => $value) {
                if (trim($value)) {
                    $room = Room::find($key);
                    $room->name = $value;
                    $room->building_id = $id;
                    $room->save();
                }
            }
        }

        if ($request->newroom) {
            foreach ($request->newroom as $key => $value) {
                if (trim($value) && $key > 0) {
                    Room::create([
                        'name' => $value,
                        'building_id' => $id,
                    ]);
                }
            }
        }

        $building = Building::find($id);
        $building->name = $request->input('name');
        $building->save();

        // redirect
        $request->session()->flash('success', 'Building updated successfully.');
        return redirect()->action('BuildingController@edit', ['id' => $id]);
    }

    /**
     * Update the rooms in a given building.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateRooms(Request $request, $id)
    {
        // validate
        $this->validate($request, [
            'room_id'      => 'required|array',
        ]);

        // remove existing building_id pointers from each room
        Room::where('building_id', '=', $id)->update(['building_id' => 0]);
        // reset building_id values
        Room::whereIn('id', $request->input('room_id'))->update(['building_id' => $id]);

        // redirect
        $request->session()->flash('success', 'Rooms updated successfully.');
        return redirect()->action('BuildingController@edit', ['id' => $id]);
    }

    /**
     * Update the specified room in storage.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function updateRoom(Request $request, $id)
    {
        // validate
        $this->validate($request, [
            'name'      => 'required',
        ]);

        // store
        $room = Room::find($id);
        $room->name = $request->input('name');
        $room->save();

        // redirect
        $request->session()->flash('success', 'Room updated successfully.');
        return redirect($request->input('previous_url'));
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
