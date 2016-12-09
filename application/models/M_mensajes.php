<?php 
class m_mensajes extends MY_Model 
{		
	protected $_tablename	= 'mensajes';
	protected $_id_table	= 'id_mensaje';
	protected $_order		= 'id_mensaje';
	protected $_relation    =  array(
        'id_profesor' => array(  
            'table'     => 'profesores',
            'subjet'    => 'profesor'
        ),
        'id_curso' => array(  
            'table'     => 'cursos',
            'subjet'    => 'curso'
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