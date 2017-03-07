<?php
/**
* ////////////////////////////
* @var CommentController
* ////////////////////////////
*/
namespace Controllers;

class Comment extends Controller {

  public function create ($post) {
    $required = ['content', 'userId', 'publicationId'];
    $missingFields = checkRequired($required, $post);
    if (array_key_exists($required, $missingFields)) {
      return false;
    }

    if ($post['content'] === NULL || $post['author'] === NULL || $post['publicationId']) {
      throw new \Utils\RequestException('champ manquant', 400);
    }

    $commentModel = new \Models\Comment();

    $commentModel->save(filterXSS([
      'content' => $post['content'],
      'userId' => $post['author'],
      'publicationId' => $post['publicationId'],
    ]));
  }

  public function update ($post) {
    $required = ['content', 'userId', 'publicationId', 'commentId'];
    $missingFields = checkRequired($required, $post);
    if (array_key_exists($required, $missingFields)) {
      return false;
    }

    if ($post['content'] === NULL || $post['publicationId'] == NULL
     || $post['userId'] || $post['commentId']) {
      throw new \Utils\RequestException('champ manquant', 400);
    }

    $publicationModel = new \Models\Comment();

    $oldPublication = $publicationModel->findFirst([
      'fields' => ['content', 'publicationId', 'id'],
      'conditions' => ['id' => $post['publicationId']],
    ]);

    $publicationModel->save(filterXSS([
      'content' => $post['content'],
      'id' => $post['commentId'],
      'userId' => $post['author'],
      'publicationId' => $post['publicationId'],
      'modified' => +1,
    ]));
  }
}
