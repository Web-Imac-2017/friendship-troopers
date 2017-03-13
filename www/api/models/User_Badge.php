<?php
/**
 * ///////////////////////
 * @var User_BadgesModel
 * ///////////////////////
 */
namespace Models;

class User_Badge extends Model {
  function __construct($params = false) {
    parent::__construct();
    $this->table = 'user_badge';
  }
}
