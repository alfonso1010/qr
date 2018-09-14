<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Api.php';

class User extends Api {

  public $table_name = "usuarios";
  public $name_rules = "rules/usuarios";

  public function __construct() {
      parent::__construct();
  }

  public function index_post(){
    $this->response("No puedes crear usuarios", 404);
  }

   
}