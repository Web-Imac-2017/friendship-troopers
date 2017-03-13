<?php
/**
 * ///////////////////////
 * @var BadgeModel
 * ///////////////////////
 */
namespace Models;

class Badge extends Model {
  function __construct($params = false) {
    parent::__construct();
    $this->table = 'badge';
  }
}
