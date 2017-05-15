<?php
	function hide($val) {
		return $val === 'true' ? 'display: none;' : 'display: block;';
	};
	$hideForm = hide('false');
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
		$hideForm = hide('true');
		echo "Правильно!";
	} else {
		echo "Попробуйте еще раз...";
	}

	}

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Форма теста</title>
  </head>
  <body>
  <span>
	  <form method="POST" style="<?= $hideForm?>">
	  	<label for=<?= $inputName ?>><?= $description ?></label>
	  	<input id=<?= $inputName ?> type=$inputType name=<?= $inputName ?> >
			<input type="submit" value="Отправить">
	  </form>
	  <div>
	  	<a href="http://university.netology.ru/u/zenkin/PHP/2-2/list.php">Назад</a>
	  </div>
  </span>
  </body>
</html>
