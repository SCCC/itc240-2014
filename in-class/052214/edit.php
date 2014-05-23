<?php

include("passwords.php");
$mysql = new mysqli(
    "localhost",
    "twilburn",
    $mysql_password,
    "twilburn"
);

$query = 'INSERT INTO tracker_food (calories, type, eaten_on) VALUES (?, ?, NOW());';
$prepared = $mysql->prepare($query);
$prepared->bind_param(
    "is",
    $_REQUEST["calories"],
    $_REQUEST["type"]
);
$prepared->execute();

header("Location: index.php");


