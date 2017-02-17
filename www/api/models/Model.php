<?php
/**
* ////////////////////////////
* @var Model
* ////////////////////////////
*/
namespace Models;

abstract class Model {
  protected $table = NULL;
  protected $pdo;

  protected $primaryKey = 'id';
  protected $primaryKeyValue;

  protected $validate = NULL;
  protected $errors = NULL;

  public $form;

  /**
   * initiate a connection with the db
   * create the table for the request if it doesn't exist already.
   * @param  [type] $database   [description]
   */
  public function __construct() {
    $database = \Utils\Config::get('db', true);
    if ($this->table === NULL) {
      $this->table = strtolower(get_class($this));
    }

    //TRY TO OPPEN A CONNEXION TO THE DB
    try {
      $this->pdo = new \PDO('mysql:host=' . $database['hostname'] . ';dbname=' . $database['database']. ';',
							$database['login'],
							$database['password'],
							array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
    } catch (\PDOException $e) {
      die('ERROR ' . $e->getMessage());
    }
  }

  /**
   * find almost anything that you want function
   * [Model function for almost all requests needed in SQL]
   * @param  [asso array] $request     [array passed by the controller for basic requests]
   * @param  [char*] $sql              [the SQL request, build step by step]
   * @param  [char*] $join             [the left join part, if there is a leftJoin request]
   * @param  [char*] $condition        [the conditions part, if there is some conditions]
   * @param  [char*] $otherConditions  [if there is multiple conditions, add them to condition]
   * @return [stdObject]               [object containing all the occurences found in the DB]
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
      $sql .= ' FROM ' . $this->table . ' AS ' . get_class($this);

      // IF THIS IS A [LEFT JOIN], ACT ACCORDING SO TO COMPLETE THE REQUEST
      if (isset($request['leftJoin'])) {
        if (!is_array($request['leftJoin'][0])) {
          $join = $request['leftJoin'];
          $sql .= 'LEFT JOIN ' . $join['table'] . ' AS ' . $join['alias'] . ' ON ' . get_class($this) . '.' . $join['to'] . ' = ' . $join['alias'] . '.' . $join['from'];
        } else {
          foreach ($request['leftJoin'] as $join) {
            $sql .= ' LEFT JOIN ' . $join['table'] . ' AS ' . $join['alias'] . ' ON ' . (isset($join['JoinTable']) ? $join['JoinTable'] : get_class($this)) . '.' . $join['to'] . ' = ' . $join['alias'] . '.' . $join['from'];
          }
        }
      }

      // ADD THE CONDITIONS TO THE REQUEST, ONE OR MANY
      if (isset($request['conditions'])) {
        $sql .= ' WHERE ';
        if (!is_array($request['conditions'])) {
          $sql .= $request['conditions'];
        } else {
          $condition = array();
          foreach ($request['conditions'] as $key => $value) {
            if (strstr($key, '.') === false) {
              $key = get_class($this) . ' . ' . $key;
            }
            if (is_array($value)) {
              if (isset($value['value']) and isset($value['cmp'])) {
                if (!is_numeric($value['value'])) {
                  $value['value'] = $this->pdo->quote($value['value']);
                }
                $condition[] = $key . $value['cmp'] . $value['value'];
              } else {
                $otherConditions = array();
                foreach ($value as $valueOfValue) {
                  $otherConditions[] = "$key=$valueOfValue";
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
        $sql .= ' ORDER BY ' . $request['orderBy']['key'] . ' . ' . $request['orderBy']['order'];
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

      return ($prepareRequest->fetchAll(\PDO::FETCH_OBJ));
    }
  }

  /**
   * find first occurence function
   * [Return only the first occurence found by the DB]
   * @param  [asso array] $request [the request send by the controller]
   * @return [stdObject]           [the first occurence found in the DB]
   */
  public function findFisrt ($request) {
    return (current($this->find($request)));
  }

  /**
   * find and count occurences function
   * [Return the number of occurences found in the DB, with or without conditions]
   * @param  [asso array] $conditions [the conditions needed for count]
   * @return [stdObject]              [the number of occurences found int the DB]
   */
  public function findCount ($conditions = NULL) {
    if ($conditions === NULL) {
      return ($this->findFirst(array(
        'fields' => 'COUNT(' . $this->primaryKey . ') AS count'))->count);
    }
    return ($this->findFirst(array(
      'fields' => 'COUNT (' . $this->primaryKey . ') AS count',
      'conditions' => $conditions
    ))->count);
  }

 /**
  * delete function
  * [delete one or multiple correspondances in the DB talbe specified]
  * @param  [asso array] $id  [one or multiple entries that need to be deleted]
  * @return [none]            [no need to return because there is nothing anymore]
  */
  public function delete ($id) {
    if (!is_array($id)) {
      $sql = ' DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = ' . $id;
    } else {
      $sql = ' DELETE FROM ' . $this->table . ' WHERE';
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
}
