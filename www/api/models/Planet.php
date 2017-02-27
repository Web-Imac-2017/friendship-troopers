<?php
/**
 * ////////////////////////////
 * @var PlanetModel
 * ////////////////////////////
 */
namespace Models;

class Planet extends Model {
	// ----------[ CONSTANTS ]----------

	// ----------[ ATTRIBUTS ]----------
	private $id;
	private $name;
	private $description;
	private $history;
	private $imagePath;

// //----------[ CONSTRUCT ]----------
// function __construct($params = false) {
// 	parent::__construct();
// 	 if (is_array($params)) {
// 		 foreach ($params as $key => $val) {
// 			 if($key != "password") {
// 				 $this->$key = $val;
// 			 }
// 		 }
// 	 }
// }
//
// //----------[ SETTER ]-------------
//  public function __set($attr, $value) {
// 	 $func = 'set'.ucfirst($attr);
// 	 if (method_exists($this, $func)) {
// 		  $this->$func($value);
// 		} else {
// 			$this->$attr = $value;
// 		}
// 	 // Action commune à tous les setters (ex : mettre dans l'objet)
//  }
//
//  //----------[ GETTER ]-------------
//   public function __get($attr) {
// 		if(isset($this->$attr)) {
// 			return $this->$attr;
// 		} else {
// 			return 0;
// 		}
	}
?>
