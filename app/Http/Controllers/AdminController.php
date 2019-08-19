<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AdminController extends Controller {

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct() {
    $this->middleware('auth');
  }

  /**
   * Check if a user hit the cancel button on a form and redirect.
   *
   * @return boolean
   */
  public function formWasCancelled():bool {
    $data = \Request::all();
    return isset($data['cancel']);
  }

  /**
   * Redirect a user to a predetermined URL after completing a form.
   *
   * @param string $default
   *   a default redirect route (overriden by query param)
   * @return Illuminate\Http\RedirectResponse
   */
  public function formRedirect($default = NULL) {
    $params = \Request::input();

    if (isset($params['redirect_to'])) {
      return redirect($params['redirect_to'])->withInput();
    }
    elseif ($default) {
      return redirect($default)->withInput();
    }

    return redirect('/');
  }

  /**
   * Return all given models as JSON.
   *
   * @param \Illuminate\Http\Response $request
   *   the injected request object
   * @param string $class_name
   *   the model class to query
   * @return \Illuminate\Http\Response
   */
  public function dataTableJson(Request $request, $class_name) {
    $column = $request->get('sort');
    $direction = $request->get('dir');
    $limit = $request->get('limit');

    if (!$column) $column = 'created_at';
    if (!$direction) $direction = 'desc';
    if (!$limit) $limit = 10;

    try {
      $models = $class_name::orderBy($column, $direction)->paginate($limit);
    }
    catch (\Exception $e) {
      return response()->json([]);
    }

    return response()->json($models);
  }
}
