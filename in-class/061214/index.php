<?php

include("classes.php");

$page_tester = new Tester();

$page_tester->test(2, 2);
//$page_tester->test(1, 2);

$page_tester->test($page_tester->passed, 1);

$calc = new Calculator();
$page_tester->test($calc->currentTotal, 0);

$calc->currentTotal = 123456;
echo $calc->eq();
$calc->clear();
$page_tester->test($calc->currentTotal, 0);

$calc->add(5);
$page_tester->test($calc->currentTotal, 5);

$calc->sub(2);
$page_tester->test($calc->currentTotal, 3);

$calc->clear();
$calc->add(2);
$calc->mult(3);
$page_tester->test($calc->currentTotal, 6);

$calc->div(3);
$page_tester->test($calc->currentTotal, 2);

$equals = $calc->eq();
$page_tester->test($equals, 2);

?>
<p>Tests passed: <?= $page_tester->passed ?>
<p>Tests failed: <?= $page_tester->failed ?>