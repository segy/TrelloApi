<?php
App::uses('OAuthConsumerComponent', 'OAuth.Controller/Component');

/**
 * 
 * 
 * @author segy
 * @package TrelloApi
 */
class TrelloApiComponent extends OAuthConsumerComponent {
	/**
	 * Controller
	 * 
	 * @var Controller
	 */
	protected $_controller;
	
	/**
	 * Initialize callback
	 * 
	 * @param Controller $controller
	 * @return void
	 */
	public function initialize($controller) {
		$this->setParams(Configure::read('TrelloApi'));
		$this->_controller = $controller;
	}
	
	/**
	 * Initialize model and set token
	 * 
	 * @param string $token
	 * @return void
	 */
	public function setToken($token) {
		$this->_controller->loadModel('TrelloApi.Trello');
		$this->_controller->Trello->setToken($token);
	}
}
