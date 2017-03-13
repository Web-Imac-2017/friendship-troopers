<?php
/**
* ////////////////////////////
* @var InterestModel
* ////////////////////////////
*/
namespace Models;

class Interest extends Model {
  private $id;
  private $label;
  private $initInterest;


    /*GETTERS*/
    public function getId () {
      return $this->id;
    }

    public function getLabel () {
      return $this->label;
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
}
