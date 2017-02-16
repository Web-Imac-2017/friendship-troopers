<?php
/**
* ////////////////////////////
* @var CommentModel
* ////////////////////////////
*/
require_once($_SERVER['DOCUMENT_ROOT'].'api/models/AvatarModel.class.php');

class CommentModel extends ApplicationModel {
  // ----------[ CONSTANTS ]----------

  const TABLE_NAME = 'comment';

  // ----------[ ATTRIBUTS ]----------

  private $id;
  private $content;
  private $publishDate;
  private $modified = NULL;

  // Foreign keys
  private $userId;
  private $publicationId;

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
	 * Set comment atribute into planetModel
	 * @param [type] $attr  [attribute you need]
	 * @param [type] $value [value you wanna push into commentModel]
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
	 * Get comment attribut from data base
	 * @param  [type] $attr [attribut you wanna know]
	 * @return [type]       [value of the attribut from commentModel]
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
