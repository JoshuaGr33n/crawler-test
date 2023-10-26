<?php

function die_dump($variable) {
    var_dump($variable);
    die();
}

$variable1 = "Hello, World";
$variable2 = [1, 2, 3];
$variable3 = 42;

// Use the die_dump function to dump the values of the variables and halt the script
die_dump($variable1);
die_dump($variable2);
die_dump($variable3);

// The script will stop executing at this point
