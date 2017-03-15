<?php
/**
* ////////////////////////////
* @var Model
* ////////////////////////////
*/
namespace Models;

abstract class Model {
	protected $table = NULL;
	protected $dbName = 'friendshipTroopers';
	protected $pdo;

	protected $primaryKey = 'id';
	protected $primaryKeyValue;

	protected $validate = NULL;
	protected $errors = NULL;

	public $form;

	protected $metaData;
	/**
	 * initiate a connection with the db
	 * create the table for the request if it doesn't exist already.
	 * @param  [type] $database   [description]
	 */
	public function __construct() {
		$database = \Utils\Config::get('db', true);

		if ($this->table === NULL) {
			$tableName=explode('\\',strtolower(get_class($this)));
			$this->table = array_pop($tableName);
		}

		$this->metaData = json_decode(file_get_contents(ROOT.'/config/dbMetaData.json'), true)[$this->table];

		//TRY TO OPPEN A CONNEXION TO THE DB
		try {
			$this->pdo = new \PDO('mysql:host=' . $database['hostname'] . ';dbname=' . $database['database']. ';',
							$database['login'],
							$database['password'],
							array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
			$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		} catch (\PDOException $e) {
			die('ERROR ' . $e->getMessage());
		}
	}

	/**
	 * find almost anything that you want function
	 * Model function for almost all requests needed in this SQL DB
	 * @param  ass array  $request          array passed by the controller for basic requests
	 * @param  char*      $sql              the SQL request, build step by step
	 * @param  char*      $join             the left join part, if there is a leftJoin request
	 * @param  char*      $condition        the conditions part, if there is some conditions
	 * @param  char*      $otherConditions  if there is multiple conditions, add them to condition
	 * @return stdObject  ...               object containing all the occurences found in the DB
	 */
	public function find($request) {
		$sql = 'SELECT ';
		// MANAGE THE FIRST PART OF THE REQUEST [THE FIELDS]
		if (isset($request['fields'])) {
			if (is_array($request['fields'])) {
				$sql .= implode(', ', $request['fields']);
			} else {
				$sql .= '*';
			}
			$sql .= ' FROM ' . $this->table. ' AS ' . $this->table;

			// IF THIS IS A [LEFT JOIN], ACT ACCORDING SO TO COMPLETE THE REQUEST
			if (isset($request['leftJoin'])) {
                if (!is_array($request['leftJoin'][0])) {
                    $join = $request['leftJoin'];
                    $sql .= ' LEFT JOIN ' . $join['table'] . ' AS ' . $join['alias'] . ' ON ' . $this->table . '.' . $join['to'] . ' = ' . $join['alias'] . '.' . $join['from'];
                } else {
                    foreach ($request['leftJoin'] as $join) {
						$tmp = explode("\\", get_class($this));
                        $sql .= ' LEFT JOIN ' . $join['table'] . ' AS ' . $join['alias'] . ' ON ' . (isset($join['JoinTable']) ? $join['JoinTable'] : strtolower(array_pop($tmp))) . '.' . $join['to'] . ' = ' . $join['alias'] . '.' . $join['from'];
                    }
                }
            }

			// ADD THE CONDITIONS TO THE REQUEST, ONE OR MANY
			if (isset($request['conditions']) && !empty($request['conditions'])) {
				$sql .= ' WHERE ';
				if (!is_array($request['conditions'])) {
					$sql .= $request['conditions'];
				} else {
					$condition = array();
					foreach ($request['conditions'] as $key => $value) {
						if (strstr($key, '.') === false) {
							$key = $this->table . '.' . $key;
						}
						if (is_array($value)) {
							if (isset($value['value']) and isset($value['cmp'])) {
								if (!is_numeric($value['value'])) {
									$value['value'] = $this->pdo->quote($value['value']);
								}
								$condition[] = $key . ' ' . $value['cmp'] . ' ' . $value['value'];
							} else {
								$otherConditions = array();
								foreach ($value as $orKey => $valueOfValue) {
									if(!is_numeric($valueOfValue)){
										$valueOfValue=$this->pdo->quote($valueOfValue);
									}
									$otherConditions[] = "$orKey=$valueOfValue";
								}
								$condition[] = '(' . implode(' OR ', $otherConditions) . ')';
							}
						} else {
							if(!is_numeric($value)) {
								$condition[] = $key . '=' . $this->pdo->quote($value);
							} else {
								$condition[] = $key . '=' . $value;
							}
						}
					}
					$sql .= implode(' AND ', $condition);
				}
			}

			// IF THERE IS AN ORDER BY FIELD, ADD IT TO THE REQUEST
			if (isset($request['orderBy'])) {
				$sql .= ' ORDER BY ' . $request['orderBy']['key'] . ' ' . $request['orderBy']['order'];
			}

			// IF THERE IS A GROUP BY FIELD, ADD IT TO THE REQUEST
			if (isset($request['groupBy'])) {
				$sql .= ' GROUP BY ' . $request['groupBy'];
			}

			// IF THERE IS A LIMIT FIELD, ADD IT TO THE REQUEST
			if (isset($request['limit'])) {
				$sql .= ' LIMIT ' . $request['limit'];
			}
			// PREPARE THE REQUEST AND EXECUTE IT THEN RETURN AN OBJECT FROM YOUR DB
			$prepareRequest = $this->pdo->prepare($sql);
			$prepareRequest->execute();
			return ($prepareRequest->fetchAll(\PDO::FETCH_ASSOC));
		}
	}

	/**
	 * find first occurence function
	 * Return only the first occurence found by the DB
	 * @param  asso array   $request  the request sent by the controller
	 * @return stdObject    ...       the first occurence found in the DB
	 */
	public function findFirst ($request) {
		return (current($this->find($request)));
	}

	/**
	 * find and count occurences function
	 * Return the number of occurences found in the DB, with or without conditions
	 * @param  asso array   $conditions   the conditions needed for count
	 * @return stdObject    ...           the number of occurences found int the DB
	 */
	public function findCount ($conditions = NULL) {
		if ($conditions === NULL) {
			return ($this->find(array(
				'fields' => 'COUNT(' . $this->primaryKey . ') AS count'))->count);
		}
		return ($this->find(array(
			'fields' => 'COUNT (' . $this->primaryKey . ') AS count',
			'conditions' => $conditions,
		))->count);
	}

 	/**
	 * delete function
	 * delete one or multiple correspondances in the DB talbe specified
	 * @param  asso array  $id   one or multiple entries that need to be deleted
	 * @return none        ...   no need to return because there is nothing anymore
	 */
	public function delete ($id) {
		if (!is_array($id)) {
			$sql = ' DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = ' . $id;
		} else {
			$sql = ' DELETE FROM ' . $this->table . ' WHERE ';
			$first = true;
			foreach($id as $key => $value) {
				if($first) {
					$first = false;
				} else {
					$sql .= ' AND ';
				}
				$sql .= "$key = $value";
			}
		}
		$prepareRequest = $this->pdo->prepare($sql);
		$prepareRequest->execute();
	}

			/**
	 * Insert / Update function
	 * INSERT INTO table VALUES ('valeur 1', 'valeur 2', ...)
	 * Insert one or many entries into the DB. Based on the data and keys sent by a controller
	 * Update one or many entries of the DB based on the data and keys sent by a controller
	 * @param  array   $data     datas that need to be pushed in the DB
	 * @param  array    $addKeys  keys needed for the update
	 * @return type     ...
	 */
	public function save($data, $addKeys = []) {
		$Pkey = $this->primaryKey;
		$fields = array();
		$currentData = array();
		$action = null;

		// REQUIREMENTS BEFORE INSERTION OR UPDATE INTO DB (HELP TO PREPARE THE REQUEST)
		if(isset($data[$Pkey]) and empty($data[$Pkey])) {
			unset($data[$Pkey]);
		}
		foreach ($data as $key => $value) {
			$fields[] = "$key=:$key";
			$currentData[$key] = "$value";
		}
		foreach($addKeys as $key => $value) {
			$currentData[$key] = $value;
		}

		// PREPARE UPDATE INTO DB SELECTED TABLE
		// ELSE
		// PREPARE INSERTION INTO DB SELECTED TABLE
		if (isset($data[$Pkey]) and !empty($data[$Pkey])) {
				$sql = ' UPDATE ' . $this->table . ' SET ' . implode(', ', $fields) . ' WHERE ' . $Pkey . '=:' . $Pkey;
				foreach ($addKeys as $key => $value) {
					$sql .= ' AND ' . $key . '=:' . $key;
				}
				$this->primaryKeyValue = $data[$key];
				$action = 'update';
		} else {
			$sql = ' INSERT INTO ' . $this->table . ' SET '. implode(', ', $fields);
			$action = 'insert';
		}
		$prepareRequest = $this->pdo->prepare($sql);
		$prepareRequest->execute($currentData);

		// SAVE IN THE CLASS INSANCE THE LAST ID INSERTED INTO DB SELECTED TABLE
		if($action == 'insert') {
			$this->primaryKeyValue = $this->pdo->lastInsertId($this->primaryKey);
		}

    return $this->primaryKeyValue;
	}
}
