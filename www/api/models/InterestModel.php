<?php
/**
* ////////////////////////////
* @var InterestModel
* ////////////////////////////
*/

class InterestModel extends ApplicationModel {
  // ----------[ CONSTANTS ]----------

  const TABLE_NAME = 'interest';

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

  // ----------[ SETTER ]-------------

  /**
	 * Set interest atribute into planetModel
	 * @param [type] $attr  [attribute you need]
	 * @param [type] $value [value you wanna push into interestModel]
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

  // ----------[ GETTER ]-------------

  /**
	 * Get interest attribut from data base
	 * @param  [type] $attr [attribut you wanna know]
	 * @return [type]       [value of the attribut from interestModel]
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
