<?php 

set_include_path(sprintf(
    '%s%slib%s%s',
    dirname(dirname(dirname(__FILE__))),
    DIRECTORY_SEPARATOR,
    PATH_SEPARATOR,
    get_include_path()
));

require_once 'PHPUnit/Framework/TestCase.php';