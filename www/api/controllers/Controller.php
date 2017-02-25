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
