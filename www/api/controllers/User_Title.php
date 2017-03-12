<?php
/**
* ////////////////////////////
* @var User_TitleController
* ////////////////////////////
*/
namespace Controllers;

class User_Title extends Controller {

  public function __construct() {
    $this->loadModel('User_Title');
  }

  public function add ($userId, $post) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $required = ['titleId'];
    if (!empty($this->checkRequired($required, $post))) {
      throw new \Utils\RequestException('champ manquant', 400);
    }

    $this->User_Title->save($this->filterXSS([
      'titleId' => $post['titleId'],
      'userId' => $userId,
      'current' => $post['$current'] ?? 0,
    ]));

    $this->response(null, 200);
  }
}
