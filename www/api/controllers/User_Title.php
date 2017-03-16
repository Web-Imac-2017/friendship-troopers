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

  /**
  * Count all titles possessed by a user.
  * @param  int 		$userId 				user id passed by road
  * @param  array 	$get 						associative array passed by method get (datas)
  * @return [type] 	[] 							[description]
  */

  public function count ($userId, $get){
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    $count = $this->User_Title->find([
      'fields' =>['COUNT(userId) AS nbTitle'],
      'conditions' => [
        'UserId' => 1,
      ],
    ]);

    $this->response($count, 200);
  }

  /**
  * List all titles possessed by a user.
  * @param  int 		$userId 				user id passed by road
  * @param  array 	$get 						associative array passed by method get (datas)
  * @return [type] 	[] 							[description]
  */

  public function list ($userId, $get){
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      $fields = ['user.username','honorificTitle', 'price'];
    } else {
      $fields = ['user.id', 'user.username', 'titleId', 'honorificTitle', 'price'];
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

  /**
  * View which title is the user's current title.
  * @param  int 		$userId 				user id passed by road
  * @param  array 	$get 						associative array passed by method get (datas)
  * @return [type] 	[] 							[description]
  */

  public function viewCurrent ($userId, $get){
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      $fields = ['user.username','honorificTitle', 'price'];
    } else {
      $fields = ['user.id', 'user.username', 'titleId', 'honorificTitle', 'price'];
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

  /**
  * Add a title to the user.
  * @param  int 		$userId 				user id passed by road
  * @param  array 	$post 						associative array passed by method post (datas)
  * @return [type] 	[] 							[description]
  */

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

    try {
      $this->User_Title->save($this->filterXSS([
        'titleId' => $post['titleId'],
        'userId' => $userId,
      ]));
    } catch (\PDOException $e) {
      $this->response([
        'error' => $e->getMessage(),
      ], 500);
    }

    $this->response(null, 200);
  }

  /**
  * Set an user's title to current (current = true).
  * @param  int 		$userId 				user id passed by road
  * @param  int 		$titleId 				title id passed by road
  * @param  array 	$patches 						associative array passed by method patch (datas)
  * @return [type] 	[] 							[description]
  */

  public function setCurrent ($userId, $titleId, $patch) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    $currentUserId = \Utils\Session::user('id');
    if (!in_array(\Utils\Session::user('roleId'), [1, 2]) && $userId != $currentUserId) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $checkTitle = $this->User_Title->findFirst([
      'fields' => ['userId'],
      'conditions' => [
        'titleId' => $titleId,
        'userId' => $userId,
      ],
    ]);

    if ($checkTitle == false){
      throw new \Utils\RequestException('ce titre n\'appartient pas a l\utilisateur', 403);
    }

    //find which title is set to current = true
    $oldCurrent = $this->User_Title->findFirst([
      'fields' => ['titleId'],
      'conditions' => [
        'userId' => $userId,
        'current' => 1,
      ],
    ]);
    //set the old current title to current = false
    $oldKeys = ['userId'=> $userId, 'titleId' => $oldCurrent['titleId']];
    $current = ['current'=>'0'];
    try {
      $this->User_Title->saveCurrent($this->filterXSS($current), $this->filterXSS($oldKeys));
    } catch (\PDOException $e) {
      $this->response([
        'error' => $e->getMessage(),
      ], 500);
    }


    //set the new current title to current = 1
    $newKeys = ['userId'=> $userId, 'titleId' => $titleId];
    $current = ['current'=>'1'];
    try {
      $this->User_Title->saveCurrent($this->filterXSS($current), $this->filterXSS($newKeys));
    } catch (\PDOException $e) {
      $this->response([
        'error' => $e->getMessage(),
      ], 500);
    }

    $this->response(null, 200);
  }

  /*
  * Delete an user's title. Accessible to administrators and moderators only
  * @param  int 		$userId 				user id passed by road
  * @param  int 		$titleId 				title id passed by road
  * @param  array 	$delete 		assosiative array passed by method delete (datas)
  * @return [type] 	[] 							[description]
   */

  public function delete ($userId, $titleId, $delete) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $titleCurrent = $this->User_Title->find([
      'fields' => ['current'],
      'conditions' => [
        'userId' => $userId,
        'titleId' => $titleId,
      ],
    ]);
    /*if it is the user's current title, return an error*/
    if($titleCurrent[0]['current'] == '1'){
      throw new \Utils\RequestException('impossible de suprimmer le titre courant', 404);
    }

    try{
      $this->User_Title->delete([
        'userId'=> $userId,
        'titleId'=> $titleId,
      ]);
    } catch (\PDOException $e) {
      $this->response([
        'error' => $e->getMessage(),
      ], 500);
    }

    $this->response(null, 200);
  }




}
