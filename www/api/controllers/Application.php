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
}

?>