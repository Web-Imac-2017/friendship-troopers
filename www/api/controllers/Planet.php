<?php

/**
* ////////////////////////////
* @var PlanetController
* ////////////////////////////
*/
namespace Controllers;

class Planet extends Controller {


  public function __construct () {
    $this->loadModel('Planet');
  }


  public function create($post){
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administrateurs', 403);
    }

    $required = ['name','imagePath'];
    if(count($this->checkRequired($required,$post)) > 0) {
      //return json_encode($array);
      throw new \Utils\RequestException('champs manquants', 404);
    }

    if(empty($post['name']) || empty($post['description']) || empty($post['imagePath'])) {
      //return json_encode($array);
      throw new \Utils\RequestException('champs vides', 404);
    }

    $response = $this->Planet->save($this->filterXSS([
      'name' => $post['name'],
      'description' => $post['description'] ?? 'none',
      'imagePath' => $post['imagePath'],
      'history' => $post['history'] ?? 'none',
    ]));
    var_dump($response);
    $this->response(null, 204);
  }

  public function delete($planetId, $delete){
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administrateurs', 403);
    }

   $this->Planet->delete($this->filterXSS([
     'id' => $planetId,
   ]));

   $this->response(null, 204);
}

public function list($get){
  if (!\Utils\Session::isLoggedIn()) {
    throw new \Utils\RequestException('operation reservee aux membres', 401);
  }

  if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
    throw new \Utils\RequestException('action reservee aux administrateurs', 403);
  }
  $response = $this->Planet->find([
    'fields' => '*',
  ]);
  var_dump($response);
  }

}
