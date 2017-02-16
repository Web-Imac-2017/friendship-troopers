<?php
/**
* ////////////////////////////
* @var PublicationModel
* ////////////////////////////
*/
require_once($_SERVER['DOCUMENT_ROOT'].'api/models/AvatarModel.class.php');

class PublicationModel extends ApplicationModel {
  // ----------[ CONSTANTS ]----------

  const TABLE_NAME = 'publication';

  // ----------[ ATTRIBUTS ]----------

  private $id;
  private $title;
  private $content;
  private $publishDate;
  private $modified = NULL;

  // Foreign keys
  private $userId;
  private $imageUploadId;

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
	 * Set publication atribute into planetModel
	 * @param [type] $attr  [attribute you need]
	 * @param [type] $value [value you wanna push into publicationModel]
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
	 * Get publication attribut from data base
	 * @param  [type] $attr [attribut you wanna know]
	 * @return [type]       [value of the attribut from publicationModel]
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
