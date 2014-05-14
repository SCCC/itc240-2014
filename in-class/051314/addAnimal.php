<?php
/*

WHAT THIS FILE DOES (PSEUDOCODE):

create a database connection
create some empty default values for the form, such as $form_type and $form_legs
if this was a post request, meaning that the form was submitted
  GOTO POST
otherwise it's a get, so we followed a link
  GOTO GET
  
POST:
  get the form values that were submitted, storing as $type, $legs, $meat, and $id
  if the $id was filled in, this is an update:
    prepare an update query, bind the values, and execute to change the row
  but if there was no $id, this is a new row:
    prepare an insert query, bind the values, and execute to insert a new row
  GOTO ALWAYS
  
GET:
  if the link included ?update=x then:
    prepare a select query, bind with the value from $_REQUEST["update"], and execute
    get the result of the query and fetch a single row as an array
    use that row to fill in the form values for editing via $form_type, $form_legs, and $form_id
  otherwise, if the link included ?delete=x
    prepare a delete query, bind with the value from $_REQUEST["delete"], and execute
  GOTO ALWAYS
  
ALWAYS:
  output the form, setting the input value attributes to the $form_x variables
  query the database for all rows
  loop through these rows, and output a <tr> containing
    the animal type
    the animal's # of legs
    whether the animal is a carnivore
    an edit link, ?update=x where x is the row ID
    a delete link, ?delete=x where x is the row ID

*/
?><!doctype html>
<html>
	<body>
<?php
//include our password file and connect to the database
include("passwords.php");

$mysql = new mysqli("localhost", "twilburn", $mysql_password, "twilburn");

//default form values
$form_type = "";
$form_legs = "";
$form_id = "";

//GET
//get update row from DB
//was this an update link, containing ?update=X
if (isset($_REQUEST["update"])) {
  //we need to get the existing values to fill into the form
  //create a query string named $get_update
  $get_update = 'SELECT * FROM animals WHERE id = ?';
  //prepare, bind, and execute this to get the existing row
	$select = $mysql->prepare($get_update);
	$select->bind_param("i", $_REQUEST["update"]);
	$select->execute();
	//get the result (array containing one row)
	$result = $select->get_result();
	//fetch_array gets a single row at a time
	//this is easier than looping through $result
	$row = $result->fetch_array();
	//fill in existing form values instead of blanks
	$form_type = $row["type"];
	$form_legs = $row["legs"];
	$form_id = $row["id"];
} else if (isset($_REQUEST["delete"])){
  //was this a delete link, containing ?delete=X
  //if so, prep a query to remove that row
	$query = 'DELETE FROM animals WHERE id = ?;';
	$delete = $mysql->prepare($query);
	$delete->bind_param("i", $_REQUEST["delete"]);
	$delete->execute();
}


?>
	<form action="addAnimal.php" method="POST">
		Type: <input name="type" value="<?= $form_type ?>">
		Legs: <input name="legs" value="<?= $form_legs ?>">
		Meat-eater: 
		<select name="meat">
			<option value="true">True</option>
			<option value="false">False</option>
		</select>
		<!-- update_id is a secret value that's only filled in if this is an update action -->
		<input name="update_id" type="hidden" value="<?= $form_id ?>">
		<input type="submit">
	</form>
<?php
//POST
//was the form submitted?
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	//get the form values
	$type = $_REQUEST["type"];
	$legs = $_REQUEST["legs"];
	$meat = $_REQUEST["meat"] == "true";
	$id = $_REQUEST["update_id"];
	
	//the form's update_id input only has a value if this is an update, the user can't see it
	//that way, we can use it as a "flag" for whether this is an update or an insert 
	if ($id) {
		$query = 'UPDATE animals SET type=?, legs=?, carnivore=? WHERE id=?';
		$update = $mysql->prepare($query);
		$update->bind_param("siii", $type, $legs, $meat, $id);
		$update->execute();
	} else {
		$query = 'INSERT INTO animals (type, legs, carnivore) VALUES (?, ?, ?)';
		$insert = $mysql->prepare($query);
		$insert->bind_param("sii", $type, $legs, $meat);
		$insert->execute();
	}
	
}

//ALWAYS
$animals = $mysql->query('SELECT * FROM animals');
?>
<h1>Animals</h1>
<table>
	<thead>
		<tr>
			<th>Type
			<th>Legs
			<th>Carnivore
			<th>Edit
			<th>Delete
	<tbody>
<?php
foreach ($animals as $row) {
?>
		<tr>
			<td><?= $row["type"] ?>
			<td><?= $row["legs"] ?>
			<td><?= $row["carnivore"] ?>
			<td><a href="?update=<?= $row["id"] ?>">&bull;</a>
			<td><a href="?delete=<?= $row["id"] ?>">&times;</a>
<?php
}
?>
</table>
	</body>
</html>
