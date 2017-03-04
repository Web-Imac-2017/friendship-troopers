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

  }

  public function getLastComment ($get) {
    $required = ['planetId'];
    $missingFields = $this->checkRequired($required, $_SESSION);

    if (array_key_exists($required, $missingFields)) {
      throw new \Utils\RequestException('planète introuvable', 404);
    }

    $CommentModel = new \Models\Comment();

    $request = $CommentModel->findFirst([
      'fields' => ['content', 'publishDate', 'userId', 'modified'],
      'conditions' => '',
    ]);

  }
}
