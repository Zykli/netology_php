<?php
	$fileDataName = __DIR__ . '/data.json';
	$data = json_decode(file_get_contents($fileDataName), true);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Форма списка тестов</title>
  </head>
  <body>
  	<ul>
  		<?php
  		for ($i=0; $i < count($data) ; $i++):?>
  			<li>
  				<a href='test.php?<?=$data[$i]["name"]?>'><?= $data[$i]["nameTest"]?></a>
  			</li>
  		<?php endfor;?>
	</ul>
  </body>
</html>
