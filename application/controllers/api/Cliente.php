<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Api.php';


class Cliente extends Api {

  public $table_name = "oauth_users";
  public $coulumna_id = "id";
  public $name_rules = "rules/cliente";

  public function __construct() {
      parent::__construct();
  }

}