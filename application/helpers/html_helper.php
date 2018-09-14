<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('generarTabla'))
{
    function generarTabla($data)
    {	
        $view = ($data['view'] == NULL)?TRUE:FALSE;
        $update = ($data['update'] == NULL)?TRUE:FALSE;
        $delete = ($data['delete'] == NULL)?TRUE:FALSE;
        $add = ($data['add'] == NULL)?TRUE:FALSE;

        $tabla = "";
       
        $tabla .= '<table class="table table-bordered" style="font-size:14px;">
                    <tr>';
        //debug($data['columnas']);
        foreach ($data['columnas'] as $key => $columna) {
            $tabla .= '
                <th>'.$columna['label'].'</th>
            ';
        }
        $tabla .= '
                <th>Acciones</th>
            ';
        $tabla .= '</tr>';
        $tabla .= '<tr>';
            $hay_select = FALSE;
            foreach ($data['columnas'] as $key => $columna) {
                $tiene_filtro = (isset($columna['filtro']))?FALSE:TRUE;
                if($tiene_filtro == TRUE){
                    if(isset($columna['tipo']) && $columna['tipo'] == 'select'){
                        $datos = $columna['valor_select'];
                        $nombre = $columna['name'];
                        $tabla .= '<th>'.generarInput([
                            'tipo' => 'select',
                            'id' => "filtros[".$nombre."]",
                            'label' => '',
                            'registros' => $datos,
                            'solo_select' => true,
                            'valor' => (isset($columna['valor']))?$columna['valor']:"",
                        ]).'</th>';
                        $hay_select = TRUE;
                    }else{
                        $br = ($hay_select == TRUE)?"<br>":"";
                        $name = (isset($columna['name']))?$columna['name']:$columna['columna'];
                        $tabla .= '<th>'.$br.'
                        <div class="form-line">
                            <input type="text" name="filtros['.$name.']" value="'.$columna['valor'].'" class="form-control" >
                        </div>
                        </th>';
                    }
                }else{
                    $tabla .= "<th></th>";
                }
            }
        $tabla .= '<input type="submit" style="display: none" />';
        $tabla .= '<th>';
        if($add){
            $tabla .= "<div class='text-left'>";
            $tabla .= '<a href="'.getUrlControlador($data['controlador'],'alta').'" class="btn btn-success ">
                          <span class="glyphicon glyphicon-plus"></span> Agregar 
                        </a>';
            $tabla .= "</div>";
        }
        $tabla .= '</th>';
        $tabla .= '</tr>';

        foreach ($data['datos'] as $key => $row) {
            //debug($row);
            $row = (array)$row;
            $tabla .= '<tr>';
            foreach ($data['columnas'] as $ind => $colum) {
                if(isset($row[$colum['columna']])){
                    $tabla .= '<td>'.$row[$colum['columna']].'</td>';
                }else{
                    $tabla .= '<td>No definido</td>';
                }
            }
            $tabla .= 
            '<td>';
                if($view == TRUE){
                    $tabla .= 
                    '<a href="'.getUrlControlador($data['controlador'],'detalle/'.$row[$data['campo_id']]).'">
                        <span class="glyphicon glyphicon-eye-open"></span>
                    </a>';
                }
                if($update == TRUE){
                    $tabla .= 
                    '<a href="'.getUrlControlador($data['controlador'],'alta/'.$row[$data['campo_id']]).'">
                        <span class="glyphicon glyphicon-pencil"></span>
                    </a>';
                }
                if($delete == TRUE){
                    $tabla .= 
                    '<a onclick="eliminar(\''.getUrlControlador($data['controlador'],'eliminar/'.$row[$data['campo_id']]).'\');">
                        <span class="glyphicon glyphicon-trash"></span>
                    </a>';
                }
            $tabla .= '</td></tr>';
        }
        $tabla .= '</table>';
        return $tabla;
       
    }   
}


if ( ! function_exists('generarPaginador'))
{
    function generarPaginador($numero_pagina,$total_paginas,$url)
    {   
        $paginador = "";
        $paginador .= 
        '<ul class="pagination pagination-sm no-margin pull-right">';
        if($numero_pagina == 1 && $numero_pagina < 5){
            $paginador .= '<li class="disabled"><a href="#">&laquo;</a></li>';
        }else{
            $pagina_anterior = $numero_pagina -1;
            $paginador .= '<li><a href="'.$url.'?page='.$pagina_anterior.'">&laquo;</a></li>';
        }
        if($numero_pagina > 5){
            $bloques_paginas = $numero_pagina / 5;
            $bloques_paginas = ceil($bloques_paginas);
            $inicio = $bloques_paginas * 5 - 4;
            $final = $bloques_paginas * 5;

            for ($i=$inicio;$i<$final;$i++) { 
                $paginador .= 
                    ($i == $numero_pagina)?'<li class="active"><a  href="'.$url.'?page='.$i.'">'.$i.'</a></li>':
                                           '<li><a href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
            }
        }else{
            for ($i=1;$i<=$total_paginas;$i++) { 
                $paginador .= 
                    ($i == $numero_pagina)?'<li class="active"><a  href="'.$url.'?page='.$i.'">'.$i.'</a></li>':
                                           '<li><a href="'.$url.'?page='.$i.'">'.$i.'</a></li>';
            }
        }

        if($numero_pagina ==$total_paginas | $numero_pagina == ($total_paginas - 5)){
            $paginador .= '<li class="disabled"><a href="#">&raquo;</a></li>';
        }else{
            $pagina_siguiente = $numero_pagina + 1;
            $paginador .= '<li><a href="'.$url.'?page='.$pagina_siguiente.'">&raquo;</a></li>';
        }
              
        $paginador .= '</ul>'; 
        return $paginador;
    }   
}

if ( ! function_exists('generarInput'))
{
    function generarInput($data)
    {   
        $data['valor'] = (isset($data['valor']))?$data['valor']:"";
        $validacion = (isset($data['validacion']))?$data['validacion']:"";
        $required = (isset($data['required']))?$data['required']:"";
        $input = "";
        if($data['tipo'] == 'textarea'){
            $input = 
            '<label>'.$data['label'].'</label>
            <textarea class="form-control" id="'.$data['id'].'" name="'.$data['id'].'" '.$validacion.'  rows="3" placeholder="'.$data['label'].'">'.$data['valor'].'</textarea>';

        }else if($data['tipo'] == 'select'){
            $registros = (isset($data['registros']))?$data['registros']:[];
            $col_valor = (isset($data['col_valor']))?$data['col_valor']:'id';
            $col_text = (isset($data['col_text']))?$data['col_text']:'nombre';
            $input = 
            '<div class="">
                <label>'.$data['label'].'</label>
                <select id="'.$data['id'].'" name="'.$data['id'].'" class="form-control show-tick">
                    <option value="0">Selecciona una opción</option>';
                    for ($i=0; $i <count($registros); $i++) { 
                        $row = (array)$registros[$i];
                        if($data['valor'] == $row[$col_valor]){
                            $input .= '<option value="'.$row[$col_valor].'" selected>'.$row[$col_text].'</option>';
                        }else{
                            $input .= '<option value="'.$row[$col_valor].'">'.$row[$col_text].'</option>';
                        }
                    }
            $input.='</select>
            </div>';
            if(isset($data['solo_select'])){
                return $input;
            }

        }else if($data['tipo'] == 'buscador'){
            $icono_label = (isset($data['icono']))?'<span class="input-group-addon"><i class="glyphicon glyphicon-'.$data['icono'].'"></i></span>': '<label>'.$data['label'].'</label>';

            $input = 
            $icono_label.
            '<input type="text" id="'.$data['id'].'" name="'.$data['id'].'" class="form-control" placeholder="'.$data['label'].'" '.$validacion.' value="'.$data['valor'].'" autocomplete="off" >
            <div id="result"></div>';
        }else if($data['tipo'] == 'hidden'){
            $input = 
            '<input type="'.$data['tipo'].'" id="'.$data['id'].'" name="'.$data['id'].'"  
              value="'.$data['valor'].'" >
             ';
             return $input;
        }
        else{
            $readonly = (isset($data['readonly']))?"readonly":"";
            $icono_label = (isset($data['icono']))?'<span class="input-group-addon"><i class="glyphicon glyphicon-'.$data['icono'].'"></i></span>': "";

            $input = 
            $icono_label.
            '<input type="'.$data['tipo'].'" id="'.$data['id'].'" name="'.$data['id'].'" class="form-control" 
             '.$validacion.' value="'.$data['valor'].'" '.$readonly.' >
            ';
            $input .= '<label class="form-label">'.$data['label'].'</label>';
        }
         $data['tamaño'] = (isset($data['tamaño']))?$data['tamaño']:"12";
        $input = 
       '<div class="col-sm-'.$data['tamaño'].'">
            <div class="form-group form-float">
                <div class="form-line">
                    '.$input.'   
                </div>
            </div>
        </div>
        <br>
        ';
        return $input;
    }   
}

if ( ! function_exists('generarBoton'))
{
    function generarBoton($form)
    {   
       
        $input = 
       '<div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-2">
                    <button onclick="$(\'#'.$form.'\').submit();" type="submit" id="boton" class="btn btn-success">
                      <span class=" glyphicon glyphicon-chevron-right"></span> Enviar
                    </button>
            </div>
            <div class="col-md-4"></div>
        </div>
        <br>';
        return $input;
    }   
}

if ( ! function_exists('generarLabel'))
{
    function generarLabel($texto)
    {   
        $label = 
       '<div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-4">
                <div class="input-group">
                    '.$texto.'   
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>
        <br>';
        return $label;
    }   
}


if ( ! function_exists('generarGrid'))
{
    function generarGrid($data)
    {       
        $view = (isset($data['view']))?$data['view']:NULL;
        $update = (isset($data['update']))?$data['update']:NULL;
        $delete = (isset($data['delete']))?$data['delete']:NULL;
        $add = (isset($data['add']))?$data['add']:NULL;

        $url_paginador = $data['url_paginador'];
        $datos['servicio'] = $data['servicio']."?pagina=".$data['pagina'];
        $datos['metodo'] = $data['metodo'];
        $filtros = (!is_null($data['filtros']))?arrayFiltros(http_build_query($data['filtros'], '', ', ')):"";
        $datos['data'] = [
                            'pagina' => $data['pagina'],
                            'filtros' => $filtros,
                        ];
        $respuesta = consumir($datos);
        //debug($respuesta);
        $datos = json_decode($respuesta['body']);
        //debug($datos);
        $paginador = generarPaginador($datos->pagina,$datos->limite_paginas,$url_paginador);
        //debug($datos);
        $columnas = $data['columnas'];
        
        $tabla = generarTabla([
            'columnas'   => $columnas,
            'datos'      => $datos->registros ,
            'controlador'=> $data['controlador'],
            'campo_id'   => $data['campo_id'],
            'view'       => $view,
            'update'     => $update,
            'delete'     => $delete,
            'add'        => $add,
        ]);
        $eliminado = (!is_null($data['eliminado']))?1:null;
        $data = [
            $data['active'] => 'active',
            'grid' => $tabla,
            'paginador' => $paginador,
            'eliminado' => $eliminado,
        ];
        return $data;
    }   
}

if ( ! function_exists('generarAlta'))
{
    function generarAlta($data)
    {   
        $error = false;
        $id = $data['id'];
        if ($data['request_method'] == METODO_POST){
            $post = $data['post'];
            $id = $post['id'];
            $servicio = ( $id > 0)?$data['servicio']."/".$id:$data['servicio'];
            $metodo = ( $id > 0)?METODO_PUT:METODO_POST;
            $datos['servicio'] = $servicio;
            $datos['metodo'] = $metodo;
            $datos['data'] = $post; 
            $respuesta = consumir($datos);
            if ($respuesta['code'] == CODE_200) {
                $id = trim($respuesta['body']);
                redirect($data['redirect'].$id);
            }else{
                $post = (Object) $post;
                $datos = [
                    $data['active'] => 'active',
                    $data['variable'] => $post,
                    'error' => "Ocurrió un error en el servidor"
                ];
            }
        }else if($id > 0 ){
            $datos['servicio'] = $data['servicio']."/".$id;
            $datos['metodo'] = METODO_GET;
            $respuesta = consumir($datos);
            if ($respuesta['code'] == CODE_200) {
                $datos = json_decode($respuesta['body']);
                $datos = $datos->registros[0];
                $datos = [
                    $data['active'] => 'active',
                    $data['variable'] => $datos
                ];
            }else{
                $error = true;
            }
        }else{
            $datos = [
                    $data['active'] => 'active',
                ];
        }
        $datos['error'] = $error;
        return $datos;
    }   
}


