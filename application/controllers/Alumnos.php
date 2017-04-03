<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Alumnos extends MY_Controller 
{
	protected $_subject = 'alumnos';
    protected $_model   = 'm_alumnos';
    
    function __construct()
    {
        parent::__construct(
            $subject    = $this->_subject,
            $model      = $this->_model 
        );
        
        $this->load->model($this->_model, 'model'); 
		$this->load->model('m_padres_alumnos');
    } 
    
    
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function abm($id = NULL)                             
    {                           
        //$db['otrom']    = $this->m_otrom->getRegistros(); 
        
        $db['campos']   = array(
            array('alumno',    '', 'required'),
            array('codigo',    '', 'required'),
            //array('select',   'id_campo',  'campo', $db['otromodelo']), // cargar un select
       	);
        
        $this->armarAbm($id, $db);                     // Envia todo a la plantilla de la pagina
    }
	
	
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function agregarAlumno($nombre = NULL)                             
    {
    	if($nombre != NULL)
    	{
    		$codigo		= '';
 			$pattern	= '1234567890abcdefghijklmnopqrstuvwxyz';
 			$max		= strlen($pattern) - 1;
			$longitud	= 6;
			
 			for( $i = 0; $i < $longitud; $i++)
 			{
 				$codigo .= $pattern{mt_rand(0,$max)};
 			} 

    		$registro = array(
				'alumno'	=> $nombre,
				'codigo'	=> $codigo,
			);
			
			$this->model->insert($registro);
			
			echo json_encode($registro);
    	}                           
    }
	
	
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function getAlumnos($id = NULL)
    {
    	if($id != NULL)
    	{
    		$alumnos    = $this->m_padres_alumnos->getRegistros($id, 'id_padre'); 
			
			if($alumnos)
			{
				echo json_encode($alumnos);
			}
    	}                                              
    }
	
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function getAlumno($id = NULL)
    {
    	if($id != NULL)
    	{
    		$alumno    = $this->model->getRegistros($id); 
			
			if($alumno)
			{
				echo json_encode($alumno);
			}
    	}                                              
    }	
	
	
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function editarAlumno()                             
    {
    	$alumno		= $this->input->post('alumno');
		$id_alumno	= $this->input->post('id_alumno');
		
		$registro = array(
			'alumno'	=> $alumno,
		);
		
		$this->model->update($registro, $id_alumno);
			
		echo 'ok';
    	                           
    }
	
}
?>