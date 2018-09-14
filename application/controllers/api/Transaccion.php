<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'Api.php';

class Transaccion extends Api {

  public $table_name = "Transaccion";
  public $coulumna_id = "idTransaccion";

  public function __construct() {
      parent::__construct();
     
  }

  	public function index_post(){
     	$data = $this->post();
     	 $nombreBd = "BPCMRCIO";
     	 //$nombreBd = $data['negocioBd'];
	     $db1 = array(
	          'dsn' => 'mysql:host=localhost;dbname='.$nombreBd,
	          'hostname' => 'localhost',

	          'username' => 'root',
	          'password' => '7h8j9k0l!!abc',
	          'database' => $nombreBd,

	          //'username' => 'tumejoreleccion',
	          //'password' => '7h8j9k0l',
	          //'database' => 'tumejoreleccion',
	          

	          'dbdriver' => 'pdo',
	          'dbprefix' => '',
	          'pconnect' => FALSE,
	          'db_debug' => (ENVIRONMENT !== 'production'),
	          'cache_on' => FALSE,
	          'cachedir' => '',
	          'char_set' => 'utf8',
	          'dbcollat' => 'utf8_general_ci',
	          'swap_pre' => '',
	          'encrypt' => FALSE,
	          'compress' => FALSE,
	          'stricton' => FALSE,
	          'failover' => array(),
	          'save_queries' => TRUE
	        );
        $this->negociobd = $this->load->database($db1,true);
     	$cuentaNegocio = $data['cuentaNegocio'];
     	$cuentaCliente = $data['cuentaCliente'];
     	$monto = $data['monto'];
     	$fecha = date("Y-m-d");
     	$numero_referencia = (int) date('Hi').rand(10,999);
     	$numero_referencia1 = (int) date('H').rand(10,99).rand(10,999);

     	$query = $this->otherDb->query("
			SELECT bm.*
			FROM Cuenta c
			JOIN Banca_movil bm ON c.Cliente_idCliente = bm.Cliente_idCliente 
			WHERE c.numero_cuenta = $cuentaCliente
		");
		$cliente = [];
		$token = "";
		if ( is_array($query->result_array()) && !empty($query->result_array()) ) {
			$cliente = $query->result_array();
			$token = $cliente[0]['token'];

		}

     	$query = $this->negociobd->query("
			SELECT * 
			FROM Negocio
		");
		$negocio = NULL;
		if ( is_array($query->result_array())) {
			$negocio =  $query->result_array();
		}
		if(!is_null($negocio) && !empty($negocio)){
			$negocio = $negocio[0];
			$tipo_cobro = $negocio['TipoCobro_idTipoCobro'];
			if($tipo_cobro == 1){

				/*$query = $this->db->query("INSERT INTO `Transaccion` (`idTransaccion`, `fecha_trans`, `monto_trans`, `Estado_trans_idEstado_trans`, `Metodo_pago_idMetodo_pago`, `folio_referencia`, `Tipo_trans_idTipo_trans`, `cuenta`) VALUES (NULL,'$fecha', $monto,1, '1',$numero_referencia, '2',$cuentaCliente) , (NULL, '$fecha', $monto,1, '1', $numero_referencia, '1', $cuentaNegocio)");
				*/

   			 	$data['servicio'] = "sellAccept?price=$monto&ref=$numero_referencia&token=$token";
				$data['metodo'] = METODO_GET;
				$respuesta_push = consumir($data);



			} else if($tipo_cobro == 0){

				$data['servicio'] = "sellAccept?price=$monto&ref=$numero_referencia&token=$token";
				$data['metodo'] = METODO_GET;
				$respuesta_push = consumir($data);

				$data['servicio'] = "sell?price=$monto&ref=$numero_referencia&token=$token";
				$data['metodo'] = METODO_GET;
				$respuesta_push = consumir($data);

				$data['servicio'] = "buy?price=$monto&ref=$numero_referencia&token=$token";
				$data['metodo'] = METODO_GET;
				$respuesta_push = consumir($data);

			}
		}
      
    	
      	$this->response(['error' => false,'msg' => "Registro guardado con éxito"], 200);
    }

    public function aceptaVenta_post(){
     	$data = $this->post();
     	$numeroReferencia = $data['numeroReferencia'];
     	$monto = $data['monto'];
     	$token = $data['token'];

     	$nombreBd = $data['negocioBd'];
	     $db1 = array(
	          'dsn' => 'mysql:host=localhost;dbname='.$nombreBd,
	          'hostname' => 'localhost',

	          'username' => 'root',
	          'password' => '7h8j9k0l!!abc',
	          'database' => $nombreBd,

	          //'username' => 'tumejoreleccion',
	          //'password' => '7h8j9k0l',
	          //'database' => 'tumejoreleccion',
	          

	          'dbdriver' => 'pdo',
	          'dbprefix' => '',
	          'pconnect' => FALSE,
	          'db_debug' => (ENVIRONMENT !== 'production'),
	          'cache_on' => FALSE,
	          'cachedir' => '',
	          'char_set' => 'utf8',
	          'dbcollat' => 'utf8_general_ci',
	          'swap_pre' => '',
	          'encrypt' => FALSE,
	          'compress' => FALSE,
	          'stricton' => FALSE,
	          'failover' => array(),
	          'save_queries' => TRUE
	        );
        $this->negociobd = $this->load->database($db1,true);


     	$query = $this->negociobd->query("
			SELECT * 
			FROM Negocio
		");
		$negocio = NULL;
		if ( is_array($query->result_array())) {
			$negocio =  $query->result_array();
		}
		if(!is_null($negocio) && !empty($negocio)){
			$negocio = $negocio[0];

			/*
			$query = $this->db->query("UPDATE `Transaccion` SET `Estado_trans_idEstado_trans`= 3
			WHERE folio_referencia = '$numeroReferencia'");

			$query = $this->db->query("CALL sp_update_retiro('$numeroReferencia')");
			$query = $this->db->query("CALL sp_update_deposito('$numeroReferencia')");

			*/

			$data['servicio'] = "sell?price=$monto&ref=$numeroReferencia&token=$token";
			$data['metodo'] = METODO_GET;
			$respuesta_push = consumir($data);

			$data['servicio'] = "buy?price=$monto&ref=$numeroReferencia&token=$token";
			$data['metodo'] = METODO_GET;
			$respuesta_push = consumir($data);

		}
      
    	
      	$this->response(['error' => false,'msg' => "Registro guardado con éxito"], 200);
    }



   
}