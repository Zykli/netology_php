<?php
function getUsers() {
	$filePath = __DIR__.'/{login}.json';
	if (!file_exists($filePath)) {
		return [];
	}

	$fileData = file_get_contents($filePath);
	$data = json_decode($fileData, true);
	if(!$data) {
		return [];
	}
	return $data;
}

function getUser ($login) {
	$users = getUsers();
	foreach ($users as $user) {
		if (strcmp($user['login'], $login) === 0) {
			return $user;
		}
	}
	return null;
}
function login ($login, $password) {
	$user = getUser($login);
	if ($user && $user['password'] == $password) {
		$_SESSION['user'] = $user;
		return true;
	}
	return false;
}

function isPost () {
  return $_SERVER['REQUEST_METHOD'] == 'POST';
}

function getParamPost($name) {
  return filter_input(INPUT_POST, $name);
}

function isLogged() {
  return !empty($_SESSION['user']);
}

function getLoggedUser() {
  return !empty($_SESSION['user']) ? $_SESSION['user'] : null;
}

function logout() {
  session_destroy();
}

function renderImg($code) {
  $im = imagecreatetruecolor(800, 566);

  $backColor = imagecolorallocate($im, 255, 224, 221);
  $textColor = imagecolorallocate($im, 0, 0, 0);
  $font = __DIR__.'/AaarghBold.ttf';
  $imBox = imagecreatefrompng('sert.png');
  imagefill($im, 0, 0, $backColor);
  imagecopy($im, $imBox, 0, 0, 0, 0, 800, 566);
  imagettftext($im, 25, 0, 280, 290, $textColor, $font, $code);
  imagepng($im);
  imagedestroy($im);
}
function hide(){
  if(getLoggedUser()['name'] == 'guest') {
    return 'display: none;';
  }
}

function showGuest(){
  if(getLoggedUser()['name'] == 'guest') {
    return 'display: block;';
  } else {
    return 'display: none;';
  }
}
