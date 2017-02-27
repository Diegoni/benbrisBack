<?php 
class m_padres extends MY_Model 
{		
	protected $_tablename	= 'padres';
	protected $_id_table	= 'id_padre';
	protected $_order		= 'id_padre';
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
	
	
	function login($user, $pass)
	{
		$sql = "
		SELECT * FROM $this->_tablename WHERE padre LIKE '".$user."' AND pass = '".$pass."'
		";
		
		return $this->getQuery($sql);
	}
} 
?>