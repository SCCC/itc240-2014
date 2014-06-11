<?php

class Card {
	public $suit = "spades";
	public $value = 1;

	function __construct($suit, $value) {
		$this->suit = $suit;
		$this->value = $value;
	}

	function say() {
		echo $this->value . " of " . $this->suit;
	}
}

$card = new Card("clubs", 2);
// $card->suit = "clubs";
// $card->value = 2;
?>
<!doctype html>
<pre>
	<?php $card->say() ?>
</pre>

<?php
//this is our band demo block
class Band {
	public $name;
	public $genre;
	public $num_members;
	public $hit_song;
	public $id;

	function load($conn, $id) {
		$query = $conn->prepare('SELECT * FROM bands WHERE id = ? LIMIT 1');
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
		$query = $conn->prepare('UPDATE bands SET name=?, genre=?, num_members=?, hit_song=? WHERE id = ?');
		$query->bind_param("ssisi", $this->name, $this->genre, $this->num_members, $this->hit_song, $this->id);
		$query->execute();
	}
}

$the_who = new Band();
$the_who->name = "The Who";

include("./passwords.php");
$mysql = new mysqli("localhost", "twilburn", $mysql_password, "twilburn");

$weezer = new Band();
$weezer->load($mysql, 1);

$weezer->hit_song = "Undone (The Sweater Song)";
$weezer->name = "The Band Formerly Known As Weezer";
$weezer->num_members = 1;

$weezer->save($mysql);

?>
<pre>
	<?php print_r($weezer); ?>
</pre>