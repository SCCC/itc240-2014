<?php
/*

This page shows all the comments in the guestbook. It links to edit.php, for users who want 
to add comments.

*/

include("passwords.php");

//connect to database
$mysql = new mysqli("localhost", "twilburn", $mysql_password, "twilburn");

?>
<!doctype html>
<html>
  <body>
    <a href="edit.php">Click here to comment</a>
    <div class="comments">
      <?php
//write SQL in single quotes to protect against attack
//$select = 'SELECT * FROM guestbook;';

/*

In the following query, instead of using the value of posted_on directly, we instead split 
its value into three parts using the built-in date functions: YEAR(), MONTH(), and DAY(). We 
also use the AS keyword for the first time, to tell MySQL what we want the resulting columns 
to be named. 

*/
$select = 'SELECT name, comment, MONTH(posted_on) AS month, YEAR(posted_on) AS year, DAY(posted_on) AS day FROM guestbook;';

//prepare the string as a query
$prepared = $mysql->prepare($select);
//bind - nothing to bind
//send query to be executed
$prepared->execute();

//give me the resulting rows
$comments = $prepared->get_result();

foreach ($comments as $comment) {
?>
  <b><?= $comment["name"] ?></b>
  -
  posted on: 
    <?= $comment["month"] ?>
    /
    <?= $comment["day"]?>
    /
    <?= $comment["year"] ?>
  <pre>
<?= $comment["comment"] ?>
  </pre>
<?php
}
      ?>
    </div>
  </body>
</html>






