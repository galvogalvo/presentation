<?php
include('../libs/markdown/markdown.php');
class UploadController extends AppController
{

	function __construct(){
		$this->setLayout('rga');
		$this->uploadDir = APP_PATH."/uploads/";
	}

	public function actionUpload(){
		
		//do upload
		if(!empty($_FILES) && $_FILES['input']['size'] > 0){

				if ($_FILES['input']['error'] == UPLOAD_ERR_OK  && is_uploaded_file($_FILES['input']['tmp_name'])) { //checks that file is uploaded
 					$input = file_get_contents($_FILES['input']['tmp_name']); 
				}

				$markdown = Markdown(trim($input));

				$filename = $this->getNextFilename();

				file_put_contents($this->uploadDir.$filename, $markdown);

				$this->setVar('url', "http://".$_SERVER['SERVER_NAME']."/slide/view/".$filename);
				$this->setVar('pin', 1234);

				$this->loadView($this->controllerName . '/upload_result');	

		} else {
			$this->setVar('form_action', 'upload');
			$this->loadView($this->controllerName . '/upload_action');	
		}
		
		
	}

	private function getNextFilename(){

		$aIgnore = array(".","..");

		$aLatest = array();
		if ($handle = opendir($this->uploadDir)) {
		    while (false !== ($entry = readdir($handle))) {
		        if (!in_array($entry, $aIgnore)) {
		        		$aLatest[] = $entry;
		        }
		    }
		    closedir($handle);
		}

		$count = count($aLatest)+1;
		return $count;
	}


}