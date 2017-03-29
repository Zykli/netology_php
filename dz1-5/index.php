<!DOCTYPE html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="master.css" />
</head>
<body>
	<div>
		<h2></h2>
		<table>
			<thead>
				<tr>
					<th>Имя</th>
					<th>Фамилия</th>
					<th>Адресс</th>
					<th>Номер телефона</th>
				</tr>
			</thead>
			<tbody>
			<?php
				$content = file_get_contents('phonebook.json');
				$phoneBook = json_decode($content, true);
				for ($i=0; $i < count($phoneBook) ; $i++):?>
				    <tr>
			        	<td><?=$phoneBook[$i]['firstName']?></td>
			        	<td><?=$phoneBook[$i]['lastName']?></td>
			        	<td><?=$phoneBook[$i]['address']?></td>
			        	<td><?=$phoneBook[$i]['phoneNumber']?></td>
			        </tr>
			    <?php endfor;?>
			</tbody>
		</table>
	</div>
</body>
