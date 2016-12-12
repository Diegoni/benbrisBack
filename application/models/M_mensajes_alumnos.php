<?php 
class m_mensajes_alumnos extends MY_Model 
{		
	protected $_tablename	= 'mensajes_alumnos';
	protected $_id_table	= 'id_mensaje_alumno';
	protected $_order		= 'id_mensaje_alumno';
	protected $_relation    =  array(
        'id_mensaje' => array(  
            'table'     => 'mensajes',
            'subjet'    => 'mensaje'
        ),
        'id_alumno' => array(  
            'table'     => 'alumnos',
            'subjet'    => 'alumno'
        ),
    );
		
	function __construct()
	{
		parent::__construct(
			$tablename		= $this->_tablename, 
			$id_table		= $this->_id_table, 
			$order			= $this->_order,
			$relation		= $this->_relation
		);
	}
	
	
/*--------------------------------------------------------------------------------- 
-----------------------------------------------------------------------------------  
            
       Ejemplo de abm
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/   
    
    
    function getMensajes($id_alumnos)
    {
    	$sql = "
    	SELECT
    		mensajes.id_mensaje,
    		mensajes.titulo,
    		mensajes.mensaje,
    		alumnos.alumno
    	FROM
    		mensajes_alumnos
    	INNER JOIN 
    		mensajes ON(mensajes_alumnos.id_mensaje = mensajes.id_mensaje)
    	INNER JOIN 
    		alumnos ON(mensajes_alumnos.id_alumno = alumnos.id_alumno)
    	WHERE 
    	";
		
		foreach ($id_alumnos as $id_alumno) 
		{
			$sql .= " mensajes_alumnos.id_alumno = '".$id_alumno."' ";
			$sql .= " OR ";
		}
		
		$sql = substr($sql, 0, -4);
		return $this->getQuery($sql);
    } 
} 
?>