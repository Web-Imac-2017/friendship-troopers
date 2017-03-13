<?php
/**
 * ///////////////////////
 * @var BadgeController
 * ///////////////////////
 */

namespace Controllers;

class Badge extends Controller {

  public function __construct() {
    $this->loadModel('Badge');
  }

/**
 * read function
 * collect all badges in the DB
 * @return  the badges list
 */
  public function read() {
    $badgeList = $this->Badge->find([
      'fields' => ['id',
                  'label',
                  'description',
                  'funFact',
                  'imagePath',
                  'locked',
                  'requirement'],
                ]);

    $this->response($badgeList,200);
  }

/**
 * create function
 * @param  associative array $newBadge containing
 * the fields of the new badge
 * @return JSON add info
 */
  public function create($newBadge) {
    if(!is_array($newBadge)) {
      throw new \Utils\RequestException('données erronées', 403);
    }

      $request = $this->Badge->save($this->filterXSS([
        'label' => $newBadge['label'],
        'description' =>$newBadge['description'],
        'funFact' => $newBadge['funFact'],
        'imagePath' => $newBadge['imagePath'],
        'locked'=> $newBadge['locked'],
        'requirement' => $newBadge['requirement']
      ]));

      $this->response($request,200);
    }

  /**
   * update function
   * @param  array $badge containing the new fields
   * of the badge
   * @return JSON update info
   */
    public function update($badge) {
      if(!is_array($badge)) {
        throw new \Utils\RequestException('donnees erronees', 403);
      }

      if($this->checkRequired(array('id',
                                   'label',
                                   'description',
                                   'funFact',
                                   'imagePath',
                                   'locked',
                                   'requirement'),
                                   $badge)) {
        throw new \Utils\RequestException('tous les champs ne sont pas indiques correctement', 403);
      }

      $request = $this->Badge->save($this->filterXSS([
        'id' => $badge['id'],
        'label' => $badge['label'],
        'description' => $badge['description'],
        'funFact' => $badge['funFact'],
        'imagePath' => $badge['imagePath'],
        'locked'=> $badge['locked'],
        'requirement' => $badge['requirement']
      ]));

      $this->response($request,200);
    }

    /**
     * delete function
     * @param  array $badgeList containing the id
     * of the $badge to delete
     * @return JSON delete info
     */
    public function delete($badgeList) {
      if(!is_array($badgeList)) {
        throw new \Utils\RequestException('donnees erronees', 403);
      }

      if (!\Utils\Session::isLoggedIn()) {
        throw new \Utils\RequestException('operation reservee aux membres', 401);
      }
      $userId = \Utils\Session::user('id');

      $userBadge = new \Models\User_Badge();

      $this->deleteUserBadge($badgeList);
      foreach($badgeList as $key => $value) {
        if(!is_numeric($value)) {
          throw new \Utils\RequestException('la saisie n\'est pas un id', 403);
        }
        $request = $this->Badge->delete($value);
      }
      $this->response($request,200);

    }

    /**
     * readUserBadge function
     * list links between the user logged in
     *  and his badges
     * @return JSON user's badges info
     */
    public function readUserBadge() {
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
      }
      $userId = \Utils\Session::user('id');

      $userBadge = new \Models\User_Badge();

      $request = $userBadge->find([
        'fields' => ['userId','badgeId','display'],
        'conditions' => ['userId = '.$userId,
                        'display = 1'],
      ]);

      $this->response($request,200);
    }

    /**
     * addUserBadge function
     * add a link between a user and a badge
     * in the DB
     * @param array $badgeList containing id of badges
     */
    public function addUserBadge($badgeList) {
      /*Checking if the user is logged in*/
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
      }

    if (!is_array($badgeList)) {
      throw new \Utils\RequestException('donnees erronnes', 403);
    }

      /*retrieve the user logged id*/
      $userId = \Utils\Session::user('id');

      /*Create a new userBadge controller */
      $userBadge = new \Models\User_Badge();

      foreach($badgeList as $key => $value) {
        $request = $userBadge->save($this->filterXSS([
          'userId' => $userId,
          'badgeId' => $value,
          'display' => 1
        ]));
      }

      $this->response($request,200);
    }

    /**
     * deleteUserBadge function
     * @param  array $badgeList containing the badges' id
     * @return JSON delete info
     */
    public function deleteUserBadge($badgeList) {
      if (!\Utils\Session::isLoggedIn()) {
        throw new \Utils\RequestException('operation reservee aux membres', 401);
        }

      if (!is_array($badgeList)) {
        throw new \Utils\RequestException('donnees erronnes', 403);
      }

        /*retrieve the user logged id*/
        $userId = \Utils\Session::user('id');
        $userBadge = new \Models\User_Badge();

        foreach($badgeList as $key => $value) {
          $request = $userBadge->delete(array(
            'userId' => $userId,
            'badgeId' => $value
          ));
        }

      $this->response($request, 200);
    }
  }
