<?php
/**
* ////////////////////////////
* @var StardustController
* ////////////////////////////
*/
namespace Controllers;

class Stardust extends Controller {

  /**
   * Create a stardust for a publication, there can only be one by user and publication
   * @param  POST     $post Post request from the route
   * @return boolean  ...   true if like created, false if not
   */
  public function create ($post) {
    $required = ['userId', 'publicationId'];
    $missingFields = checkRequired($required, $post);
    if (array_key_exists($required, $missingFields)) {
      return $missingFields;
    }

    if ($post['userId'] === NULL || $post['publicationId'] === NULL) {
      echo 'penser à throw exception';
      return false;
    }

    $StardustModel = new \Models\Stardust();
    $StardustModel->save(filterXSS([
      'userId' => $post['userId'],
      'publicationId' => $post['publicationId'],
    ]));
    return true;
  }

  /**
   * Delete a stardust from a publication
   * @param  POST     $post UserId and PublicationId, both primary keys of the stardust
   * @return boolean  ...   true if delete succed, false if like not found
   */
  public function delete ($post) {
    $StardustModel = new \Models\Stardust();

    if (!$stardustModel->findFirst([
      'userId' => $post['userId'],
      'publicationId' => $post['publicationId'],
      ])) {
        echo "penser à renvoyer une exception ou à trhow";
        return false;
    }

    $StardustModel->delete([
      'userId' =>$post['userId'],
      'publicationId' => $post['publicationId'],
    ]);
    return true;
  }
}
