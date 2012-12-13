<?php
include('../libs/markdown/markdown.php');
include('../libs/bitly/bitly.php');
class UploadController extends AppController
{

	function __construct(){
		$this->setLayout('rga');
		$this->uploadDir = UPLOAD_DIR;
	}

	public function actionUpload(){
		
		//do upload
		if(!empty($_FILES) && $_FILES['input']['size'] > 0){

				if ($_FILES['input']['error'] == UPLOAD_ERR_OK  && is_uploaded_file($_FILES['input']['tmp_name'])) { //checks that file is uploaded
 					$input = file_get_contents($_FILES['input']['tmp_name']); 
				}

				$markdown = Markdown(trim($input));

				$filename = $this->getNextFilename();

				$writePath = $this->uploadDir.$filename.".html";
				
				if(!is_dir($this->uploadDir)){
					error_log('make upload dir');
					mkdir($this->uploadDir);
				}
				error_log('write path: '.$writePath);

				$result = file_put_contents($writePath, $markdown);

				error_log('---result '.$result);

				$url = "http://".$_SERVER['SERVER_NAME']."/slide/view/".$filename;
				$aShortUrl = bitly_v3_shorten($url, 'j.mp');
				$this->setVar('url', $url);
				$this->setVar('shortUrl', $aShortUrl['url']);
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
		error_log('files'.print_r($aLatest, 1));
		$count = count($aLatest)+1;
		return $count ;
	}


}