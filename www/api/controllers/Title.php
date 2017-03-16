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

  /**
	* List all titles.
	* @param  array 	$get 						associative array passed by method get (datas)
	* @return [type] 	[] 							[description]
	*/
  public function list($get){
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    $find = $this->Title->find([
      'fields' => '*',
    ]);

    $this->response($find, 200);

  }

  /**
  * Create a title. Accessible to administrators and moderators only
  * @param  array 	$post 						associative array passed by method post (datas)
  * @return [type] 	[] 							[description]
  */

  public function create ($post) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $required = ['honorificTitle', 'price'];
    if (!empty($this->checkRequired($required, $post))) {
      throw new \Utils\RequestException('champ manquant', 400);
    }

    try{
      $this->Title->save($this->filterXSS([
        'honorificTitle' => $post['honorificTitle'],
        'price' => $post['price'],
      ]));
    } catch (\PDOException $e) {
      $this->response([
        'error' => $e->getMessage(),
      ], 500);
    }

    $this->response(null, 200);
  }

  /**
  * Update a title. Accessible to administrators and moderators only
  * @param  int 		$id 			title id passed by road
  * @param  array 	$patches 						associative array passed by method patch (datas)
  * @return [type] 	[] 							[description]
  */

  public function update ($id, $patches) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $updates = ['id' => $id];
    foreach ($patches as $patch) {
      switch ($patch['op']) {
        case 'replace':
          $updates[explode('/',$patch['path'])[1]] = $patch['value'];
          break;
        default:
          throw new \Utils\RequestException('bad op', 400);
      }
    }

    try{
    $this->Title->save($this->filterXSS($updates));
    } catch (\PDOException $e) {
      $this->response([
        'error' => $e->getMessage(),
      ], 500);
    }

    $this->Title->save($this->filterXSS($updates));
    $this->response(null, 200);
  }

  /**
  * Delete a title. Accessible to administrators and moderators only.
  * @param  int 		$id 			title id passed by road
  * @param  array 	$delete 		associative array passed by method delete (datas)
  * @return [type] 	[] 							[description]
  */

/*
  public function delete ($id, $delete) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    try{
    $this->Title->delete([
    'id'=> $id,
    ]);
    } catch (\PDOException $e) {
      $this->response([
        'error' => $e->getMessage(),
      ], 500);
    }

    $this->response(null, 200);
  }
  */
}
