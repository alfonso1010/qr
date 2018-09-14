<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('validarUsuario'))
{
    function validarUsuario($session)
    {	
    	//debug($session);
        if (isset($session) && isset($session['id']) && isset($session['token']) ) { 
        	return true; 
        } else { 
        	return false; 
        }
    }   
}

if ( ! function_exists('validarAdmin'))
{
    function validarAdmin($session)
    {	
    	//debug($session);
        if (isset($session) && isset($session['id']) && isset($session['token']) && isset($session['roles_id'])) {if($session['roles_id'] == 1){
        		return true;
        	}else{
        		return false; 
        	}
        } else { 
        	return false; 
        }
    }   
}



