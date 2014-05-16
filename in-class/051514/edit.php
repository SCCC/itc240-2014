<!doctype html>
<html>
  <body>
    <form action="edit.php" method="POST">
      <input name="name" placeholder="Your name">
      <textarea name="comment"></textarea>
      <input type="submit">
    </form>
  </body>
</html>
<?php

include("passwords.php");

//connect to database
$mysql = new mysqli("localhost", "twilburn", $mysql_password, "twilburn");

//only act on POST (i.e., insert data only if the form was submitted)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  //prepare query - like sending a delivery truck
  //first we write query - like getting an address
  //note: the NOW() function inserts the current date/time as the value
  $query = 'INSERT INTO guestbook (name, comment, posted_on) VALUES (?, ?, NOW());';
  //preparing is like calling for a truck
  $prepared = $mysql->prepare($query);
  //binding params = loading the truck with values
  $prepared->bind_param("ss", $_REQUEST["name"], $_REQUEST["comment"]);
  //executing sends the delivery to the database
  $prepared->execute();
  //no need to get_result(), since we didn't select anything
}

?>









