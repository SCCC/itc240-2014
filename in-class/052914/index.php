<?php
  /*setcookie(
    "itc240", //name
    "is super awesome", //value
    time() + 60 * 60 * 24 * 365 * 5, //expires (number!)
    "/" //path
  );*/
  
  function make_cookie($name, $value) {
    setcookie($name, $value, time() + 60 * 60 * 24 * 30, "/");
  }
  
  function delete_cookie($name) {
    setcookie($name, "", 10, "/");
  }
  
  make_cookie("user_id", "12345612345");
  make_cookie("tracking_id", "abdfdsafds");
  make_cookie("hello", "world");
  
  delete_cookie("itc240");
  
  $sample = [
    "hello" => "world",
    "cookie" => "fortune"
  ];
  
  $list = [1, 2, 3, 4];
  
  $options = [
    "last_name_first" => true,
    "show_photos" => true,
    "favorite" => "Dad"
  ];
  
  make_cookie("options", json_encode($options));
  
  if (isset($_COOKIE["options"])) {
    $from_cookie = json_decode($_COOKIE["options"], true);
  }
  
?>
<!doctype html>
<html>
  <body>
    <pre>
    <?php print_r($_COOKIE); ?>
    <?= json_encode($sample); ?>
    <?= json_encode($list); ?>
    <?php print_r($from_cookie); ?>
    </pre>
  </body>
</html>


