<?php
/**
* ////////////////////////////
* @var UserInterestModel
* ////////////////////////////
*/
namespace Models;

class User_Interest extends Model {
  function __construct($params = false) {
		parent::__construct();
		$this->table = 'user_interest';
	}

}
