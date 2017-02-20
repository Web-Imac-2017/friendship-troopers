<?php
/**
 * ////////////////////////////
 * @var PlanetModel
 * ////////////////////////////
 */
namespace Models;
class PlanetModel extends Model {
	// ----------[ CONSTANTS ]----------
	const TABLE_NAME = 'planet';
	// ----------[ ATTRIBUTS ]----------
	private $id;
	private $name;
	private $description;
	private $history;
	private $imagePath;
	// ----------[ FUNCTIONS ]----------
}
?>