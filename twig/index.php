<?php 
	session_start();
	$config = include 'config.php';

	include 'database/DataBase.php';

	$db = DataBase::connect(
	 	$config['mysql']['host'],
	 	$config['mysql']['dbname'],
	 	$config['mysql']['user'],
	 	$config['mysql']['pass']
	);

	include 'functions.php';
	
	require __DIR__.'/vendor/autoload.php';
	$loader = new Twig_Loader_Filesystem('./template');
	$twig = new Twig_Environment($loader, array(
		'cache' => './tmpphp',
		'auto_reload' => true
	));

	if(!isLogged()) {
		require 'loginPageScripts.php';
	} else {
		require 'listScripts.php';
	}

?>
