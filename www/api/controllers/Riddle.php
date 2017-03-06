<?php
/**
* ////////////////////////////
* @var EnigmeController
* ////////////////////////////
*/
namespace Controllers;

class Riddle extends Controller {

  public function __construct() {
    $this->loadModel('Riddle');
  }

  public function list($get) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      $fields = ['title', 'description'];
    } else {
      $fields = '*';
    }

    $userId = \Utils\Session::user('userId');

    $where = [];
    if (array_key_exists('user', $get)) {
      $where['riddle.userId'] = $get['user'];
    }

    if (array_key_exists('title', $get)) {
      $where['riddle.title'] = [
        'cmp' => 'like',
        'value' => '%'.$get['title'].'%',
      ];
    }

      $request = $this->Riddle->find([
        'fields' => $fields,
        'leftJoin' => [
          'table' => 'user_riddle',
  				'alias' => 'UserRiddle',
  				'from' => 'riddleId',
  				'to' => 'id',
        ],
        'conditions' => $where,
        'orderBy' => [
          'key' => $get['date'] ?? 'startDate',
  				'order' => 'DESC',
        ],
      ]);

      var_dump($request);
      $this->response($request, 200);
  }

  public function create($post) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $required = ['title', 'description'];
    if (!empty($this->checkRequired($required, $post))) {
      throw new \Utils\RequestException('champ manquant', 400);
    }

    try {
      $id = $this->Riddle->save($this->filterXSS([
        'title' => $post['title'],
        'description' => $post['description'],
        'nbParticipants' => $post['nbParticipants']  ?? 2,
        'riddleTypeId' => $post['riddleTypeId'] ?? 1,
        'level' => $post['level'] ?? 1,
        'minReward' => $post['minReward'] ?? 100,
        'maxReward' => $post['maxReward'] ?? 500,
      ]));
    } catch (\PDOException $e) {
      $this->response([
        'error' => $e->getMessage(),
      ], 500);
    }
    $this->response([
      'riddleId' => $id,
    ], 201, [
      'Location' => \Utils\Router\Router::url('riddle.list', [
      'title' => $post['title'],
      'id' => $id,
      ]),
    ]);
  }

  public function update($id, $patches) {
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

    $this->Riddle->save($this->filterXSS($updates));
  }

  public function delete($id, $delete) {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
      throw new \Utils\RequestException('action reservee aux administeurs', 403);
    }

    $this->loadModel('Comment');

    $this->Riddle->delete([
      'id' => $id,
    ]);

    $this->response(null, 204);
  }

}
