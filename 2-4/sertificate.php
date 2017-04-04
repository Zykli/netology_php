<?php
session_start();
require_once 'functions.php';
if(!isLogged()) {
	header('Location: http://university.netology.ru/u/zenkin/PHP/2-4/index.php');
	die;
}
	header('Content-type: image/png');

	if (getLoggedUser()['name'] == 'guest') {
		$userName = isset($_GET['name']) ? $_GET['name'] : 'Иванов Иван';
	} else {
		$userName = (string)getLoggedUser()['name'];
	}

	renderImg($userName);
