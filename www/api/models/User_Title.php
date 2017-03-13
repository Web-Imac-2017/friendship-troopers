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

		var_dump($sql);
		var_dump($currentData);
		$prepareRequest = $this->pdo->prepare($sql);
		$prepareRequest->execute($currentData);

	}

}
