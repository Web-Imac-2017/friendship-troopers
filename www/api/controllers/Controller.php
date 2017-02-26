<?php
/**
* ////////////////////////////
* @var ApplicationController
* ////////////////////////////
*/
namespace Controllers;

abstract class Controller {

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

<<<<<<< HEAD
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
=======
>>>>>>> 4bc30704667d8cda7f042eaf3b483f95fcd33a62
}
