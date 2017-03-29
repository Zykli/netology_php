<?php

	$GETValue = '';
	if (isset($_GET)) {
		foreach($_GET as $key => $value){
	    	$GETValue = $key;
		}
	}
	$fileDataName = __DIR__ . '/data.json';
	$data = json_decode(file_get_contents($fileDataName), true);
	for ($i=0; $i < count($data) ; $i++) {
		if ($data[$i]["name"] == $GETValue) {
			$testFile = $data[$i]["dir"];
		}
	}

	$fileTestChoosen = __DIR__ . '/'.$testFile;
	$testData = json_decode(file_get_contents($fileTestChoosen), true);
	$description = $testData[$GETValue]["description"];
	$inputType = $testData[$GETValue]["input"]["type"];
	$inputName = $testData[$GETValue]["input"]["name"];
	$rezult = $testData[$GETValue]["result"];

	if($_POST) {
	$answer = isset($_POST[$inputName]) ? $_POST[$inputName] : '';
	if($answer == $rezult) {
		echo "Правильно!";
	} else {
		echo "Попробуйте еще раз...";
	}

	}

	$formActionUrl = '/u/zenkin/PHP/2-2/test.php?'.$GETValue;

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
	  	<label for=<?= $inputName ?>><?= $description ?></label>
	  	<input id=<?= $inputName ?> type=$inputType name=<?= $inputName ?> >
			<input type="submit" value="Отправить">
	  </form>
  </span>
  </body>
</html>
