<?php
/**
* ////////////////////////////
* @var PlanetController
* ////////////////////////////
*/
namespace Controllers;

class Planet extends Controller {

  /**
   * Get the 10 First Publications of the user's Planet
   * @param  char* $get [description]
   * @return [type]              [description]
   */
   /*
    SELECT publication.content, publication.publishDate, publication.userId, publication.modified
    FROM publication AS publication
    LEFT JOIN user AS UserPlanet
      ON Publication.id = UserPlanet.planetId
    LEFT JOIN comment AS publicationComment
      ON Publication.id = publicationComment.publicationId
    LEFT JOIN stardust AS publicationStardust
      ON Publication.id = publicationStardust.publicationId
    ORDER BY publishDate DESC
    LIMIT 0, 10
    */
  public function getPlanetFeed ($get) {
    $userPlanet = $_SESSION['user']['planet'];
    $required = ['planetId'];
    $missingFields = $this->checkRequired($required, $_SESSION);
    $planetModel = new \Models\Planet();
    $request = $planetModel->findFirst([
      'fields' => ['name'],
      'conditions' => ['name' => $userPlanet],
    ]);

    if (array_key_exists('planetId', $missingFields)) {
      echo'planète introuvable';
      return $missingFields;
    } else if ($request['name'] != $get) {
      var_dump('get planet = ' . $get);
      var_dump( $request);
      echo 'vous n\'appartenez pas à cette planète !';
      return false;
    }

    $publicationModel = new \Models\Publication();

    $request = $publicationModel->find([
      'fields' => ['publication.content', 'publication.publishDate', 'publication.userId', 'publication.modified'],
      'leftJoin' => [
        [
          'table' => 'user',
  				'alias' => 'UserPlanet',
  				'from' => 'planetId',
  				'to' => 'id',
        ],
        [
          'table' => 'comment',
  				'alias' => 'publicationComment',
  				'from' => 'publicationId',
  				'to' => 'id',
        ],
        [
          'table' => 'stardust',
  				'alias' => 'publicationStardust',
  				'from' => 'publicationId',
  				'to' => 'id',
        ]
      ],
      'limit' => '0, 10',
      'orderBy' => [
        'key' => 'publishDate',
				'order' => 'DESC',
      ],
    ]);
    return json_encode($request, JSON_PRETTY_PRINT);
  }

  public function getLastComment ($get) {
    $required = ['planetId'];
    $missingFields = $this->checkRequired($required, $_SESSION);

    if (array_key_exists($required, $missingFields)) {
      echo'planète introuvable';
      return $missingFields;
    }

    $CommentModel = new \Models\Comment();

    $request = $CommentModel->findFirst([
      'fields' => ['content', 'publishDate', 'userId', 'modified'],
      'conditions' => '',
    ]);

  }
}
