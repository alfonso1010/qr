
<?php
class Generico extends CI_Model {
// model constructor function
function __construct() {
    parent::__construct(); // call parent constructor
    $this->load->database();
}
	
	/**
	* Método que obtiene los registros de todas las tablas de la bd
	* @param String $data['select'] hace referencia a las columnas a seleccionar ejemplo: "id,nombre,apellido"
	* @param String $data['from'] hace referencia al nombre de la tabla de la que se obtendran los registros
	* @param String $data['where'] hace referencia a la condicion que tomara la query ejemplo: "status = 1"
	*/
	public function obtenerRegistros($data = array()) {

		$select = (isset($data['select']))?$data['select']:"*";
		$from = (isset($data['from']))?$data['from']:"";
		$limit = (isset($data['limit']))?$data['limit']:"";
		$where = (isset($data['where']))?$data['where']:"";
		$join = (isset($data['join']))?$data['join']:"";
		$query = $this->db->query("
			SELECT $select
			FROM $from
			$join
			$where
			$limit
		");
		if ( is_array($query->result_array())) {
			return $query->result_array();
		}
	}

	/**
	* Método que inserta registros a todas las tablas de la bd
	* @param String $data['tabla']  hace referencia al nombre de la tabla a la que insertara el registro
	* @param Array $data['datos'] hace referencia a los datos que se 
	*        insertaran ejemplo: ['id' => 1,'nombre' => 'alfonso'];
	* @param String $data['tipo'] hace referencia al tipoo de insersion ya sea normal o un batch
	*/
	public function insertarRegistros($data = array()) {

		$tabla = (isset($data['tabla']))?$data['tabla']:"";
		$datos = (isset($data['datos']))?$data['datos']:array();
		$tipo = (isset($data['tipo']))?$data['tipo']:INSERT_NORMAL;

		if($tipo == INSERT_NORMAL){
			$this->db->insert($tabla, $datos);
			$res =  $this->db->insert_id();
		}else if($tipo == INSERT_BATCH){
			$this->db->insert_batch($tabla, $datos);
			$res = true;
		}
		return (int)trim((string)$res,'\n');
	}

	/**
	* Método que modifica registros a todas las tablas de la bd
	* @param String $data['tabla']  hace referencia al nombre de la tabla a la que insertara el registro
	* @param Array $data['datos'] hace referencia a los datos que se 
	*        insertaran ejemplo: ['id' => 1,'nombre' => 'alfonso'];
	* @param String $data['columna'] hace referencia a la columna que tomara como referencia para actualizar
	* @param String $data['valo'] hace referencia al valor que tendra la columna de referencia 
	*/
	public function modificarRegistros($data = array()) {

		$tabla = (isset($data['tabla']))?$data['tabla']:"";
		$columna = (isset($data['columna']))?$data['columna']:"";
		$valor = (isset($data['valor']))?$data['valor']:"";
		$datos = (isset($data['datos']))?$data['datos']:array();

		$this->db->where($columna, $valor);
		return $this->db->update($tabla, $datos);
	}

	/**
	* Método que elimina registros a todas las tablas de la bd
	* @param String $data['tabla']  hace referencia al nombre de la tabla a la que insertara el registro
	* @param String $data['columna'] hace referencia a la columna que tomara como referencia para eliminar
	* @param String $data['valo'] hace referencia al valor que tendra la columna de referencia 
	*/
	public function eliminarRegistros($data = array()) {

		$tabla = (isset($data['tabla']))?$data['tabla']:"";
		$columna = (isset($data['columna']))?$data['columna']:"";
		$valor = (isset($data['valor']))?$data['valor']:"";

		$this->db->where($columna, $valor);
		return $this->db->delete($tabla);
	}
}

?>