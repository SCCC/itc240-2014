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
		include("cover.php");
	} else {
		include("book.php");
	}
}

?>
		</ul>
	</body>
</html>