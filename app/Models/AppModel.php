<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

abstract class AppModel extends Model {

  /**
   * A required function for outputting a model as a string.
   *
   * @return string
   */
  abstract public function readableName();

  /**
   * Retrieve validation filters for the current model.
   *
   * @return array
   *   an array of Laravel filters
   */
  public static function formFilters() {
    return [];
  }

  /**
   * Retrieve a list of validation error messages for the current model.
   *
   * @return array
   *   an array of form_keys => error messages
   */
  public static function filterMessages() {
    return [];
  }

  /**
   * Get an array of ids => names to use as select options.
   *
   * @param integer $object_id
   *   if given, restrict to a single object
   * @return array
   */
  public static function selectOptions($object_id = NULL, $placeholder = NULL) {
    $objects = ($placeholder) ? ['' => $placeholder] : [];

    if (is_numeric($object_id)) {
      $object = self::find($object_id);
      $objects[$object->object_id] = $object->readableName();
    }
    else {
      foreach (self::all() as $object) {
        $objects[$object->{$object->getKeyName()}] = $object->readableName();
      }
    }

    return $objects;
  }
}
