<?php

$books = [
	[ "title" => "Dune", "author" => "Frank Herbert" ],
	[ "title" => "Anna Karenina", "author" => "Tolstoy" ],
	[ "title" => "Snow Crash", "author" => "Stephenson" ],
];

$books[] = [ "title" => "M is for Murder", "author" => "Grafton"];

$show = "all";
if (isset($_REQUEST["show"])) {
	$show = $_REQUEST["show"];
}

shuffle($books);

//include("page.php");
?>
<!doctype html>
<html>
	<body>
		<h1>Books!</h1>
		<a href="?show=cover">Cover view</a>
		<a href="?show=all">List view</a>
		<div>
			<?= count($books); ?> books available
		</div>
		<ul>
<?php
	
foreach ($books as $book) {
	if ($show == "cover") {
		//include("cover.php");
?>
<li>
	<img src="http://images.contentreserve.com/ImageType-150/2183-1/653/2EC/E1/%7B6532ECE1-6A95-474D-81AC-9E352133688B%7DImg150.jpg">
	<b><?= $book["title"] ?></b>
<?php
	} else {
		//include("book.php");
?>
<li>
	<b><?= $book["title"] ?></b> -
	<i><?= $book["author"] ?></i>
<?php		
	}
}

?>
		</ul>
	</body>
</html>
