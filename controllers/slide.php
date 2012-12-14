<?php

class SlideController extends AppController
{
	function __construct(){
		session_start();
		$this->setLayout(null);
		$this->totalYes = 0;
		$this->totalNo = 0;
		$this->votesDir = VOTES_DIR;

	}

	public function actionView(){

		$id = $this->getPresentationIdFromUrl();

		if(!$_SESSION['login'] == 1){
			$redirect = "/login/login?id=".$id;
			$this->redirect($redirect);
		}

		error_log('id: '.$id);

		$content = $this->getContent($id);

		error_log('content'.$content);

		if($_SESSION['leader'] == 1){
			$this->setLayoutVar('isLeader', 'true');
		} else {
			$this->setLayoutVar('isLeader', 'false');
		}

		$this->setLayoutVar('pageTitle', PAGE_TITLE_DEFAULT);
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
			$data = array("slide"=>$this->get['slide'], "name"=>$_SESSION['name']);
			//echo $data;
			$this->doEvent($this->get['id'], 'ask', $data);
		}
	}

	public function actionAnswerPoll(){

		if(is_numeric($this->get['id']) && is_numeric($this->get['vote'])){

			//check if we have a vote dir
			if(!is_dir($this->votesDir)){
				mkdir($this->votesDir);
			}

			//check if there's a vote file
			$path = $this->votesDir.$this->get['id'].".json";
			if(file_exists($path)){ //get existing scores
				$oVotes = json_decode(file_get_contents($path));
				$aVotes = (array) $oVotes;
			} else {
				$aVotes = array("yes"=>0, "no"=>0);
			}

			//print_r($aVotes);	

			if($this->get['vote'] == 0)
			{
				$aVotes['no'] = $aVotes['no']+1;
			}
			else if($this->get['vote'] == 1)
			{
				$aVotes['yes'] = $aVotes['yes']+1;
			}

			//print_r($aVotes);

			file_put_contents($path, json_encode($aVotes));

			$this->doEvent($this->get['id'], 'voted', $aVotes);
		}
	}

	private function getContent($id){

	$file = UPLOAD_DIR.$id.".html";
	error_log('loading file:'.$file);

		if(file_exists($file)){
			$content = file_get_contents($file);
			//explode on hr
			$aContent = explode("<hr />", $content);

			$output = "";
			foreach($aContent as $item){
				//get basic content
				$line = "<div><section><span class='logo-cd-small'></span><span class='logo faded'><i></i> R/GA</span>".$item."</section></div></div>";
			
				//check if there's an image or video (this is pretty dirty)
				if(stristr($line, "youtube.com") == true){ 
					$class = "slide video";
				} else if(stristr($line, "<img") == true){
					$class = "slide image";
				} else {
					$class = "slide";
				}

				$line = "<div class='".$class."'>".$line."</div>";
				
				//add to exisitng output
				$output .= $line;
			}
			return $output;
		}

		return $this->errorMessage();
	}

	private function errorMessage(){
		return ""; //OH NO, IT'S ALL GONE WRONG";
	}

	private function doEvent($id, $action, $data=null){
		$result = 'false';
		if(is_numeric($id) && $this->validAction($action)){ //valid slide

			$channel = "slideshow-".$id;
			$oPusher = new Pusher(PUSHER_KEY, PUSHER_SECRET, PUSHER_APP_ID);
			$oPusher->trigger($channel, $action, $data);

			$result = json_encode(array('status'=>'true'));

		}

		$this->setVar('result', $result);
		$this->loadView($this->controllerName . '/go_action');
	}

	private function validAction($action){
		$aActions = array('start', 'end', 'goTo', 'ask', 'voted');
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