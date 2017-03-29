<?php
if($_POST) {
	$error = [];
	$nameTest = isset($_POST['nameTest']) ? $_POST['nameTest'] : '';

	$userFileName = isset($_FILES['userfile']['name']) ? $_FILES['userfile']['name'] : '';
	$userTmpFileName = isset($_FILES['userfile']['tmp_name']) ? $_FILES['userfile']['tmp_name'] : '';
	if ($userTmpFileName) {
		$exploaded = explode('.', $userFileName);
		$fileType = array_pop($exploaded);
		if ($fileType != 'json') {
			$error[] = 'Файл теста должен быть в json формате';
		} else {
		$imageFileName = __DIR__ . '/test/' . $userFileName;
		$successMoved = move_uploaded_file($userTmpFileName, $imageFileName);
		$dir = 'test/'.$userFileName;
		$userfFileContent = json_decode(file_get_contents($dir), true);
		echo "Тест Успешно загружен!";
		}
	};


	$name = $userfFileContent["name"];

	$fileDataName = __DIR__ . '/data.json';
	$data = json_decode(file_get_contents($fileDataName), true);
	$newData = array('nameTest' => $nameTest, 'name' => $name ,'dir' => $dir);
	$data[] = $newData;
	file_put_contents($fileDataName, json_encode($data));


}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Форма отправки</title>
  </head>
  <body>
  <?php
	  if (isset($error)) {
  		foreach ($error as $error) {
  		echo '<p>'.$error.'</p>';
	  	}
  	}
  	?>
	<form enctype="multipart/form-data" action="/u/zenkin/PHP/2-2/" method="POST">
		<label for="nameTest">Введите название теста</label>
		<input id="nameTest" name="nameTest" type="text" placeholder="2+2">
		<br />
		<label for="test-file">Выберите файл с загружаемым тестом</label>
		<input id="test-file" name="userfile" type="file" />
		<br />
		<input type="submit" value="Отправить">
	</form>
  </body>
</html>
