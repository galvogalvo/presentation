<?php
include('../libs/pusher/Pusher.php');
class SlideController extends AppController
{
	function __construct(){
		$this->setLayout(null);
		$this->key = '20431aa4f88c671606eb';
		$this->secret = 'fff03425c9a626f9a9ae';
		$this->app_id = 33511;
	}

	public function actionGo(){
		
		$result = 'false';
		if(is_numeric($_GET['id']) && $this->validAction($_GET['action'])){ //valid slide

			$slide = null;
			if(is_numeric($_GET['slide'])){
				$slide = $_GET['slide'];	
			}
			$channel = "pres_".$_GET['id'];
			$action = $_GET['action'];
			$oPusher = new Pusher($this->key, $this->secret, $this->app_id);
			$oPusher->trigger($channel, $action, $slide);

			$result = 'true';

		}
		
		$this->setVar('result', $result);
		$this->loadView($this->controllerName . '/go_action');	
	}

	private function validAction($action){
		$aActions = array('start', 'end', 'slide', 'ask');
		if(in_array($action, $aActions)){
			return true;
		}
		return false;
	}
}