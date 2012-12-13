<?php
include('../libs/markdown/markdown.php');
class UploadController extends AppController
{

	function __construct(){
		$this->setLayout(null);
	}

	public function actionUpload(){
		
		//do upload
		if(!empty($_FILES) && $_FILES['input']['size'] > 0){

				if ($_FILES['input']['error'] == UPLOAD_ERR_OK  && is_uploaded_file($_FILES['input']['tmp_name'])) { //checks that file is uploaded
 					$input = file_get_contents($_FILES['input']['tmp_name']); 
				}



				$markdown = Markdown(trim($input));
				$this->setVar('output', $markdown);

		} else {

			$this->setVar('form_action', 'upload');

		}
		
		$this->loadView($this->controllerName . '/upload_action');	
	}


}