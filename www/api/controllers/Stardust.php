<?php
/**
* ////////////////////////////
* @var StardustController
* ////////////////////////////
*/
namespace Controllers;
class Stardust extends Controller {
  public function __construct() {
    $this->loadModel('Stardust');
  }

  /**
  * Count stardusts (likes) for a publication.
  * @param  int 		$publicationId 	publication id passed by road
  * @param  array 	$get 						associativ array passed by method get (datas)
  * @return [type] 	[] 							[description]
  */

  public function list ($publicationId, $get) {
    $count = $this->Stardust->findCount([
      'publicationId' => $publicationId,
    ]);
    $this->response($count, 200);
  }

  /**
  * Checks if stardust exists for a publication.
  * @param  int 		$publicationId 	publication id passed by road
  * @param  array 	$get 						associativ array passed by method get (datas)
  *  @return boolean  ...   true if stardust exists, false if not
  */

  public function exist ($publicationId, $get) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }
    $userId = \Utils\Session::user('id');
    $count = $this->Stardust->findCount([
      'publicationId' => $publicationId,
      'userId' => $userId,
    ]);

    if ($count['count'] != 0) {
      $count['count'] = 1;
    }
    $this->response($count['count'] , 200);
  }
  /**
   * Create a stardust for a publication, there can only be one by user and publication
   * @param  int 		$publicationId 				publication id passed by road
   * @param  POST     $post Post request from the route
   * @return boolean  ...   true if like created, false if not
   */
  public function create ($publicationId, $post) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }
    $userId = \Utils\Session::user('id');
    try {
      $id = $this->Stardust->insert($this->filterXSS([
        'userId' => $userId,
        'publicationId' => $publicationId,
      ]));
    } catch (\PDOException $e) {
      $this->response([
        'error' => $e->getMessage(),
      ], 500);
    }
    $this->response(null, 201);
  }
  /**
   * Delete a stardust from a publication
   * @param  int 		$publicationId 				publication id passed by road
   * @param  array 	$delete 		assosiative array passed by method delete (datas)
   * @return boolean  ...   true if delete succed, false if like not found
   */
  public function delete ($publicationId, $delete) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }
    $userId = \Utils\Session::user('id');
    $stardustUserId = $this->Stardust->findFirst([
      'fields' => 'userId',
      'condition' => ['publicationId' => $publicationId],
    ]);
    if (!in_array(\Utils\Session::user('roleId'), [1, 2]) && $userId != $stardustUserId['userId']) {
      throw new \Utils\RequestException('action reservee aux administrateurs', 403);
    }
    $this->Stardust->delete([
      'userId' => $userId,
      'publicationId' => $publicationId,
    ]);
    $this->response(null, 204);
  }
}
