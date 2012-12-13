<?php

class PageController extends AppController
{
	public function actionView($pageName = 'home')
	{
		if (strpos($pageName, '../') !== false)
		{
			throw new Lvc_Exception('File Not Found: ' . $sourceFile);
		}
		$this->setLayout('rga');
		$this->loadView('page/home');
	}
}

?>