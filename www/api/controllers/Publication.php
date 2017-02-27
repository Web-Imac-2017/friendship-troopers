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
    $required = ['title', 'content', 'userId'];
    $missingFields = checkRequired($required, $post);
    if (array_key_exist($required, $missingFields)) {
      return false;
    }

    if ($post['title'] === NULL || $post['content'] === NULL || $post['author'] === NULL) {
      if (!$post['title'])
        echo 'aucun titre';
      if (!$post['content'])
        echo 'aucun contenu';
      if (!$post['author'])
        echo 'auteur invalide';
      return -1;
    }


    $publicationModel = new \Models\Publication();

    $publicationModel->save(filterXSS([
      'title' => $post['title'],
      'content' => $post['content'],
      'userId' => $post['author'],
      'publicationTypeId' => $post['publicationType'],
    ]));
  }

  /**
   * Modify the publication title and/or content
   * @param  char*  $title    the modified title
   * @param  text   $content  the modified content
   * @return int    ...       return value (-1 = error)
   */
  public function update () {
    if (checkRequired(['title', 'content', 'userId', 'publicationId'])) {
      $title = $post['title'];
      $content = $post['content'];
      $publicationId = $post['publicationId'];

      if ($title === NULL || $content === NULL) {
        echo 'aucun contenu';
        return false;
      }

      $publicationModel = new \Models\Publication();

      $oldPublication = $publicationModel->findFirst([
        'fields' => ['title', 'content', 'id'],
        'conditions' => ['id' => $publicationId],
      ]);

      if ($title == $oldPublication['title'] && $content == $oldPublication['content']) {
        echo "aucunes modifications apportées";
        return false;
      }

      $publicationModel->save(filterXSS([
        'id' => $publicationId,
        'title' => $title,
        'content' => $content,
        'modified' => +1,
      ]));
    }
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
      echo "aucun commentaires à supprimer";
    }

    $commentModel->delete(['publicationId' => $id]);

    // THEN DELETE THE ARTICLE FROM THE DB
    $publicationModel = new \Models\Publication();

    if (!$publicationModel->findFirst([
      'fields' => ['id'],
      'conditions' => ['id' => $id],
    ])) {
      echo "article introuvable. ID incorrect";
      return -2;
    }

    $publicationModel->delete($id);
  }
}
