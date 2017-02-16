<?php
/**
* ////////////////////////////
* @var ApplicationModel
* ////////////////////////////
*/
require_once($_SERVER['DOCUMENT_ROOT'].'/config/config.php');

abstract class ApplicationModel {
	// ----------[ CONSTANTS ]----------



	// ----------[ ATTRIBUTS ]----------


	
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

    protected function verifyInput($input){

    }

	static function dbConnection(){
		try {
			$bdd= new PDO('mysql:host='.DB_HOSTNAME.';dbname='.DB_DATABASE.';charset=utf8',DB_USERNAME,DB_PASSWORD);
		} catch (Exception $e) {
			die('Erreur :'.$e->getMessage());
		}
		return $bdd;
	}

	static public function executeQuery($query,$bdd) {
		try {
			$result=$bdd->query($query);
		} catch (Exception $e) {
			die('Erreur :'.$e->getMessage());
		}

		return $result;
	}


}

?>
