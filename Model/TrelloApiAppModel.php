<?php
App::uses('AppModel', 'Model');

/**
 * AppModel for plugin
 * 
 * @author segy
 * @package TrelloApi
 */
class TrelloApiAppModel extends AppModel {
	/**
	 * Not using a database
	 * 
	 * @var mixed
	 */
	public $useTable = false;
	
	/**
	 * Token used in API calls
	 * 
	 * @var string
	 */
	protected $_token;
	
	/**
	 * Set token
	 * 
	 * @param string $token
	 * @return void
	 */
	public function setToken($token) {
		$this->_token = $token;
	}
	
	/**
	 * Get token
	 * 
	 * @return string
	 */
	public function getToken() {
		return $this->_token;
	}
	
	/**
	 * Replace model name in fields by fake key.
	 * Used in find('list').
	 * 
	 * @param array $fields fields passed to find
	 * @param string $key fake key returned by datasource
	 * @return array modified fields
	 */
	protected function _replaceFieldsKey($fields, $key) {
		// fields not set
		if (!$fields)
			$fields = array('id', 'name');
		// only one field
		elseif (count($fields) == 1)
			array_unshift($fields, 'id');
		
		foreach ($fields as $k => $v) {
			$v = str_replace(get_class($this).'.', $key.'.', $v);
			
			if (strpos($v, $key.'.') === false)
				$v = $key.'.'.$v;
			
			$fields[$k] = $v;
		}
		return $fields;
	}
}
