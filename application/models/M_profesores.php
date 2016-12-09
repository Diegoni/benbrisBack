<?php 
class m_profesores extends MY_Model 
{		
	protected $_tablename	= 'profesores';
	protected $_id_table	= 'id_profesor';
	protected $_order		= 'id_profesor';
	protected $_relation    = '';
		
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