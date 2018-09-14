<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Api.php';

class Notificacion extends Api {

   

    public function __construct() {
        parent::__construct();
    }
	 public function index_post(){
     	$data = $this->post();
     	$monto = $data['monto'];
     	$token = $data['token'];
        $numero_referencia = (int) date('Hi').rand(10,999);
     
		$data['servicio'] = "sell?price=$monto&ref=$numero_referencia&token=$token";
		$data['metodo'] = METODO_GET;
		$respuesta_push = consumir($data);

      	$this->response(['error' => false,'msg' => "Envio notificación"], 200);
    }


}