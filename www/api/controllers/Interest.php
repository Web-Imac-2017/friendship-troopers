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

  public function listInterest() {
    $interest = new \Models\Interest();
    $request = $interest->find([
      'fields' => ['id','label','initInterest'],
      'conditions' => 'initInterest = 0'
    ]);
    $this->response($request,200);

  }

  /*Add a interest in the DB*/
  public function addInterest ($newLabel) {

      $this->Interest->save($this->filterXSS([
        'label' => $newLabel['label'],
        'initInterest' => 0
      ]));

      echo $newLabel['label'];
  }

  /**
  * Add a new user_interest in the DB
  * The interest must exist
  * The user must to not already have this interest
  * @param $data contains all of the interest choosen */
  public function addUserInterest ($data) {
    /*Checking if $data is an array*/
    if(!is_array($data)) {
      throw new \Utils\RequestException('data erronées', 403); // code d'erreur ?
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
      echo 'on sauvegarde '.$value.' avec '.$userId;
      $userInterest->save($this->filterXSS([
        'userId' => $userId,
        'interestId' => $value
      ]));
    }
  }

  /**
   * [listuserInterest description]
   * @return [type] [description]
   */
  public function listuserInterest() {
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
    ]);
    $this->response($request, 200);
  }

  /**
   * [delete_interest description]
   * @param  [type] $data [description]
   * @return [type]       [description]
   */
  public function delete_interest($data) {
    /*Checking if $data is an array*/
    if(!is_array($data)) {
      throw new \Utils\RequestException('data erronées', 403); // code d'erreur ?
    }
      /*Checking if the user is logged in*/
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }
    /*pick up the user logged id*/
    $userId = \Utils\Session::user('id');

    /*create a userInterest to delete interests*/
    $userInterest = new \Models\User_Interest();

    foreach ($data as $key => $value) {
      echo "$userId and $value";
      $userInterest->delete(array('userId' => $userId,
                                  'interestId' => $value));
      $this->Interest->delete($value);
    }
  }

}
