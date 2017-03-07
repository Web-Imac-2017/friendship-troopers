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

  /*$data contains all of the interest the user choose*/
  public function addUserInterest ($data) {
    /*Checking if $data is an array*/
    if(!is_array($data)) {
      throw new \Utils\RequestException('data erronées', 403); // code d'erreur ?
    }
      /*Checking if the user is logged in*/
    if (!\Utils\Session::isLoggedIn()) {
      throw new \Utils\RequestException('operation reservee aux membres', 401);
    }

    $userId = \Utils\Session::user('id');
    $

    /*Looking for the interest Id choosen*/
    foreach($data as $key => $value) {
      if(is_array($key)) {

      }
    }
  }

  public function listuserInterest(){
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
}


 ?>
