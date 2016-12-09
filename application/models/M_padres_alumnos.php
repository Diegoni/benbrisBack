<?php 
class m_padres_alumnos extends MY_Model 
{		
	protected $_tablename	= 'padres_alumnos';
	protected $_id_table	= 'id_padre_alumno';
	protected $_order		= 'id_padre_alumno';
	protected $_relation    =  array(
        'id_padre' => array(  
            'table'     => 'padres',
            'subjet'    => 'padre'
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
} 
?>