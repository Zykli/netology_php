<?php
session_start();
require_once 'functions.php';
if(!isLogged()) {
	header('Location: http://university.netology.ru/u/zenkin/PHP/2-4/index.php');
	die;
}
	$GETValue = '';
		if (isset($_GET["name"])) {
			foreach($_GET as $key => $value){
		    	$GETValue = $key."=".$value;
		    	$valueTestName = $value;
			}
			$fileDataName = __DIR__ . '/data.json';
		$data = json_decode(file_get_contents($fileDataName), true);
		for ($i=0; $i < count($data) ; $i++) {
			$qwe = 'name='.$data[$i]["name"];
			if ($qwe == $GETValue) {
				$testFile = $data[$i]["dir"];
				$check = 0;
				break;
			} else {
				$check = 1;
			}
		}

		if ($check > 0) {
			http_response_code(404);
			echo 'Cтраница не найдена!';
			exit(1);
		}

		$fileTestChoosen = __DIR__ . '/'.$testFile;
		$testData = json_decode(file_get_contents($fileTestChoosen), true);
		$description = $testData[$valueTestName]["description"];
		$inputType = $testData[$valueTestName]["input"]["type"];
		$inputName = $testData[$valueTestName]["input"]["name"];
		$rezult = $testData[$valueTestName]["result"];
		}


		if (!empty($_POST['delete-test'])) {
	    		for ($i=0; $i < count($data) ; $i++) {
	    			$fileDataName = __DIR__ . '/data.json';
					$data = json_decode(file_get_contents($fileDataName), true);
					$qwe = 'name='.$data[$i]["name"];
					if ($qwe == $GETValue) {
						$testFile = $data[$i]["dir"];
						array_splice($data, $i, 1);
					}
				}
				file_put_contents($fileDataName, json_encode($data));
				$fileTestChoosen = __DIR__ . '/'.$testFile;
				unlink($fileTestChoosen);
				header('Location: http://university.netology.ru/u/zenkin/PHP/2-4/list.php');
				die;
	    }


	if(!empty($_POST['answer'])) {
	$answer = isset($_POST[$inputName]) ? $_POST[$inputName] : '';

	if($answer == $rezult) {
		if(getLoggedUser()['name'] != 'guest') {
			header('Location: http://university.netology.ru/u/zenkin/PHP/2-4/sertificate.php');
		} else {
			$guestName = $_POST['name'];
			header('Location: http://university.netology.ru/u/zenkin/PHP/2-4/sertificate.php?name='.$guestName);
		}
	} else {
		echo "Попробуйте еще раз...";
	}

	}

	$formActionUrl = '/u/zenkin/PHP/2-4/test.php?'.$GETValue;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Форма теста</title>
  </head>
  <body>
  <span>
		<h4>
			Пользователь: <?= getLoggedUser()['name'] ?>
		</h4>
	  <form action=<?= $formActionUrl ?> method="POST">
			<div style="<?= showGuest() ?>">
				<label for="name">Ваше Фамилия и Имя</label>
				<input id="name" name="name" type="text" placeholder="Иванов Иван">
				<br />
			</div>
	  	<label for=<?= $inputName ?>><?= $description ?></label>
	  	<input id=<?= $inputName ?> type=$inputType name=<?= $inputName ?> >
			<input name="answer" type="submit" value="Отправить">
			<br>
			<input name="delete-test" type="submit" value="Удалить тест" style="<?= hide() ?>">
	  </form>
  </span>
  </body>
</html>
