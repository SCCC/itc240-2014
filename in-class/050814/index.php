<?php

include("passwords.php");

// params: server, username, password, database
$mysql = new mysqli("localhost", "twilburn", $mysql_password, "twilburn");

//query and store in $result
//SAFE ONLY WITH KNOWN VALUES AND SINGLE QUOTES
$result = $mysql->query('SELECT * FROM animals ORDER BY legs ASC, type ASC;');

//DO NOT DO THIS
//$mysql->query("INSERT INTO animals VALUES ($type);");

//Prepared statements are safe
//send to database for preparation
$query = $mysql->prepare("SELECT * FROM animals;");
//then execute
$query->execute();
//get the rows that resulted
//$result = $query->get_result();

//$result is not an array, but acts like one

//loop through the rows and output them
?>
<table>
<?php
foreach ($result as $row) {
?>
	<tr> 
		<td><?= $row["type"] ?>
		<td><?= $row["legs"] ?>
<?php
}
?>
</table>