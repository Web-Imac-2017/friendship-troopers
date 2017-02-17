<?php
/**
* ////////////////////////////
* @var RiddleModel
* ////////////////////////////
*/
namespace Models;

class RiddleModel extends Model {
  // ----------[ CONSTANTS ]----------

  const TABLE_NAME = 'riddle';

  // ----------[ ATTRIBUTS ]----------

  private $title;
  private $description;
  private $level;
  private $minReward;
  private $maxReward;
  private $nbParticipants;

  // Foreign key
  private $riddleTypeId;

  // ----------[ FUNCTIONS ]----------



}
