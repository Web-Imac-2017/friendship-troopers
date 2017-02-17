<?php //ApplicationModel
/**
* 
*/
require_once($_SERVER['DOCUMENT_ROOT'].'api/models/ApplicationModel.class.php');
require_once($_SERVER['DOCUMENT_ROOT'].'api/models/constantes.php');
class PlanetModel extends ApplicationModel{
	const TABLE_NAME = 'planet';

	private $id;
	private $name;
	private $description;
	private $history;
	private $imagePath;

	function __construct($params = false) {
		if (is_array($params)) {
			foreach ($params as $key => $val) {
					$this->$key = $val;
			}
		} 
	}

	public function __set($attr, $value) {
		if(isset($this->$attr)) {
			var_dump($this);
			return $this->$attr = $value;
		} else {
			//throw new Exception("Unknown attribute",1);	
		}
	}

	public function __get($attr) {
		if(isset($this->$attr)) {
			return $this->$attr;
		} else {
			//throw new Exception("Unknown attribute",1);
		}
	}

	public function setName($name) {
		$this->username = $name;
	}
    public function setDescription($description) {
        return $this->description = $description;
    }
    public function setHistory($history) {
        return $this->planetId = $planetId;
    }

    /**
     * Gets all planets.
     * return array of Planets
     */
    public function getAllPlanets() {

    }
}

?>