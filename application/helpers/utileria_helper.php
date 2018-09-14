<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('filtros'))
{
    function filtros($data)
    {	
    	$filtros = "";
        $c=0;
    	if( is_array($data['filtros'])){
    		foreach ($data['filtros'] as $key => $row) {
    			if(isset($row['columna']) && isset($row['valor'])){
                    if($row['valor'] !== ""){
                        //$and = ($c > 0  && $data['where'] == false)?"OR":"WHERE";
	    			    $and = ($c == 0 )?"AND":"OR";
                        if(isset($data['and'])){
                            $and = "AND";
                        }
	    			    $filtros .= "  $and  ".$row['columna']." LIKE '".$row['valor']."%'   ";
                        $c++;
                    }
	    		}
    		}
    	}
    	return $filtros;
       
    }   
}

if ( ! function_exists('arrayFiltros'))
{
    function arrayFiltros($text)
    {   
        $filtros = [];
        $arr1 = explode(",",$text);
        for ($i=0; $i <count($arr1) ; $i++) { 
            $arr2 = explode("=",$arr1[$i]);
            if( $arr2[1] != ""){
                if(is_numeric($arr2[1])){
                    if ($arr2[1] > 0) {
                         $filtros[] = ['columna' => $arr2[0], 'valor' => $arr2[1]];
                    }
                }else{
                     $filtros[] = ['columna' => $arr2[0], 'valor' => $arr2[1]];
                }
               
            }
        }
        
        return $filtros;
       
    }   
}


if ( ! function_exists('limitQuery'))
{
    function limitQuery($pagina)
    {	
        if($pagina > 0){
        	$l1 = ($pagina == 1)?0:$pagina * 10 - 10 ;
        	$l2 = 10; 
        	$limit = " LIMIT $l1,$l2  ";
        }else{
            $limit = "";
        }
        return $limit;
       
    }   
}

if ( ! function_exists('validarPaginaRegistros'))
{
    function validarPaginaRegistros($pagina, $registros, $count)
    {	
        $pagina = ($pagina > 0 )?$pagina:1;
    	if($registros != 10 || $registros != 50 || $registros != 100 ){
    		$registros = 10;
    	}
    	$limite_paginas = $count / $registros;
    	$limite_paginas = ceil($limite_paginas);
        $limite_paginas = ($limite_paginas > 0)?$limite_paginas:1;
    	$pagina = ($pagina > $limite_paginas)?$limite_paginas:$pagina;    	
    	return [
    			'registros' => $registros,
    			'pagina' 	=> $pagina,
                'limite_paginas' => $limite_paginas,
    			];
       
    }   
}





