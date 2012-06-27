<?php
App::uses('DataSource', 'Model/Datasource');
App::uses('HttpSocket', 'Network/Http');
App::uses('Inflector', 'Utility');

/**
 * Datasource for accessing Trello API.
 * 
 * @author segy
 * @package TrelloApi
 */
class TrelloApiSource extends DataSource {
	/**
	 * HttpSocket object
	 * 
	 * @var HttpSocket
	 */
	protected $_http = null;
	
	/**
	 * Allowed types (singular)
	 * See https://trello.com/docs/api/index.html for the list
	 * 
	 * @var array
	 */
	protected $_allowedTypes = array(
		'action',
		'board',
		'card',
		'checklist',
		'list',
		'member',
		'notification',
		'organization',
		'token',
		'type'
	);
	
	/**
	 * Constructor
	 *
	 * @param array $config Configuration array
	 */
	public function __construct($config) {
		parent::__construct($config);
	}
	
	/**
	 * Read method for find operation
	 * 
	 * @param Model $model
	 * @param array $queryData
	 * @return array
	 */
	public function read($model, $queryData = array()) {
		// verify type
		$type = Inflector::singularize($queryData['type']);
		if (!in_array($type, $this->_allowedTypes))
			return false;
		
		// add token to request
		$queryData['conditions']['token'] = $model->getToken();
		
		return $this->_request('get', $type, $queryData['conditions']);
	}
	
	/**
	 * Call Trello API
	 * 
	 * @param string $method
	 * @param string $type
	 * @param array $conditions
	 * @return array
	 */
	protected function _request($method, $type, $conditions) {
		if (is_null($this->_http))
			$this->_http = new HttpSocket();
		
		$url = $this->_buildUrl($type, $conditions);
		
		// key and token
		$query = array('key' => Configure::read('TrelloApi.key'));
		
		// add optional arguments
		foreach ($conditions as $key => $value) {
			if ($key != 'id' && !strpos($key, '_id'))
				$query[$key] = $value;
		}

		$response = $this->_http->$method(Configure::read('TrelloApi.url').'/'.Configure::read('TrelloApi.version').'/'.$url, $query);
		
		if ($response->code != 200)
			return false;
		
		// transform result to Cake style
		$camelized = Inflector::camelize($type);
		$result = array();
		foreach (json_decode($response->body, true) as $res)
			$result[][$camelized] = $res;
		
		return $result;
	}
	
	/**
	 * Build URL for Trello API
	 * 
	 * @param string $type
	 * @param array $conditions
	 * @return string
	 */
	protected function _buildUrl($type, $conditions) {
		// type needs to be plural
		$url = Inflector::pluralize($type);
		
		// search for first type id in conditions
		foreach ($this->_allowedTypes as $t) {
			if (array_key_exists($t.'_id', $conditions)) {
				// prepend
				$url = Inflector::pluralize($t).'/'.$conditions[$t.'_id'].'/'.$url;
				break;
			}
		}
		
		// add id
		if (array_key_exists('id', $conditions))
			$url .= '/'.$conditions['id'];
		
		return $url;
	}
}
