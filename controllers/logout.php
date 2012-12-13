<?php

class LogoutController extends AppController
{

	function __construct(){
		session_start();
		unset($_SESSION['name']);
		unset($_SESSION['login']);
		unset($_SESSION['leader']);
		$this->redirect('/');
	}

}
