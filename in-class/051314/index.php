<?php

include("passwords.php");

$mysql = new mysqli("localhost", "twilburn", $mysql_password, "twilburn");

/*
$result = $mysql->query('SELECT * FROM animals');
*/

$query = 'SELECT * FROM animals WHERE legs = ?';
$prepared = $mysql->prepare($query);
$legs = 4; //$_REQUEST["legs"]
$prepared->bind_param("i", $legs);
$prepared->execute();
$result = $prepared->get_result();

echo "<pre>";
foreach ($result as $row) {
	print_r($row);
}






