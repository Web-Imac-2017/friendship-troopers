<?php
/**
* ////////////////////////////
* @var UserInterestModel
* ////////////////////////////
*/
namespace Models;

class User_Avatar extends Model {
  function __construct($params = false) {
		parent::__construct();
		$this->table = 'user_avatar';
	}

    public function insert ($avatarId, $userId) {
        $sql = 'INSERT INTO ' . $this->table . ' (idUser, idAvatar, ) VALUES ';
        if(is_array($avatarId)){
            foreach ($avatarId as $value) {
                $sql += '(? , ?),';
                $insert_data[] = ['avatarId' => $value, 'userId' => $userId] ;
            }
        }
        $prepareRequest = $this->pdo->prepare($sql);
		$prepareRequest->execute($currentData);
    }
}
