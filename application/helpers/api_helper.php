<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('getUrl'))
{
    function getUrl()
    {
        return base_url();
    }   
}

if ( ! function_exists('getToken'))
{
    function getToken()
    {
        mt_srand(time());
        mt_srand(time()*10000000);
        $c=mt_rand(0,9999999999);
        $f=mt_rand(0,999);
        $d=$c.$f;
        $d = sha1($d);
        return $d;
    }   
}


if ( ! function_exists('getUrlServicio'))
{
    function getUrlServicio($servicio)
    {
        return "http://18.234.212.86:5123/push/".$servicio;
    }   
}

if ( ! function_exists('getUrlControlador'))
{
    function getUrlControlador($controlador,$accion)
    {
        return base_url()."index.php/".$controlador."/".$accion;
    }   
}

if ( ! function_exists('debug1'))
{
    function debug1($data)
    {
        highlight_string("<?php\n\$data =\n" . var_export($data, true) . ";\n?>");die();
    }   
}

if ( ! function_exists('debug'))
{
    function debug($data)
    {
        print_r($data);die();
    }   
}




if ( ! function_exists('consumir'))
{
    function consumir($datos)
        {

            $url = getUrlServicio($datos['servicio']);
            $metodo = $datos['metodo'];
            $data = (isset($datos['data']))?$datos['data']:[];
            $CI = & get_instance();  //get instance, access the CI superobject
            $token = $CI->session->userdata('token');
            $ch = curl_init(); 
            $authorization = "Authorization: ".$token; 
            curl_setopt($ch, CURLOPT_HTTPHEADER, array($authorization )); 
            curl_setopt($ch, CURLOPT_URL,$url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$metodo);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            $output = curl_exec($ch);
            $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);
            $body = $output;
            if ($http_status != 200) {
                //redirect('/errorServer/index');
            }
            return ['body' => $body, 'code' => $http_status];
            
        }
}



if ( ! function_exists('aleatorio'))
{
    function aleatorio()
        {

           $aleatorio =  (int) date('YmdHi').rand(10,100).rand(10,100);
           return $aleatorio;
            
        }
}