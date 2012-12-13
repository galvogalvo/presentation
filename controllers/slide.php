<?php

class SlideController extends AppController
{
	function __construct(){
		session_start();
		$this->setLayout(null);
		$this->key = '20431aa4f88c671606eb';
		$this->secret = 'fff03425c9a626f9a9ae';
		$this->app_id = 33511;
	}

	public function actionView(){

		$id = $this->getPresentationIdFromUrl();

		if(!$_SESSION['login'] == 1){
			$redirect = "/login/login?id=".$id;
			$this->redirect($redirect);
		}

		$content = $this->getContent($id);

		$this->setLayoutVar('presentationId', $id);
		$this->setVar('presentationContent', $content);
		$this->setLayout('slide');
		$this->loadView($this->controllerName . '/default');
	}

	public function actionGoTo(){
		if(is_numeric($this->get['id']) && is_numeric($this->get['slide'])){
			$this->doEvent($this->get['id'], 'goTo', $this->get['slide']);
		}
	}

	public function actionStart(){
		if(is_numeric($this->get['id'])){
			$this->doEvent($this->get['id'], 'start');
		}
	}

	public function actionEnd(){
		if(is_numeric($this->get['id'])){
			$this->doEvent($this->get['id'], 'end');
		}
	}

	public function actionAsk(){
		if(is_numeric($this->get['id']) && is_numeric($this->get['slide'])){
			$this->doEvent($this->get['id'], 'ask', $this->get['slide']);
		}
	}

	private function getContent($id){

	$file = UPLOAD_DIR.$id.".html";

		if(file_exists($file)){
			$content = file_get_contents($file);
			//explode on hr
			$aContent = explode("<hr />", $content);

			$output = "";
			foreach($aContent as $item){
				$output .= "<div class='slide'><div><section>".$item."</section></div></div>";
			}
			return $output;
		}

		return $this->errorMessage();
	}

	private function errorMessage(){
		return ""; //OH NO, IT'S ALL GONE WRONG";
	}

	private function doEvent($id, $action, $slide=null){

		$result = 'false';
		if(is_numeric($id) && $this->validAction($action)){ //valid slide

			$channel = "slideshow-".$id;
			$oPusher = new Pusher(PUSHER_KEY, PUSHER_SECRET, PUSHER_APP_ID);
			$oPusher->trigger($channel, $action, $slide);

			$result = json_encode(array('status'=>'true'));

		}

		$this->setVar('result', $result);
		$this->loadView($this->controllerName . '/go_action');
	}

	private function validAction($action){
		$aActions = array('start', 'end', 'goTo', 'ask');
		if(in_array($action, $aActions)){
			return true;
		}
		return false;
	}

	private function getPresentationIdFromUrl(){
		$aURL = explode("/", $_SERVER['REQUEST_URI']);
		$id = array_pop($aURL);
		if(is_numeric($id)){
			return $id;
		}
		return false;
	}
}