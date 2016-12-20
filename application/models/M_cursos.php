<?php 
class m_cursos extends MY_Model 
{		
	protected $_tablename	= 'cursos';
	protected $_id_table	= 'id_curso';
	protected $_order		= 'id_curso';
	protected $_relation    =  array(
        'id_profesor' => array(  
            'table'     => 'profesores',
            'subjet'    => 'profesor'
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
            
       Comprueba si usuario y pass coinciden
  
----------------------------------------------------------------------------------- 
---------------------------------------------------------------------------------*/ 
		
	
	function getAlumnos($id)
	{
		$sql = 
		"SELECT 
			alumnos.id_alumno, 
			alumnos.alumno 
		FROM 
			cursos_alumnos 
		INNER JOIN 
			alumnos ON(cursos_alumnos.id_alumno = alumnos.id_alumno)
		WHERE
			cursos_alumnos.id_curso = '$id'
		ORDER BY
			alumnos.alumno";
		
		return $this->getQuery($sql);
	}
	
	} 
?>