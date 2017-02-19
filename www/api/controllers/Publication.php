<?php
/**
* ////////////////////////////
* @var PublicationController
* ////////////////////////////
*/
namespace Controllers;

class Publication extends Controller {

  public function view($id) {
    $model = new \Models\Publication();
    $request = $model->findFirst(['fields' => ['title', 'content'],
                          'conditions' => ['id', $id]]);
    var_dump($request);
  }
}
