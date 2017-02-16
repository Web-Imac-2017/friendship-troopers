<?php

  class Model {
    static private $connections = array();
    protected $db = 'default';
    protected $table = NULL;
    protected $pdo;

    protected $primaryKey = 'id';
    protected $primaryKeyValue;

    protected $validate = NULL;
    protected $errors = NULL;

    public $form;

    /**
     * initie une connexion avec la base de donnée.
     *crée la table si elle n'existe pas.
     */
    public function __construct() {
      $database = Conf::$database[$this->db];
      if ($this->table === NULL) {
        $this->table = strtolower(get_class($this));
      }
      if (isset(Model::$connections[$this->db])) {
        $this->pdo = Model::$connections[$this->db];
        return;
      }

      try {
        //tentative de connexion à la base de donnée
        $this->pdo = new PDO('mysql:host=' . $database['hostname'] . ';dbname=' . $database['database']. ';',
								$database['login'],
								$database['password'],
								array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        if (Conf::$debug) {
          $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        Model::$connections[$this->db] = $this->pdo;

      } catch (PDOException $e) {
        if (Conf::$debug) {
          die($e->getMessage());
        } else {
          die(_('Connexion à la base de donnée impossible'));
        }
      }
    }

    public function find($request) {
      $sql = 'SELECT ';

      if (isset($request['fields'])) {
        if (is_array($request['fields'])) {
          $sql .=
        }
      }
    }
  }
  
