<?php 
class m_alumnos extends MY_Model 
{		
	protected $_tablename	= 'alumnos';
	protected $_id_table	= 'id_alumno';
	protected $_order		= 'id_alumno';
	protected $_relation    =  array(
        'id_padre' => array(  
            'table'     => 'padres',
            'subjet'    => 'padre'
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