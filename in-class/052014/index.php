<!doctype html>
<html>
	<body>
		<h1>WHAT YOU ATE:</h1>
		<form method="POST" action="edit.php">
			<input placeholder="type" name="type">
			<input placeholder="calories" name="calories">
			<input type="submit">
		</form>

<?php
	
	include("passwords.php");
	$mysql = new mysqli(
		"localhost", //server
		"twilburn", //username
		$mysql_password, //password
		"twilburn" //database name
	);

	$prepared = $mysql->prepare('SELECT * FROM tracker_food');
	//don't need to bind - no parameters!
	$prepared->execute();
	$results = $prepared->get_result();

	foreach ($results as $row) {
?>
	<div> 
		<?= htmlentities($row["calories"]) ?>
		calories from 
		<?= htmlentities($row["type"]) ?>
	</div>
<?php
	}

	$sumQuery = $mysql->prepare('SELECT SUM(calories) AS sum FROM tracker_food;');
	//don't need to bind, no parameters
	$sumQuery->execute();
	//results don't come back from DB until get_result
	$sumResult = $sumQuery->get_result();

	$sum = $sumResult->fetch_array();
?>
		<div>
			Your total calorie input is:
			<?= $sum["sum"] ?>
		</div>
	</body>
</html>