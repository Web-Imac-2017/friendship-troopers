<?php
/**
* ////////////////////////////
* @var PlanetController
* ////////////////////////////
*/
namespace Controllers;

class Planet extends Controller {

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
