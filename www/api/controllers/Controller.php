<?php //Application
/**
*
*/
namespace Controllers;

abstract class Application {
    public function verifyEntries($data){
        foreach ($data as $key) {
            if(!isset($key) || empty($key)) {
                return false;
            }
        }
    }
    public function filterXSS($data) {
      $currentData = $data;
      if (!isset($currentData)) {
        return -1;
      }
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
}

?>
