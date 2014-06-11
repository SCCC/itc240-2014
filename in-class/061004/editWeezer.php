<?php
include("passwords.php");
$mysql = new mysqli("localhost", "twilburn", $mysql_password, "twilburn");

class Band {
	public $name;
	public $genre;
	public $num_members;
	public $hit_song;
	public $id;

	function load($conn, $id) {
		$query = $conn->prepare('SELECT * FROM bands WHERE id=? LIMIT 1');
		$query->bind_param("i", $id);
		$query->execute();
		$result = $query->get_result();
		$row = $result->fetch_array();
		$this->name = $row["name"];
		$this->genre = $row["genre"];
		$this->num_members = $row["num_members"];
		$this->hit_song = $row["hit_song"];
		$this->id = $row["id"];
	}

	function save($conn) {
		//if this was a new band, there would be no id, we would insert
		$query = $conn->prepare('UPDATE bands SET name=?, genre=?, num_members=?, hit_song=? WHERE id=?');
		$query->bind_param("ssisi", $this->name, $this->genre, $this->num_members, $this->hit_song, $this->id);
		$query->execute();
	}
}

$band = new Band();
$band->load($mysql, 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$band->name = $_REQUEST["name"];
	$band->hit_song = $_REQUEST["hit_song"];
	$band->save($mysql);
}

?>
<!doctype html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Edit Weezer</title>
	</head>
	<body>

		<form method="POST" action="editWeezer.php">
			<input name="name" value="<?= htmlentities($band->name) ?>">
			<input name="hit_song" value="<?= htmlentities($band->hit_song) ?>">
			<input type="submit">
		</form>

	</body>
</html>
