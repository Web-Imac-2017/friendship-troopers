<?php
/**
* ////////////////////////////
* @var AvatarModel
* ////////////////////////////
*/
require_once($_SERVER['DOCUMENT_ROOT'].'api/models/AvatarModel.class.php');

class AvatarModel extends ApplicationModel {
  // ----------[ CONSTANTS ]----------

  const TABLE_NAME = 'avatar';

  // ----------[ ATTRIBUTS ]----------

  private $id;
  private $imagePath;
  private $description;
  private $pack;

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
	 * Set avatar atribute into planetModel
	 * @param [type] $attr  [attribute you need]
	 * @param [type] $value [value you wanna push into avatarModel]
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
	 * Get avatar attribut from data base
	 * @param  [type] $attr [attribut you wanna know]
	 * @return [type]       [value of the attribut from avatarModel]
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

?>
