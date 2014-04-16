<?php

$variable = "text";

/*
Superglobals:
$_SERVER - server-specific information
$_COOKIE - all the cookies that are assigned
$_REQUEST - URL parameters or form submission
$_FILES - files that are uploaded
*/

print_r($_REQUEST);

$name = htmlentities($_REQUEST["name"]);
if ($name == "Thomas") {
	$name = "The Incredible Thomas";
}

//SANITIZATION:
//htmlentities()

if (isset($_REQUEST["last_name"])) {
	$last_name = $_REQUEST["last_name"];
} else {
	$last_name = "";
}

?>
<!doctype html>
<html>
	<body>
		Hello, 
		<?php echo $name; ?>
		<?= htmlentities($last_name); ?>!
		
		<form method="post">
			<input name="comment">
			<input type="hidden" value="123" name="nonce">
			<button>Submit</button>
		</form>
<?php

if (isset($_REQUEST["nonce"])) {
	echo $_REQUEST["comment"];
}

?>

	</body>
</html>




