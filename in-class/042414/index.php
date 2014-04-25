<?php

$books = [
	[ "title" => "Dune", "author" => "Frank Herbert" ],
	[ "title" => "Anna Karenina", "author" => "Tolstoy" ],
	[ "title" => "Snow Crash", "author" => "Stephenson" ],
];

$books[] = [ "title" => "M is for Murder", "author" => "Grafton"];

$show = "all";
if (isset($_REQUEST["show"])) {
	$show = $_REQUEST["show"];
}

shuffle($books);

include("page.php");