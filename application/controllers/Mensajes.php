<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mensajes extends MY_Controller 
{
	protected $_subject = 'mensajes';
    protected $_model   = 'm_mensajes'; 
	
    function __construct()
    {
        parent::__construct(
            $subject    = $this->_subject,
            $model      = $this->_model 
        );
        
        $this->load->model($this->_model, 'model'); 
        $this->load->model('m_cursos'); 
		$this->load->model('m_profesores'); 
		$this->load->model('m_padres_alumnos'); 
		$this->load->model('m_mensajes_alumnos'); 
    } 
    
    
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function abm($id = NULL)
    {                           
        $db['cursos']    = $this->m_cursos->getRegistros(); 
		$db['profesores']    = $this->m_profesores->getRegistros(); 
        
        $db['campos']   = array(
            array('titulo',    '', ''), 
            array('mensaje',    '', ''), 
            array('select',   'id_curso',  'curso', $db['cursos']), 
            array('select',   'id_profesor',  'profesor', $db['profesores']), 
        );
        
        $this->armarAbm($id, $db);                     // Envia todo a la plantilla de la pagina
    }
	
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function getMensajes($id = NULL)
    {
    	if($id != NULL)
    	{
    		$alumnos    = $this->m_padres_alumnos->getRegistros($id, 'id_padre'); 
			
			if($alumnos)
			{
				$id_alumnos = array();
				
				foreach ($alumnos as $alumno) 
				{
					$id_alumnos[] = $alumno->id_alumno;
				}
				
				$mensajes = $this->m_mensajes_alumnos->getMensajes($id_alumnos);
				
				if($mensajes)
				{
					echo json_encode($mensajes);
				}
			}
    	}                                              
    }


/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function getMensaje($id = NULL)
    {
    	if($id != NULL)
    	{
    		$mensaje = $this->model->getRegistros($id);
			
			if($mensaje)
			{
				echo json_encode($mensaje);
			}
    	}
	}
	

/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function setAlumnos()
    {
    	$id_curso = $this->input->post('id_curso');
		$id_profesor = $this->input->post('id_profesor');
				
    	$registro = array(
			'mensaje'		=> "",
			'id_curso'		=> $id_curso,
			'id_profesor'	=> $id_profesor
		);
		
    	$id_mensaje = $this->model->insert($registro);
		
    	$alumnos = explode(",", $this->input->post('alumnos'));
		
		foreach ($alumnos as $alumno) 
		{
			if($alumno != 0)
			{
				$registro = array(
					'id_alumno'		=> $alumno,
					'id_mensaje'	=> $id_mensaje,
				);
				
				$this->m_mensajes_alumnos->insert($registro);	
			}
		}
		
    	
		echo $id_mensaje;			
	}
	
	
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Guarda el mensaje
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function guardarMensaje()
    {
    	$id_mensaje = $this->input->post('id_mensaje');
		$titulo = $this->input->post('titulo');
		$mensaje = $this->input->post('mensaje');
				
    	$registro = array(
			'mensaje'		=> $mensaje,
			'titulo'		=> $titulo,
		);
		

    	$id_mensaje = $this->model->update($registro, $id_mensaje);
    	
		echo 'mensaje';			
	}
}
?>