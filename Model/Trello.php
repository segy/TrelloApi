<?php
App::uses('TrelloApiAppModel', 'TrelloApi.Model');
App::uses('Inflector', 'Utility');

/**
 * Trello API model.
 * 
 * @author segy
 * @package TrelloApi
 */
class Trello extends TrelloApiAppModel {
	/**
	 * DB config
	 * 
	 * @var string
	 */
	public $useDbConfig = 'Trello';
	
	/*
	 * Create related DataSource config on the fly
	 * 
	 * @param mixed $id
	 * @param string $table
 	 * @param string $ds
	 */
	public function __construct($id = false, $table = NULL, $ds = NULL) {
		ConnectionManager::create('Trello', array('datasource' => 'TrelloApi.TrelloApiSource'));
		parent::__construct($id, $table, $ds);
	}
	
	/*
	 * Hack for displaying data correctly when using 'list'
	 * 
	 * @param string $type
 	 * @param array $query
	 * @return array
	 */
	public function find($type = 'first', $query = array()) {
		// singularize type
		$query['type'] = Inflector::singularize($query['type']);
		
		if ($type == 'list')
			$query['fields'] = $this->_replaceFieldsKey(@$query['fields'], Inflector::camelize($query['type']));
		
		return parent::find($type, $query);
	}
}
