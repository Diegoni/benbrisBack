<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cursos extends MY_Controller 
{
	protected $_subject = 'cursos';                 // Nombre con el que se va a identificar el modulo
    protected $_model   = 'm_cursos';               // Modelo principal, la vista tabla automatica
    
    function __construct()
    {
        parent::__construct(
            $subject    = $this->_subject,
            $model      = $this->_model 
        );
        
        $this->load->model($this->_model, 'model'); // Linea obligatoria 
        $this->load->model('m_profesores');
    } 
    
    
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function abm($id = NULL)                              // Funcion para abm
    {
    	$db['profesores']    = $this->m_profesores->getRegistros(); // Carga para el select
		                           
        $db['campos']   = array(
            array('curso',    '', 'required'), // cargar un input
            array('select',   'id_profesor',  'profesor', $db['profesores']), // cargar un select
		);
        
        $this->armarAbm($id, $db);                     // Envia todo a la plantilla de la pagina
    }


/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
	Obtener cursos
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function getCursos($id = NULL)
    {
    	if($id != NULL)
    	{
    		$cursos    = $this->model->getRegistros($id, 'id_profesor'); 
			
			if($cursos)
			{
				echo json_encode($cursos);
			}
    	}                                              
    }
	
	
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
	Obtener alumnos
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function getAlumnos($id = NULL)
    {
    	if($id != NULL)
    	{
    		$alumnos    = $this->model->getAlumnos($id); 
			
			if($alumnos)
			{
				echo json_encode($alumnos);
			}
    	}                                              
    }
	

/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Guarda el mensaje
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function guardarCurso()
    {
    	$curso = $this->input->post('curso');
		$id_profesor = $this->input->post('id_profesor');
				
    	$registro = array(
			'curso'		=> $curso,
			'id_profesor'	=> $id_profesor
		);
		

    	$id_curso = $this->model->insert($registro);
    	
		echo $id_curso;			
	}
}
?>