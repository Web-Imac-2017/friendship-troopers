<?php

define('ROOT', realpath(__DIR__.'/../..'));

require_once ROOT.'/api/utils/Autoloader.php';
\Utils\Autoloader::register();
\Utils\Config::init();

$database = \Utils\Config::get('db', true);

//TRY TO OPPEN A CONNEXION TO THE DB
try {
  $pdo = new \PDO('mysql:host=' . $database['hostname'] . ';dbname=' . $database['database']. ';',
          $database['login'],
          $database['password'],
          array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
} catch (\PDOException $e) {
  die('ERROR ' . $e->getMessage());
}

/**
 * SELECT TABLE_NAME, DATA_TYPE, CHARACTER_MAXIMUM_LENGTH
 * FROM INFORMATION_SCHEMA.COLUMNS
 * WHERE table_schema = "friendshiptroopers"
 * ORDER BY TABLE_NAME
 **/
function getMetaData ($request = array()) {
  global $pdo;

  if (isset($request)) {
    $columns = array();
    $currentColumns = array();
    $metaData = NULL;
    $dbName = 'friendshiptroopers';

    $sql = 'SELECT ';

    if (is_array($request['metaData'])) {
      $metaData .= implode(', ', $request['metaData']);
    } else {
      $metaData = $request['metaData'];
    }

    $sql .= $metaData . ' FROM INFORMATION_SCHEMA.COLUMNS WHERE table_schema = "' . $dbName . '" ORDER BY TABLE_NAME';

    $prepareRequest = $pdo->prepare($sql);
    $prepareRequest->execute($currentColumns);
    var_dump($prepareRequest);

    return ($prepareRequest->fetchAll(\PDO::FETCH_ASSOC));
  }
}

function groupBy($data) {
  return array_reduce($data, function ($carry, $current) {
    $carry[$current['TABLE_NAME']][$current['COLUMN_NAME']] = [
      'type'      => $current['DATA_TYPE'],
      'maxLength' => $current['CHARACTER_MAXIMUM_LENGTH'],
    ];

    return $carry;
  }, []);
}

$datas = getMetaData([
  'metaData' => [
    'TABLE_NAME',
    'COLUMN_NAME',
    'DATA_TYPE',
    'CHARACTER_MAXIMUM_LENGTH',
  ]
]);

file_put_contents(ROOT.'/config/dbMetaData.json', json_encode(groupBy($datas), JSON_PRETTY_PRINT));

// json_decode(file_get_contents(ROOT.'/config/dbMetaData.json'), true);
