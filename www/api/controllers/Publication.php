<?php
/**
* ////////////////////////////
* @var PublicationController
* ////////////////////////////
*/
namespace Controllers;

class Publication extends Controller {

  /**
   * Return the fields of the article, by it's title
   * @param  char*  $title  the article title
   * @return int    ...     return value (-1 = error)
   */
  public function viewFirst ($title) {
    $publicationModel = new \Models\Publication();

    $request = $this->publicationModel->findFirst([
      'fields' => ['title', 'content', 'publishDate', 'userId'],
      'conditions' => ['title' => $title]
    ]);
  }

  /**
   * Create an article in the DB, based on the data sent
   * @param  char*  $title    the article title
   * @param  text   $content  the content (text field)
   * @param  int    $author   the author id (foreignKey)
   * @return int    ...       return value (-1 = error)
   */
  public function create ($post) {
    $required = ['content', 'userId'];
    $missingFields = checkRequired($required, $post);
    if (array_key_exists($required, $missingFields)) {
      return false;
    }

    if ($post['content'] === NULL || $post['author'] === NULL) {
      throw new \Utils\RequestException('champ manquant', 400);
    }


    $publicationModel = new \Models\Publication();

    $publicationModel->save(filterXSS([
      'content' => $post['content'],
      'userId' => $post['author'],
      'publicationTypeId' => $post['publicationType'],
    ]));
  }

  /**
   * Modify the publication title and/or content
   * @param  POST   $post     post method from front
   * @return int    ...       return value (-1 = error)
   */
  public function update ($post) {
    $required = ['content', 'userId', 'publicationId'];
    $missingFields = checkRequired($required, $post);
    if (array_key_exists($required, $missingFields)) {
      return false;
    }

    if ($post['content'] === NULL || $post['userId'] === NULL || $post['publicationId'] === NULL) {
      throw new \Utils\RequestException('champ mamquant', 400);
    }

    $publicationModel = new \Models\Publication();

    $oldPublication = $publicationModel->findFirst([
      'fields' => ['content', 'id'],
      'conditions' => ['id' => $post['publicationId']],
    ]);

    $publicationModel->save(filterXSS([
      'id' => $post['publicationId'],
      'content' => $post['content'],
      'modified' => +1,
    ]));
  }

  /**
   * Delete one article from DB, based on the article ID
   * @param  int  $id   the article ID
   * @return int  ...   return value (-1 = error)
   */
  public function delete ($post) {
    // FIRST THINGS FIRST : DELETE ALL COMMENTS LINKED TO THE PUBLICATION
    $commentModel = new \Models\comment();

    if (!$commentModel->find([
      'fields' => ['publicationId'],
      'conditions' => ['publicationId' => $id],
    ])) {
      throw new \Utils\RequestException("aucun commentaires à supprimer", 404);
    }

    $commentModel->delete(['publicationId' => $id]);

    // THEN DELETE THE ARTICLE FROM THE DB
    $publicationModel = new \Models\Publication();

    if (!$publicationModel->findFirst([
      'fields' => ['id'],
      'conditions' => ['id' => $id],
    ])) {
      throw new \Utils\RequestException("article introuvable. ID incorrect", 404);
    }

    $publicationModel->delete($id);
  }
}
