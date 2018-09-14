<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/phpass-0.3/PasswordHash.php';

define('PHPASS_HASH_STRENGTH', 8);
define('PHPASS_HASH_PORTABLE', false);


class Login extends REST_Controller {

    public function __construct() {
        parent::__construct();
        $this->config->load('rules/usuarios');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->database();
        $this->load->model('generico' , 'generico');
    }

    public function alta_post(){
      $data = $this->post();
      $this->form_validation->set_data($data);
      $this->form_validation->set_rules($this->config->item('post'));

      if($this->form_validation->run()==FALSE){
        $this->response($this->form_validation->error_array(), 422);
      }

      if(!isset($data['client']) && !isset($data['client_secret'])){
        $this->response("No puedes crear usuarios", 422);
      }else{
        $registros =  $this->generico->obtenerRegistros([
                        'select' => '*',
                        'from' => 'oauth_clients',
                        'where' => "where client = '".$data['client']."' AND client_secret = '".$data['client_secret']."'"
                      ]);
        if (empty($registros)) {
          $this->response("No puedes crear usuarios Credenciales invalidas", 422);
        }
      }
      unset($data['client']);
      unset($data['client_secret']);
      $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
      $user_pass_hashed = $hasher->HashPassword($data['password']);
      $data['password'] = $user_pass_hashed; 
      if(!isset($data['email'])){
        $data['email'] = aleatorio()."@gmail.com";
      }
      $datos = $this->generico->insertarRegistros([
                  'tabla' => 'usuarios',
                  'datos' => $data
                ]);
      if (is_null($datos) | $datos < 1) {
        $data = [];
        $this->response($data, 422);
      }
      $data['id'] = $datos;
      $this->response($data, 200);
  }

     // se accede con http://miservidor/user/login?format=json
    public function login_post() {
    	$this->load->library('SimpleLoginSecure');
      $user = $this->post('user');
      $password = $this->post('password');
       // attempt to login
      $datos_usuario = $this->simpleloginsecure->login($user,$password);
  		if($datos_usuario !== false) {
          if(isset($datos_usuario['id'])){
            $token =  getToken();
            $eliminar =  $this->generico->eliminarRegistros([
                      'tabla' => 'access_tokens',
                      'columna' => 'usuarios_id',
                      'valor'  => $datos_usuario['id'],
                    ]);
            $data_token = [
              'token' => $token,
              'usuarios_id' => $datos_usuario['id']
            ];
            $datos = $this->generico->insertarRegistros([
                  'tabla' => 'access_tokens',
                  'datos' => $data_token
                ]);
            if($datos == 0){
              $datos_usuario['token'] = $token;
      		    $this->response($datos_usuario, 200);
            }
          }
  		}else{
  			$this->response("Credenciales inválidas", 401);
  		}
    }
}