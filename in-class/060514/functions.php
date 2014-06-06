<?php

function out($unclean) {
  $clean = htmlentities($unclean);
  return $clean;
}

function groupon($price) {
  //subract 1 from price
  $discount = $price - 1;
  //add $ and .99
  $tomfoolery = '$' . $discount . '.99';
  return $tomfoolery;
}

function get_request($param) {
  //if this was found in $_REQUEST
  if (isset($_REQUEST[$param])) {
    //exit early
    return $_REQUEST[$param];
  }
  //if not found
  return false;
}

function get_array($array, $param) {
  //if this was found in $array
  if (isset($array[$param])) {
    //exit early
    return $array[$param];
  }
  //if not found
  return false;
}

$mysql = new mysqli("localhost", "twilburn", $mysql_password, "twilburn");

function update_calories($id, $calories) {
  global $mysql;
  $prepared = $mysql->prepare('UPDATE cupcakes SET calories = ? WHERE id = ?');
  $prepared->bind_param("ii", $calories, $id);
  $prepared->execute();
}

function get_cupcakes() {
  global $mysql;
  $prepared = $mysql->prepare('SELECT * FROM cupcakes');
  $prepared->execute();
  return $prepared->get_result();
}

function input($name) {
?>
<input name="<?= $name ?>" type="text" pattern="\w+">
<?php
}









