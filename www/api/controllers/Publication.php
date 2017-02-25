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
  public function view ($title) {
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
  public function create ($title, $content, $author) {
    $publicationModel = new \Models\Publication();

    if ($title === NULL || $content === NULL || $author === NULL) {
      if (!$title)
        echo 'aucun titre';
      if (!$content)
        echo 'aucun contenu';
      if (!$author)
        echo 'auteur invalide';
      return -1;
    }

    $data = [
      'title' => $title,
      'content' => $content,
      'userId' => $author,
    ];

    $this->filterXSS($data);
    $publicationModel->save($data);
  }

  /**
   * Modify the publication title and/or content
   * @param  char*  $title    the modified title
   * @param  text   $content  the modified content
   * @return int    ...       return value (-1 = error)
   */
  public function update ($title, $content, $publicationId) {
    $publicationModel = new \Models\Publication();

    if ($title === NULL || $content === NULL) {
      echo 'aucun contenu';
      return -1;
    }

    $oldPublication = $publicationModel->findFirst([
      'fields' => ['title', 'content', 'id'],
      'conditions' => ['id' => $publicationId],
    ]);
    var_dump($oldPublication);

    if ($title == $oldPublication['title'] && $content == $oldPublication['content']) {
      echo "aucune modifications apportées";
      return -2;
    }

    $data = [
      'id' => $publicationId,
      'title' => $title,
      'content' => $content,
      'modified' => +1,
    ];

    $this->filterXSS($data);
    $publicationModel->save($data);
  }

  /**
   * Delete one article from DB, based on the article ID
   * @param  int  $id   the article ID
   * @return int  ...   return value (-1 = error)
   */
  public function delete ($id) {
    // FIRST THINGS FIRST : DELETE ALL COMMENTS LINKED TO THE PUBLICATION
    $commentModel = new \Models\comment();

    if (!$commentModel->find([
      'fields' => ['publicationId'],
      'conditions' => ['publicationId' => $id],
    ])) {
      echo "aucun commentaires à supprimer";
      return -1;
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
