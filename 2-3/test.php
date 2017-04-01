<?php

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

	if($_POST) {
	$answer = isset($_POST[$inputName]) ? $_POST[$inputName] : '';
	if($answer == $rezult) {
		$userName = $_POST['name'];
		header('Location: http://university.netology.ru/u/zenkin/PHP/2-3/sertificate.php?name='.$userName);
	} else {
		echo "Попробуйте еще раз...";
	}

	}

	$formActionUrl = '/u/zenkin/PHP/2-3/test.php?'.$GETValue;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Форма теста</title>
  </head>
  <body>
  <span>
	  <form action=<?= $formActionUrl ?> method="POST">
		<label for="name">Ваше Фамилия и Имя</label>
		<input id="name" name="name" type="text" placeholder="Иванов Иван">
		<br />
	  	<label for=<?= $inputName ?>><?= $description ?></label>
	  	<input id=<?= $inputName ?> type=$inputType name=<?= $inputName ?> >
			<input type="submit" value="Отправить">
	  </form>
  </span>
  </body>
</html>
