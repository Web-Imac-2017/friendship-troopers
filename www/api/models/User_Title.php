<?php
/**
 * ////////////////////////////
 * @var User_TitleModel
 * ////////////////////////////
 */
namespace Models;

class User_Title extends Model {

  public function saveCurrent($data, $addKeys) {
		$fields = array();
		$currentData = array();

		// REQUIREMENTS BEFORE INSERTION OR UPDATE INTO DB (HELP TO PREPARE THE REQUEST)
		foreach ($data as $key => $value) {
			$fields[] = "$key=:$key";
			$currentData[$key] = "$value";
		}
		foreach($addKeys as $key => $value) {
			$currentData[$key] = $value;
		}

		// PREPARE UPDATE INTO DB SELECTED TABLE
		$sql = ' UPDATE ' . $this->table . ' SET ' . implode(', ', $fields) . ' WHERE ' . 'userId' . '=:' . 'userId';
    foreach ($addKeys as $key => $value) {
      $sql .= ' AND ' . $key . '=:' . $key;
    }
		$prepareRequest = $this->pdo->prepare($sql);
		$prepareRequest->execute($currentData);

	}

    public function insert ($data) {

        $insertData = [];
        $nbFields = count($data['fields']);
        //checlRequired on userId et AvatarId
        switch ($nbFields) {
            case 2:
                $prepare = '( ? , ? )';
                break;
            case 3:
                $prepare = '(? , ? , ?) ';
                break;
            default:
                throw new \Utils\RequestException('Mauvais nombre de champs', 400);
                break;
        }
        $sql = 'INSERT IGNORE INTO ' . $this->table .' ('. implode(', ', $data['fields']) .') VALUES ';
        if(is_array($data['values'][0])){
            foreach ($data['values'] as $key =>$value) {
                $insertData = array_merge($insertData, $value);
                if($key != count($data['values'])-1){
                    $sql .= $prepare . ', ';
                } else {
                    $sql .= $prepare ;
                }

            }
        } else {
            $sql .= $prepare;
        }
        $prepareRequest = $this->pdo->prepare($sql);
		$prepareRequest->execute($insertData);
    }
}
