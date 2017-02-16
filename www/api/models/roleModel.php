<?php
/**
* ////////////////////////////
* @var AvatarModel
* ////////////////////////////
*/

class AvatarModel extends ApplicationModel {
	// ----------[ CONSTANTS ]----------

	const TABLE_NAME = 'role';
	const ADMIN = 1;
	const MODO = 2;
	const USER = 3;
	const BAN = 4;

	// ----------[ ATTRIBUTS ]----------

	private $id;
	private $label;

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

	// ----------[ SETTERS ]------------

	/**
	 * Set role atribute into planetModel
	 * @param [type] $attr  [attribute you need]
	 * @param [type] $value [value you wanna push into roleModel]
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

	// ----------[ GETTERS ]------------

	/**
	 * Get role attribut from data base
	 * @param  [type] $attr [attribut you wanna know]
	 * @return [type]       [value of the attribut from roleModel]
	 */
  public function __get($attr) {
    if(isset($this->$attr)) {
			return $this->$attr;
    } else {
			//throw new Exception("Unknown attribute",1);
    }
  }

	// ----------[ FUNCTIONS ]----------



}
