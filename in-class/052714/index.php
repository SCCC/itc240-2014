<?php

$name = "";

if (isset($_COOKIE["your_name"])) {
  $name = $_COOKIE["your_name"];
}

if (isset($_REQUEST["name"])) {
  setcookie(
    "your_name",
    $_REQUEST["name"],
    time() + 5 * 60,
    "/",
    ".no-ip.org"
  );
  $name = $_REQUEST["name"];
}

?>
<!doctype html>
  This space intentionally left blank.
  <form action="index.php">
    <input
      placeholder="First Name"
      name="name"
      value="<?= $name ?>"
    >
  </form>
  <pre>
  <?php
    print_r($_COOKIE);
  ?>
  </pre>