# Trello Api Plugin for CakePHP 2.x

Wrapper for Trello API. 

### Setup

Edit _TrelloApi.key_ in _TrelloApi/Config/bootstrap.php_ 
(get one from https://trello.com/1/appKey/generate) 
 
Inicialize plugin in your application _bootstrap.php_ with bootstrap option set to true 
	CakePlugin::load(array('TrelloApi' => array('bootstrap' => true)));
 
Add to controller: 
	public $uses = array('TrelloApi.Trello');
 
*Important* 
For now you need to provide token manually by calling: 
	$this->Trello->setToken('secret token');

I plan to add oAuth authorization in the near future.

### Usage

Look for possible API calls at https://trello.com/docs/api/index.html

For example to get all boards of current member (GET /1/members/me/boards): 
	$this->Trello->find('all', array(
		'type' => 'boards',
		'conditions' => array('member_id' => 'me')
	));
 
Any optional parameters can be passed as condition: 
	$this->Trello->find('all', array(
		'type' => 'boards',
		'conditions' => array('member_id' => 'me', 'filter' => 'open')
	));