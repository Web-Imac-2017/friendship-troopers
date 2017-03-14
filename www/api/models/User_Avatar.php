<?php
/**
* ////////////////////////////
* @var UserInterestModel
* ////////////////////////////
*/
namespace Models;

class User_Avatar extends Model {
    protected $primaryKey = 'userId';
    function __construct($params = false) {
		parent::__construct();
		$this->table = 'user_avatar';
	}

    public function insert ($data) {
        // Format des datas :
        // $data = [
        //     'fields' => ['userId, avatarId, currentAvatar'],
        //     'values' => [
        //         ['1','1','1'],
        //         ['1','2','0'],
        //         ['1','3','0'],
        //     ]
        // ];
        $nbFields = count($data['fields']);
        //checlRequired on userId et AvatarId
        switch ($nbFields) {
            case 2:
                $prepare = '( ? , ? ),';
                break;
            case 3:
                $prepare = '(? , ? , ?), ';
                break;
            default:
                throw new \Utils\RequestException('Mauvais nombre de champs', 400);
                break;
        }
        $sql = 'INSERT INTO ' . $this->table .' ('. implode(', ', $data['fields']) .') VALUES ';
        if(is_array($data['values'][0])){
            foreach ($data['values'] as $value) {
                $sql .= $prepare;
            }
        } else {
            $sql .= $prepare;
        }
        $prepareRequest = $this->pdo->prepare($sql);
		$prepareRequest->execute($data['values']);
    }

}
