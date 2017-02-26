<?php
/**
* ////////////////////////////
* @var ApplicationController
* ////////////////////////////
*/
namespace Controllers;

abstract class Controller {

  public function checkRequired ($required, $post) {
    // MAK SURE EACH REQUIRED FIELDS EXISTS IN $_POST
    foreach($required as $field) {
      if (!array_key_exists($required, $post)) {
        echo 'Champ obligatoire manquant';
        return false;
      }
    }
    return true;
  }

  /**
   * Filter XSS attempts comming from users
   * @param  [type] $data [description]
   * @return [type]       [description]
   */
  public function filterXSS ($data) {
    $currentData = $data;
    if (!isset($currentData))
      return -1;

    if (!is_array($currentData)) {
      $currentData = htmlspecialchars($currentData);
    } else {
      foreach ($currentData as &$value) {
        $value = htmlspecialchars($value);
      }
      unset($value);
    }
    return $currentData;
  }

  public function filterCSRF () {

  }
}
