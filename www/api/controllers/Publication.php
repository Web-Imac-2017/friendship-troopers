<?php
/**
* ////////////////////////////
* @var PublicationController
* ////////////////////////////
*/
namespace Controllers;

class Publication extends Controller {

  public function __construct() {
    $this->loadModel('Publication');
  }

  public function list($planetId, $get) {
    if (\Utils\Session::user('planetId') !== $planetId) {
      throw new \Utils\RequestException('vous n\'appartenez pas à cette planète !', 403);
    }

    $offset = +($get['offset'] ?? 0);
    $limit = +($get['limit'] ?? 10);
    if ($limit > 10) {
      throw new \Utils\RequestException('limit trop elevee', 416);
    }

    $where = [];
    if (array_key_exists('user', $get)) {
      $where['publication.userId'] = $get['user'];
    }

    if (array_key_exists('title', $get)) {
      $where['publication.title'] = [
        'cmp' => 'like',
        'value' => '%'.$get['title'].'%',
      ];
    }

    $request = $this->Publication->find([
      'fields' => ['publication.id', 'publication.title', 'publication.content', 'publication.publishDate', 'publication.userId', 'publication.modified'],
      'leftJoin' => [
        [
          'table' => 'user',
  				'alias' => 'UserPlanet',
  				'from' => 'id',
  				'to' => 'userId',
        ],
        [
          'table' => 'comment',
  				'alias' => 'publicationComment',
  				'from' => 'publicationId',
  				'to' => 'id',
        ],
        [
          'table' => 'stardust',
  				'alias' => 'publicationStardust',
  				'from' => 'publicationId',
  				'to' => 'id',
        ]
      ],
      'conditions' => $where,
      'limit' => "$offset, $limit",
      'orderBy' => [
        'key' => 'publishDate',
				'order' => 'DESC',
      ],
    ]);

    $offset = $offset + $limit;
    $listUrl = \Utils\Router\Router::url('planets.posts.list', [
      'planet' => $planetId,
    ]);
    $this->response($request, 200, [
      'Link' => "\"$listUrl?offset=$offset&limit=$limit\"; rel=\"next\", \"$listUrl?page=$offset&limit=$limit\"; rel=\"last\"",
    ]);
  }

  /**
   * Create an article in the DB, based on the data sent
   * @param  char*  $title    the article title
   * @param  text   $content  the content (text field)
   * @param  int    $author   the author id (foreignKey)
   * @return int    ...       return value (-1 = error)
   */
  public function create ($planet, $post) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (\Utils\Session::user('roleId') === 3 && $post['publicationType']) {
      throw new \Utils\RequestException('cannot update publicationType as user', 403);
    }

    $userId = \Utils\Session::user('userId');
    $required = ['content', 'title'];
    if (!empty($this->checkRequired($required, $post))) {
      throw new \Utils\RequestException('champ manquant', 400);
    }

    try {
      $id = $this->Publication->save($this->filterXSS([
        'userId' => $userId,
        'content' => $post['content'],
        'publicationTypeId' => $post['publicationType'] ?? 3,
        'title' => $post['title'],
      ]));
    } catch (\PDOException $e) {
      $this->response([
        'error' => $e->getMessage(),
      ], 500);
    }

    $this->response([
      'publicationId' => $id,
    ], 201, [
      'Location' => \Utils\Router\Router::url('planets.posts.view', [
      'planet' => $planet,
      'id' => $id,
      ]),
    ]);
  }

  /**
   * Modify the publication title and/or content
   * @param  POST   $post     post method from front
   * @return int    ...       return value (-1 = error)
   */
  public function update ($planetId, $id, $post) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (\Utils\Session::user('roleId') === 3 && $post['publicationType']) {
      throw new \Utils\RequestException('cannot update publicationType as user', 403);
    }

    $required = ['content', 'title'];
    if (!empty(checkRequired($required, $post))) {
     throw new \Utils\RequestException('champ mamquant', 400);
    }

    // Checker si c'est bien le bon utilisateur qui modifie, ou un admin
    $this->Publication->save(filterXSS([
      'id' => $id,
      'content' => $post['content'],
      'title' => $post['title'],
      'modified' => true,
    ]));
  }

  /**
   * Delete one article from DB, based on the article ID
   * @param  int  $id   the article ID
   * @return int  ...   return value (-1 = error)
   */
  public function delete ($planetId, $id, $post) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    // verifier que c'est le bon utilisateur ou un admin

    $this->loadModel('Comment');

    $this->Comment->delete([
      'publicationId' => $id,
    ]);

    $this->Publication->delete([
      'id' => $id,
    ]);

    $this->response(null, 204);
  }
}
