<?php

include("passwords.php");
include("functions.php");

//library.com?view=list || ?view=cover
//wrong way:
//$view = $_REQUEST["view"];
//right way:
$view = get_request("view");
echo $view;

//print_r($_SERVER);

echo get_array($_SERVER, "HTTP_USER_AGENT");
echo get_array($_COOKIE, "sort");

update_calories(1, 3000);
$cupcakes = get_cupcakes();

?>
<!doctype html>
<html>
  <body>
    <?= out("<script>alert(1);</script>"); ?>
    <ul>
      <li> Pet Shampoo <?= out(groupon(7)) ?>
      <li> Cheetos <?= groupon(1) ?>
      <li> Pack of 10,000 rubber bands <?= groupon(5) ?>
    </ul>
    
    <form>
    <?php input("first_name"); ?>
    </form>
  </body>
</html>