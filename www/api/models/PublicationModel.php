<?php
/**
* ////////////////////////////
* @var PublicationModel
* ////////////////////////////
*/
namespace Models;

class PublicationModel extends Model {
  // ----------[ CONSTANTS ]----------

  const TABLE_NAME = 'publication';

  // ----------[ ATTRIBUTS ]----------

  private $title;
  private $content;
  private $publishDate;
  private $modified = NULL;

  // Foreign keys
  private $userId;
  private $imageUploadId;

  // ----------[ FUNCTIONS ]----------



}
