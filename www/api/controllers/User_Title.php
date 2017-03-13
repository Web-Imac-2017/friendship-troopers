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

  public function list ($userId, $get){
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      $fields = ['user.username','label', 'price'];
    } else {
      $fields = ['user.id', 'user.username', 'titleId', 'label', 'price'];
    }

    $find = $this->User_Title->find([
      'fields' => $fields,
      'conditions' => [
        'user.id' => $userId,
      ],
      'leftJoin' => [
        [
          'table' => 'user',
  				'alias' => 'User',
  				'from' => 'id',
  				'to' => 'userId',
        ],
        [
          'table' => 'title',
  				'alias' => 'title',
  				'from' => 'id',
  				'to' => 'titleId',
        ],
      ],
    ]);

    $this->response($find, 200);
  }

  public function viewCurrent ($userId, $get){
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      $fields = ['user.username','label', 'price'];
    } else {
      $fields = ['user.id', 'user.username', 'titleId', 'label', 'price'];
    }

    $find = $this->User_Title->find([
      'fields' => $fields,
      'conditions' => [
        'user.id' => $userId,
        'current' => 1,
      ],
      'leftJoin' => [
        [
          'table' => 'user',
  				'alias' => 'User',
  				'from' => 'id',
  				'to' => 'userId',
        ],
        [
          'table' => 'title',
  				'alias' => 'title',
  				'from' => 'id',
  				'to' => 'titleId',
        ],
      ],
    ]);

    $this->response($find, 200);
  }


  public function add ($userId, $post) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    $currentUserId = \Utils\Session::user('id');
    if (!in_array(\Utils\Session::user('roleId'), [1, 2]) && $userId != $currentUserId) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $required = ['titleId'];
    if (!empty($this->checkRequired($required, $post))) {
      throw new \Utils\RequestException('champ manquant', 400);
    }

    $this->User_Title->save($this->filterXSS([
      'titleId' => $post['titleId'],
      'userId' => $userId,
      'current' => $post['current'] ?? 0,
    ]));

    $this->response(null, 200);
  }


  public function setCurrent ($userId, $titleId, $patch) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    $currentUserId = \Utils\Session::user('id');
    if (!in_array(\Utils\Session::user('roleId'), [1, 2]) && $userId != $currentUserId) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    //find which title is set to current = true
    $oldCurrent = $this->User_Title->findFirst([
      'fields' => ['titleId'],
      'conditions' => [
        'user.id' => $userId,
        'current' => 1,
      ],
      'leftJoin' => [
        [
          'table' => 'user',
          'alias' => 'User',
          'from' => 'id',
          'to' => 'userId',
        ],
        [
          'table' => 'title',
          'alias' => 'title',
          'from' => 'id',
          'to' => 'titleId',
        ],
      ],
    ]);
    var_dump($oldCurrent['titleId']);
    //set the old current title to current = false
    $oldKeys = ['userId'=> $userId, 'titleId' => $oldCurrent['titleId']];
    $current = ['current'=>'0'];
    var_dump($oldKeys);
    $this->User_Title->saveCurrent($this->filterXSS($current), $this->filterXSS($oldKeys));

    //set the new current title to current = 1
    $newKeys = ['userId'=> $userId, 'titleId' => $titleId];
    $current = ['current'=>'1'];
    var_dump($newKeys);
    $this->User_Title->saveCurrent($this->filterXSS($current), $this->filterXSS($newKeys));

    //$this->response(null, 200);
  }

  public function delete ($userId, $titleId, $delete) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    $currentUserId = \Utils\Session::user('id');
    /*non-admins can't delete the default title*/
    if (!in_array(\Utils\Session::user('roleId'), [1, 2]) && $userId != $currentUserId || (!in_array(\Utils\Session::user('roleId'), [1, 2]) && $titleId == 1)) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $this->User_Title->delete([
      'userId'=> $userId,
      'titleId'=> $titleId,
    ]);
    $this->response(null, 200);
  }




}
