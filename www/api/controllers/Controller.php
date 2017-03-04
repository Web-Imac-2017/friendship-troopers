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
    return array_filter($required, function ($r) use ($post) {
      return !array_key_exists($r, $post);
    });
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

  public function response(array $data, int $httpCode = 200) {
    header('Content-Type: application/json; charset=utf-8');
    http_response_code($httpCode);
    echo json_encode($data);

    return $this;
  }
}
