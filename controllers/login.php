<?php

class LoginController extends AppController
{
	function __construct(){
		session_start();
		$this->setLayout('rga');
		$this->pin = 1234;
		$this->leaderPin = 5678;
	}

	public function actionLogin(){

		//success
		if(!empty($this->post['id']) && is_numeric($this->post['id']) && ($this->post['pin'] == $this->pin || $this->post['pin'] == $this->leaderPin)){

			$id = $this->post['id'];
			$_SESSION['login'] = 1;
			$_SESSION['name'] = $this->post['name'];
			if($this->post['pin'] == $this->leaderPin){
				$_SESSION['leader'] = 1;
			} else {
				$_SESSION['leader'] = 0;
			}
			$url = "/slide/view/".$id;

			//send success to sockets
			$channel = "slideshow-".$id;
			$oPusher = new Pusher(PUSHER_KEY, PUSHER_SECRET, PUSHER_APP_ID);
			$oPusher->trigger($channel, 'join', $this->post['name']);

			$this->redirect($url);
		
		//error
		} else if(!empty($this->post['id']) && !is_numeric($this->post['id'])){
			$this->setVar('error', 'Pin error');
		} 

		//show form
		$this->setVar('form_action', 'login');
		$this->setVar('id', $this->get['id']);
		$this->loadView($this->controllerName . '/login_action');	


	}

}
