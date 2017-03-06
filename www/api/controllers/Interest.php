<?php
/**
* ////////////////////////////
* @var ApplicationInterest
* ////////////////////////////
*/

namespace Controllers;

class Interest extends Controller {
  private $id;
  private $label;
  private $initInterest;

  /*CONSTRUCTOR*/
  public function __construct() {
    $this->loadModel('Interest');
  }

  /*GETTERS*/
  public function getId () {
    return $this->id;
  }

  public function getLabel () {
    return $this->label;
  }

  public function getInitInterest () {
    return $this->initInterest;
  }


  /*SETTERS*/
  public function setId ($newId) {
    $this->id = (int) $newId;
  }

  public function setLabel ($newLabel) {
    if(is_string($newLabel))
      $this->label = $newLabel;
  }

  public function setInitInterest ($newInitInterest) {
    if($newInitInterest != 0 && $newInitInterest != 1)
      $this->initInterest = 0;
    else
      $this->initInterest = $newInitInterest;
  }
  /*FEATURES*/
  public function hydrate ($data) {
    if(is_array($data))
    {
      $this->id = setId ($data['id']);
      $this->label = setLabel ($data['label']);
      $this->initInterest = setInitInterest ($data['initInterest']);
    }
  }

  public function display () {
    $info = 'Interest #'.$this->getId().'<br>';
    $info .='Label : '.$this->getLabel.'<br>';
    $info .= 'Is an initial interest ? ';
    if($this->getInitInterest())
      $info .= 'yes<br>';
    else
      $info .= 'no<br>';

    echo $info;
  }
}


 ?>
