<?php
/**
* ////////////////////////////
* @var PlanetController
* ////////////////////////////
*/
namespace Controllers;

class Planet extends Controller {

  /*public function getPost ($get) {
    if (!array_key_exist($_SESSION['user'])) {
      echo'utilisateur introuvable';
      return false;
    }
    $publicationModel = new \Models\Publication();

    $request = $this->publicationModel->findFirst([
      'fields' => ['content', 'publishDate', 'userId', 'modified'],
      'conditions' => ['planetId' => $_SESSION['user']['planetId']],
    ]);
  }*/

  /**
   * Get the 10 First Publications of the user's Planet
   * @param  char* $planetLabel [description]
   * @return [type]              [description]
   */
  public function getPlanetFeed ($planetLabel) {
    $_SESSION['user']['planet'] = 1;
    $_SESSION['planet'] = [
      'planetId' => [1, 2, 3, 4, 5,],
      'planetLabel' => [ 'Terre', 'Paranose', 'Technome', 'Sautien', 'Multas',],
    ];
    $userPlanet = $_SESSION['user']['planet'];
    $required = ['planetId'];

    if (!array_key_exists($userPlanet, $_SESSION['planet']['planetId'])) {
      echo'planète introuvable';
      return false;
    } else if ($_SESSION['planet']['planetLabel'][--$userPlanet] != $planetLabel) {
      echo 'vous n\'appartenez pas à cette planète !';
      return false;
    }

    $publicationModel = new \Models\Publication();

    $request = $publicationModel->find([
      'fields' => ['content', 'publishDate', 'userId', 'modified'],
      'leftJoin' => [[
        'table' => 'user',
				'alias' => 'UserPlanet',
				'from' => 'planetId',
				'to' => 'id',
      ]],
      'limit' => '10',
      'orderBy' => [
        'key' => 'publishDate',
				'order' => 'DESC',
      ],
    ]);

    /*
     SELECT content, publishDate, userId, modified
     FROM publication AS publication
     LEFT JOIN user AS userPlanet
     ON Publication.id = userPlanet.planetId
     ORDER BY publishDate DESC
     LIMIT 0, 10
     */
    var_dump($request);
    return $request;
  }
}
