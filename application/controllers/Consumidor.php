<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consumidor extends CI_Controller {

	public function __construct(){
        parent::__construct();
        if (validarUsuario($this->session->userdata()) == FALSE) {
        	redirect('/welcome/index');
        }
        
    }

	public function consumir(){	
		$datos = $this->input->post();
		$respuesta = consumir($datos);
		echo json_encode(['code' => $respuesta['code'], 'body' => $respuesta['body']]);
		
	}

	
}
