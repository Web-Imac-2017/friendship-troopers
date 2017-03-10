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
    $this->response($response, 200);
  }

  public function create($post){
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administrateurs', 403);
    }


    $required = ['name', 'imagePath'];
    if (!empty($this->checkRequired($required, $post))) {
      throw new \Utils\RequestException('champ manquant', 400);
    }

    $response = $this->Planet->save($this->filterXSS([
      'name' => $post['name'],
      'description' => $post['description'] ?? 'none',
      'imagePath' => $post['imagePath'],
      'history' => $post['history'] ?? 'none',
    ]));
    $this->response(null, 201);
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

}
