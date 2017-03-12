<?php
/**
* ////////////////////////////
* @var TitleController
* ////////////////////////////
*/
namespace Controllers;

class Title extends Controller {

  public function __construct() {
    $this->loadModel('Title');
  }

  public function list($get){
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      $fields = ['label', 'price'];
    } else {
      $fields = '*';
    }

    $find = $this->Title->find([
      'fields' => $fields,
    ]);

    $this->response($find, 200);

  }

  public function create ($post) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $required = ['label', 'price'];
    if (!empty($this->checkRequired($required, $post))) {
      throw new \Utils\RequestException('champ manquant', 400);
    }

    $this->Title->save($this->filterXSS([
      'label' => $post['label'],
      'price' => $post['price'],
    ]));

    $this->response(null, 200);
  }

/*
  public function delete ($id, $delete) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $this->Title->delete([
      'id'=> $id,
    ]);

    $this->response(null, 200);
  }
  */
}
