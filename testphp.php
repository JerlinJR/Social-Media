<?php



$value = "setLastname";

$result = substr("$value", 3, strlen($value)-3);

// echo strtolower($result);
echo strtolower(substr("$value", 3, strlen($value)-3));
