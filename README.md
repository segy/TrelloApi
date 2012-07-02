# Trello Api Plugin for CakePHP 2.x

Wrapper for Trello API. 

### Setup

Get and install OAuth plugin from https://github.com/segy/OAuth  

Edit _TrelloApi.key_ and _TrelloApi.secret_in _TrelloApi/Config/bootstrap.php_  
(get one from https://trello.com/1/appKey/generate)  
 
Inicialize plugin in your application _bootstrap.php_ with bootstrap option set to true  

	CakePlugin::load(array('TrelloApi' => array('bootstrap' => true)));
 
In controller:  

	public $components = array('TrelloApi.TrelloApi');
	
	// in any of your methods
	public function trello() {
		// save token to database, session, etc.
		if ($this->TrelloApi->getAccessToken())
			$this->Session->write('Trello.accessToken', $this->TrelloApi->getAccessToken());
		
		// if we have token
		if ($token = $this->Session->read('Trello.accessToken')) {
			// set token - automatically initializes Trello model
			$this->TrelloApi->setToken($token);
			
			// use Trello model to get data
			$data = $this->Trello->find('all', array(
				'type' => 'cards',
				'conditions' => array('member_id' => 'me', 'filter' => 'open')
			));
		}
		// if not, provide authorization link
		else {
			$this->set('link', $this->TrelloApi->getAuthorizationLink());
		}
	}
 
### Usage

Look for possible API calls at https://trello.com/docs/api/index.html  

For example to get all boards of current member (_GET /1/members/me/boards_):  

	$this->Trello->find('all', array(
		'type' => 'boards',
		'conditions' => array('member_id' => 'me')
	));
 
Any optional parameters can be passed as condition:  

	$this->Trello->find('all', array(
		'type' => 'cards',
		'conditions' => array('member_id' => 'me', 'filter' => 'open')
	));
 
Example for getting current member:  

	$this->Trello->find('all', array(
		'type' => 'member',
		'conditions' => array('id' => 'me')
	));
	