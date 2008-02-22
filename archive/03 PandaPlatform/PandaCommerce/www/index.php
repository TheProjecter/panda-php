<?php

ini_set('display_errors', 'on');
error_reporting(E_ALL);

define('PROJECT_DIR', dirname(dirname(__FILE__)));

require 
    dirname(PROJECT_DIR) . 
    DIRECTORY_SEPARATOR . 'Panda' .
    DIRECTORY_SEPARATOR . 'Panda.php';

Panda_Framework::bootstrap();

?>