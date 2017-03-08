<?php
/**
* ////////////////////////////
* @var StardustModel
* ////////////////////////////
*/
namespace Models;

class Stardust extends Model {
  protected $primaryKey = 'publicationId';

 public function insert ($data) {
   $sql = 'INSERT INTO ' .
    $this->tableName .
    'SET userId=:userId,
    publicationId=:publicationId';
   $prepareRequest = $this->pdo->prepare($sql);
   $prepareRequest->execute($data);
 }

}
