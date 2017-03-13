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
  public function list ($publicationId, $get) {
    $count = $this->Stardust->findCount([
      'publicationId' => $publicationId,
    ]);
    $this->response($count, 200);
  }
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
   * @param  POST     $post UserId and PublicationId, both primary keys of the stardust
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