<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Group;
use App\Http\Controllers\Controller;
use App\Traits\Encryptable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        $users = User::with('role')->get();
        return view('manage.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = new User();
        $roles = Role::all();
        $groups = Group::all();
        return view('manage.user.create', ['id' => null, 'user' => $user, 'roles' => $roles, 'groups' => $groups]);
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role_id' => 'required|array|',
            'password' => 'required|string|min:6|confirmed',
            'group_id' => 'integer',
        ]);

        // store
        $user = User::create([
            'email'        => $request->input('email'),
            'first_name'   => $request->input('first_name'),
            'last_name'    => $request->input('last_name'),
            'password'     => bcrypt($request->input('password')),
            'group_id'     => $request->input('group_id'),
            'status'       => User::STATUS_ACTIVE,
        ]);
        $user->role()->sync($request->input('role_id'));

        // redirect
        $request->session()->flash('success', 'User created successfully.');
        return redirect(route('manage.user.index'));
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
        $user = User::find($id);
        $roles = Role::all();
        $groups = Group::all();
        return view('manage.user.edit', ['id' => $id, 'user' => $user, 'roles' => $roles, 'groups' => $groups]);
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
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role_id' => 'required|array|',
            'group_id' => 'integer',
        ]);

        if (!empty($request->input('password'))) {
            $this->validate($request, ['password' => 'required|string|min:6|confirmed']);
        }

        // store
        $user = User::find($id);
        $user->email        = $request->input('email');
        $user->first_name   = $request->input('first_name');
        $user->last_name    = $request->input('last_name');
        $user->status       = User::STATUS_ACTIVE;
        $user->role()->sync($request->input('role_id'));
        if (!empty($request->input('password'))) {
            $user->password     = bcrypt($request->input('password'));
        }
        $user->group_id     = $request->input('group_id');
        $user->save();

        // redirect
        $request->session()->flash('success', 'User updated successfully.');
        return redirect(route('manage.user.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request)
    {
        $user_id = 0;
        if ($request->has('user_id')) {
            $user_id = $request->input('user_id');
        }

        if ($user_id) {
            $user = User::find($user_id);
            $user->role->detach();
            User::destroy($user_id);
            $request->session()->flash('success', 'User deleted.');
            return redirect(route('manage.user.index'));
        }

        $request->session()->flash('error', 'User could not be deleted.');
        return redirect(route('manage.user.index'));
    }
}
