<?php
/**
* ////////////////////////////
* @var PublicationController
* ////////////////////////////
*/
namespace Controllers;

class Publication extends Controller {

  /**
   * Construction of the principal Model
   */
  public function __construct() {
    $this->loadModel('Publication');
  }

  /**
   * list publications by user or for a simple feed of one particular planet.
   * generate next road to ease front's job
   * @param  int    $planetId   planet id passed by road
   * @param  array  $get        associativ array passed by method get (datas)
   * @return [type] []          [description]
   */
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

    if (array_key_exists('content', $get)) {
      $where['publication.content'] = [
        'cmp' => 'like',
        'value' => '%'.$get['content'].'%',
      ];
    }

    $request = $this->Publication->find([
      'fields' => ['publication.id', 'publication.content', 'publication.publishDate', 'publication.userId', 'publication.modified'],
      'leftJoin' => [
        [
          'table' => 'user',
  				'alias' => 'UserPlanet',
  				'from' => 'id',
  				'to' => 'userId',
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
   * Create a publication. Accessible by administrators and the "author" user only.
   * @param  int    $planet   planet id passed by road
   * @param  array  $post     assosiativ array passed by method post (datas)
   * @return [type] []        [description]
   */
  public function create ($planet, $post) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (\Utils\Session::user('roleId') === 3 && $post['publicationType']) {
      throw new \Utils\RequestException('cannot update publicationType as user', 403);
    }

    $userId = \Utils\Session::user('userId');
    $required = ['content'];
    if (!empty($this->checkRequired($required, $post))) {
      throw new \Utils\RequestException('champ manquant', 400);
    }

    try {
      $id = $this->Publication->save($this->filterXSS([
        'userId' => $userId,
        'content' => $post['content'],
        'publicationTypeId' => $post['publicationType'] ?? 3,
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
   * Update a publication. Accessible by administrators and the "author" user only.
   * @param  int    $planetId   planet id passed by road
   * @param  int    $id         publication id passed by road
   * @param  array  $patches    assosiativ array passed by method patch (datas)
   * @return [type] []          [description]
   */
  public function update ($planetId, $id, $patches) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    $userId = \Utils\Session::user('id');
    $publiUserId = $this->Publication->findFirst([
      'fields' => 'userId',
      'conditions' => ['id' => $id],
    ]);

    if (!in_array(\Utils\Session::user('roleId'), [1, 2]) && $userId != $publiUserId) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $updates = ['id' => $id, 'modified' => true];
    foreach ($patches as $patch) {
      switch ($patch['op']) {
        case 'replace':
          $updates[explode('/',$patch['path'])[1]] = $patch['value'];
          break;
        default:
          throw new \Utils\RequestException('bad op', 400);
      }
    }
    $this->Publication->save($this->filterXSS($updates));
  }

  /**
   * Delete a publication. Accessible by administrators and the "author" user only.
   * it delete all foreign keys firstly.
   * @param  int    $planetId   planet id passed by road
   * @param  int    $id         publication id passed by road
   * @param  array  $delete     assosiativ array passed by method delete (datas)
   * @return [type] []          [description]
   */
  public function delete ($planetId, $id, $delete) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    $userId = \Utils\Session::user('id');
    $publiUserId = $this->Publication->findFirst([
      'fields' => 'userId',
      'conditions' => ['id' => $id],
    ]);

    if (!in_array(\Utils\Session::user('roleId'), [1, 2]) && $userId != $publiUserId) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

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
