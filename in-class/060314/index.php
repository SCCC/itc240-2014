<?php

function get_option($name, $default) {
  //start with the default value
  $value = $default;
  //if there is a cookie with this name, use its value
  if (isset($_COOKIE[$name])) {
    $value = $_COOKIE[$name];
  }
  //if the user provides the named URL parameter
  //use that value instead
  if (isset($_REQUEST[$name])) {
    $value = $_REQUEST[$name];
    setcookie($name, $value, time() + 60 * 5, "/");
  }
  //return the value that was found, or the default
  return $value;
}

include("passwords.php");
$mysql = new mysqli(
  "localhost",
  "twilburn",
  $mysql_password,
  "twilburn"
);
//original: no sort
//$cupcakeQuery = $mysql->prepare("SELECT * FROM cupcakes;");

/*$sort = "flavor";
//if you have a sort cookie, use it
if (isset($_COOKIE["sort"])) {
  $sort = $_COOKIE["sort"];
}
//if you specify sort in the URL, use it instead
if (isset($_REQUEST["sort"])) {
  $sort = $_REQUEST["sort"];
  setcookie("sort", $sort, time() + 60 * 5, "/");
}*/
$sort = get_option("sort", "calories");
$theme = get_option("theme", "light");

//only allow certain column names
$sortWhitelist = [
  "flavor" => true,
  "calories" => true
];
//if $sort is not set in $sortWhitelist
if (!isset($sortWhitelist[$sort])) {
  $sort = "flavor";
}

$cupcakeQuery = $mysql->prepare("SELECT * FROM cupcakes ORDER BY $sort DESC;");
$cupcakeQuery->execute();
$cupcakes = $cupcakeQuery->get_result();
//print_r($cupcakes);


?>
<!doctype html>
<html>
  <head>
    <title>CUPCAKES YAY!</title>
  </head>
  <body>
    <h1>CUPCAKES YAY!</h1>
    <table>
      <thead>
        <tr>
          <th><a href="?sort=flavor">Flavor</a>
          <th><a href="?sort=calories">Calories</a>
          <th>Image
      <tbody>
<?php
foreach ($cupcakes as $cake) { ?>
        <tr>
          <td><?= htmlentities($cake["flavor"]) ?>
          <td><?= htmlentities($cake["calories"]) ?>
          <td>
            <img 
              src="<?= htmlentities($cake["image"]) ?>"
              width=50
            >

<?php
}
?>
    </table>
  </body>
</html>






