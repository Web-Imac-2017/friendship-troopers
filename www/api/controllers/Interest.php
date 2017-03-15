<?php
/**
* ////////////////////////////
* @var InterestController
* ////////////////////////////
*/

namespace Controllers;

class Interest extends Controller {
  public function __construct() {
    $this->loadModel('Interest');
  }

/**
 * listInterest list all interests from DB
 * @return [type] [description]
 */
  public function listInterest() {
    $interest = new \Models\Interest();
    $request = $interest->find([
      'fields' => ['id','label','initInterest'],
    ]);
    $this->response($request,200);

  }

  /**
   * addInterest adds a new Interest in the DB
   * @param string $newLabel [description]
   */
  public function addInterest ($newInterests) {
    if(!is_array($newInterests)) {
      throw new \Utils\RequestException('data erronées', 415); // code d'erreur ?
    }
    foreach($newInterests as $key => $value) {
      echo $value;
      $request = $this->Interest->save($this->filterXSS([
        'label' => $value,
        'initInterest' => 0
      ]));
    }

      $this->response($request,200);
  }

  /**
   * addUserInterest add a new user_interest in the DB
   * The interest must exist
   * The user must to not already have this interest
   * @param $data contains all of the interest choosen
   */
  public function addUserInterest ($data) {
    /*Checking if $data is an array*/
    if(!is_array($data)) {
      throw new \Utils\RequestException('data erronées', 415); // code d'erreur ?
    }
      /*Checking if the user is logged in*/
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }
    /*pick up the user logged id*/
    $userId = \Utils\Session::user('id');

    /*create a userInterest to save  new data*/
    $userInterest = new \Models\User_Interest();

    /*Save data*/
    foreach($data as $key => $value) {
      $request = $userInterest->save($this->filterXSS([
        'userId' => $userId,
        'interestId' => $value
      ]));
    }

    $this->response($request,200);
  }

  /**
   * listuserInterest from
   * list all user's interests
   * @param int user's id
   * @return  JSON interests info
   */
  public function listuserInterest($userId) {
    $userInterest = new \Models\User_Interest();
    $request = $userInterest->find([
      'fields' => ['interest.id', 'label'],
      'leftJoin' => [
        [
          'table' => 'user',
  				'alias' => 'User',
  				'from' => 'id',
  				'to' => 'userId',
        ],
        [
          'table' => 'interest',
  				'alias' => 'interest',
  				'from' => 'id',
  				'to' => 'interestId',
        ],
      ],
      'conditions' => ['userId' => $userId]
    ]);
    $this->response($request, 200);
  }

  /**
   * deleteUserInterest function
   * @param  array $data containing user's interests
   * @return [type]       [description]
   */
  public function deleteUserInterest($data) {
    /*Checking if $data is an array*/
    if(!is_array($data)) {
      throw new \Utils\RequestException('data erronées', 403); // code d'erreur ?
    }
      /*Checking if the user is logged in*/
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }
    /*bring back the user logged id*/
    $userId = \Utils\Session::user('id');

    /*create a userInterest to delete interests*/
    $userInterest = new \Models\User_Interest();

    /*delete the interest*/
    foreach ($data as $key => $value) {
      $request = $userInterest->delete(array('userId' => $userId,
                                  'interestId' => $value));
    }

    $this->response($request,200);
  }

  /**
   * deleteInterest deletes one or more interests
   * @param  array $data containing the interests
   * @return [type]       [description]
   */
  public function deleteInterest($data) {
    $this->deleteUserInterest($data);

    foreach($data as $key => $value) {
      $request = $this->Interest->delete($value);
    }
    echo $request;
    $this->response($request,200);
  }

  /**
   * WelcomeOnBoard function
   * update the current user planetId 
   * @param array $interestList containing interestId
   * @return JSON user's id
   */
  public function WelcomeOnBoard ($userId,$data) {
    /*Checking if the user is logged in*/

    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    /*bring back the user logged id*/
    $userIdLogged = \Utils\Session::user('id');

    /*Check if the current user is the same user*/
    if($userIdLogged != $userId) {
      throw new \Utils\RequestException('probleme d\'utilisateur : l\'utilisateur courant est different', 401);
    }

    /*Change the user planet*/
    $user = new \Models\User();
    $request = $user->save($this->filterXSS([
      'id' => $userId,
      'planetId' => $data['planetId']
    ]));

    $this->response($request,200);
  }
}
