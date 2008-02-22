<?php

define('PROJECT_DIR', dirname(dirname(__FILE__)));
define('PANDA_DIR', dirname(PROJECT_DIR) . DIRECTORY_SEPARATOR . 'Panda');

require PANDA_DIR . DIRECTORY_SEPARATOR . 'Panda.php';

Panda::bootstrap();

?>