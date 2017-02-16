<?php
/**
* ////////////////////////////
* @var ApplicationController
* ////////////////////////////
*/
abstract class Application {

	protected function autoload() {
		spl_autoload_extensions('.php, .class.php');
		spl_autoload_register('classLoader');
	}

	protected function classLoader($class) {
        $filename = strtolower($class) . '.php';
        $file =$_SERVER['DOCUMENT_ROOT'].'api/controllers/' . $filename;
        echo $file;
        if (!file_exists($file)) {
            return false;
        }
        require_once $file;
    }

    function modelLoader($class) {
        $filename = strtolower($class) . '.class.php';
        $file =$_SERVER['DOCUMENT_ROOT'].'api/models/' . $filename;
        if (!file_exists($file)) {
            return false;
        }
        require_once $file;
    }
}


