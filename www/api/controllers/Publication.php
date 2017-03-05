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

  /**
   * Return the fields of the article, by it's title
   * @param  char*  $title  the article title
   * @return int    ...     return value (-1 = error)
   */
  public function viewFirst ($title) {
    $request = $this->Publication->findFirst([
      'fields' => ['title', 'content', 'publishDate', 'userId'],
      'conditions' => ['title' => $title]
    ]);
  }

  public function list($planetId, $get) {
    $planetModel = new \Models\Planet();

    /*$userPlanet = $_SESSION['user']['planet'];
    $required = ['planetId'];
    $missingFields = $this->checkRequired($required, $_SESSION);
    $request = $planetModel->findFirst([
      'fields' => ['name'],
      'conditions' => ['name' => $userPlanet],
    ]);

    if (array_key_exists('planetId', $missingFields)) {
      throw new \Utils\RequestException('planète introuvable', 404);
    } else if ($request['name'] != $get) {
      throw new \Utils\RequestException('vous n\'appartenez pas à cette planète !', 403);
    }*/

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
    // Si utilisateur normal + publicationType => erreur 403
    // Recuperer le userId dans la session
    $userId = 6;
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
  public function update ($post) {
    // Si utilisateur normal + publicationType => erreur 403
    // Recuperer le userId dans la session
    $required = ['content', 'title'];
    if (!empty(checkRequired($required, $post))) {
     throw new \Utils\RequestException('champ mamquant', 400);
    }

    $this->Publication->save(filterXSS([
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
