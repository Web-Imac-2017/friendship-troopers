<?php
/**
 * ////////////////////////////
 * @var PlanetModel
 * ////////////////////////////
 */
require_once($_SERVER['DOCUMENT_ROOT'].'api/models/ApplicationModel.class.php');

class PlanetModel extends ApplicationModel {
	// ----------[ CONSTANTS ]----------

	const TABLE_NAME = 'planet';

	// ----------[ ATTRIBUTS ]----------

  private $id;
  private $name;
  private $description;
  private $history;
  private $imagePath;

	// ----------[ CONSTRUCT ]----------

	/**
	 * Allow you to dynamically initiate the model
	 * @param boolean $params [description]
	 */
  function __construct($params = false) {
    if (is_array($params)) {
      foreach ($params as $key => $val) {
				$this->$key = $val;
      }
    }
  }

	//----------[ SETTERS ]------------

	/**
	 * Set planet atribute into planetModel
	 * @param [type] $attr  [attribute you need]
	 * @param [type] $value [value you wanna push into planetModel]
	 */
  public function __set($attr, $value) {
    $func = 'set'.ucfirst($attr);
    if (method_exists($this, $func)) {
      $this->$func($value);
    } else {
      $this->$attr = $value;
    }
    // ACTIONS TO DO
  }

	// ----------[ GETTERS ]-------------

	/**
	 * Get planet attribut from data base
	 * @param  [type] $attr [attribut you wanna know]
	 * @return [type]       [value of the attribut from PlanetModel]
	 */
  public function __get($attr) {
    if(isset($this->$attr)) {
			return $this->$attr;
    } else {
			//throw new Exception("Unknown attribute",1);
    }
  }

	// ----------[ FUNCTIONS ]----------

   /**
    * Get all planets from the table and Return an array of planets
    * @return [type] [description]
    */
   public function getAllPlanets() {
   }
}
?>
