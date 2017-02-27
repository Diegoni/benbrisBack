<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends MY_Controller 
{
	protected $_subject = 'usuarios';
    protected $_model   = 'm_usuarios';
    
    function __construct()
    {
        parent::__construct(
            $subject    = $this->_subject,
            $model      = $this->_model 
        );
        
        $this->load->model($this->_model, 'model');  
        $this->load->model('m_usuarios_perfiles');
		$this->load->model('m_padres');
		$this->load->model('m_profesores');
    } 
    
    
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function abm($id = NULL)                             
    {
        $db['perfiles']    = $this->m_usuarios_perfiles->getRegistros();
                                   
        $db['campos']   = array(
            array('usuario',  'onlyChar', 'required'),
            array('nombre',   'onlyChar', ''),
            array('apellido', 'onlyChar', ''), 
            array('select',   'id_perfil',  'perfil', $db['perfiles'], 'required'),  
        );
        
        $this->armarAbm($id, $db);                     // Envia todo a la plantilla de la pagina
    }
	
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Login 
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function login()                             
    {
    	$user = $this->input->post('usu');
		$pass = md5($this->input->post('pass'));
		$perfil = $this->input->post('perfil');
		
		log_message('DEBUG', '--------------------------- Login Usuario');
		log_message('DEBUG', 'Perfil '.$perfil);
		
		if($perfil == 'Padre')
		{
    		$padre = $this->m_padres->login($user, $pass);
	    	if($padre)
	    	{
	    		log_message('DEBUG', 'Login padre '.$user);
	    		echo 1;
	    	}else
	    	{
	    		log_message('DEBUG', 'No existe padre '.$user);
	    		echo false;	
			}
		}else
		{
    		$profesor = $this->m_profesores->login($user, $pass);
			if($profesor)
			{
				log_message('DEBUG', 'Login profesor '.$user);
				echo 2;
			}else
			{
				log_message('DEBUG', 'No existe profesor '.$user);
				echo false;
			}
    	}
	}


/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Login 
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function registrar()                             
    {
    	$user = $this->input->post('user');
		$pass = md5($this->input->post('pass'));
		$perfil = $this->input->post('perfil');
		
		log_message('DEBUG', '--------------------------- Registro de Usuario');
		log_message('DEBUG', 'USUARIO '.$user);
		log_message('DEBUG', 'PERFIL '.$perfil);
		
		if($perfil == 'Padre')
		{
			$existe = $this->m_padres->getRegistros($user, 'padre');
			
			if($existe)
			{
				log_message('DEBUG', 'PADRE YA EXISTE');
				echo false;
			}else
			{
				$registro = array(
					'padre' => $user,
					'pass'	=> $pass,
				);
				
				$id_padre = $this->m_padres->insert($registro);
				
				log_message('DEBUG', 'ID PADRE NUEVO '.$id_padre);
				
				echo $id_padre;
			}
		}else
		{
			$existe = $this->m_profesores->getRegistros($user, 'profesor');
			
			if($existe)
			{
				log_message('DEBUG', 'PROFESOR YA EXISTE');
				echo false;
			}else
			{
				$registro = array(
					'profesor' => $user,
					'pass'	=> $pass,
				);
				
				$id_profesor = $this->m_profesores->insert($registro);
				
				log_message('DEBUG', 'ID PROFESOR NUEVO '.$id_profesor);
				
				echo $id_profesor;
			}
		}
    	
    	
	}
}
?>