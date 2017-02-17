<?php
/**
* ////////////////////////////
* @var EventModel
* ////////////////////////////
*/
namespace Models;

class EventModel extends Model {
  // ----------[ CONSTANTS ]----------

  const TABLE_NAME = 'event';

  // ----------[ ATTRIBUTS ]----------

  private $id;
  private $startDate;
  private $endDate;
  private $description;

  // Foreign key
  private $riddleId;

  // ----------[ FUNCTIONS ]----------



}
