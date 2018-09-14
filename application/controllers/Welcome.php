<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Welcome extends CI_Controller {


	public function index()
	{
		
		$this->load->view('backend/admin/login');
		
	}

	public function politica()
	{
		
		$this->load->view('frontend/politica');
		
	}
	
	public function login(){
		$datos = $this->input->post();
		$respuesta = consumir($datos);
		$body = json_decode($respuesta['body']);
		
		if (is_object($body) ) {
			$this->session->set_userdata((array)$body);
			echo json_encode(['code' => $respuesta['code']]);
		}else{
			echo json_encode(['code' => 401]);
		}
		
	}

	
}
