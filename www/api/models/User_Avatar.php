<?php
/**
* ////////////////////////////
* @var UserInterestModel
* ////////////////////////////
*/
namespace Models;

class User_Avatar extends Model {
  function __construct($params = false) {
		parent::__construct();
		$this->table = 'user_avatar';
	}

}
