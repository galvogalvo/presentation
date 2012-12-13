<?php

class LoginController extends AppController
{
	function __construct(){
		$this->setLayout('rga');
	}

	public function actionLogin(){

		if(!empty($this->post['id']) && is_numeric($this->post['id'])){
			$id = $this->post['id'];
			$_SESSION['presentation_id'] = $_POST['id'];
			$url = "/view/".$id."/watch";
			$this->redirect($url);
		} else if(!is_numeric($this->post['id'])){
			$this->setVar('error', 'Presentation not found');
		}

		$this->setVar('form_action', 'login');
		$this->loadView($this->controllerName . '/login_action');	


	}

}
