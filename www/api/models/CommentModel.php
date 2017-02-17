<?php
/**
* ////////////////////////////
* @var CommentModel
* ////////////////////////////
*/
namespace Models;

class CommentModel extends Model {
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

  // ----------[ FUNCTIONS ]----------



}
