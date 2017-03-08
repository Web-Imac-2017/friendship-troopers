<?php
/**
* ////////////////////////////
* @var ...Model
* ////////////////////////////
*/
namespace Models;

class Friend extends Model {
    // ----------[ CONSTANTS ]----------
    // ----------[ ATTRIBUTS ]----------
    protected $primaryKey = 'userId';
    // ----------[ FUNCTIONS ]----------
    public function insert ($data) {
      $sql = 'INSERT INTO friend SET userId=:userId, friendId=:friendId, status=:status, seeker=:seeker';
      $prepareRequest = $this->pdo->prepare($sql);
      $prepareRequest->execute($data);
    }

    public function delete ($data) {
      if (!is_numeric($data['userId']) || !is_numeric($data['friendId'])) {
          throw new \Utils\RequestException('FORMAT_FIELDS_ERROR', 400); // code
      }
      $sql = 'DELETE FROM friend
      WHERE (userId=' . $data['userId'] .' OR userId =' . $data['friendId']  . ')
      AND (friendId = '. $data['friendId'] .' OR friendId = '.$data['userId'].')';
      $prepareRequest = $this->pdo->prepare($sql);
      $prepareRequest->execute($data);
    }

}
