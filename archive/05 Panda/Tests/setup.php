<?php

error_reporting(E_ALL);
ini_set('display_errors', 'on');
header('Content-type: text/plain');

function out($str) {
    if (is_string($str)) {
        echo "$str\n";
    } 
    else {
        print_r($str);
    }
}

function div() {
    echo str_repeat('=', 80) . "\n";
}

?>