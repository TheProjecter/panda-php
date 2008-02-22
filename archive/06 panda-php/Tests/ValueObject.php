<?php

require 'setup.php';
require '../Panda/ValueObject.php';

// Test_ValueObject_Validated will validate the given fields
class Test_ValueObject_Validated
extends Panda_ValueObject
{
    protected $fields = array('foo', 'bar', 'baz');
}

// Test_ValueObject_NotValidated will allow anything in
class Test_ValueObject_NotValidated
extends Panda_ValueObject
{
    protected $validateFields = false;
}

// Test values: bif should conflict with Test_ValueObject_Validated but should 
// work fine with notValidated
$testValues = array(
    'foo' => 'florida',
    'bar' => 'alabama',
    'baz' => 'washington',
    'bif' => 'kansas'
);
out("Created test values:");
out($testValues);


$validated = new Test_ValueObject_Validated($testValues);
$notValidated = new Test_ValueObject_NotValidated($testValues);

out("\$validated: Should be missing a 'bif' property");
foreach ($validated as $key => $value) {
    out("\$validated[$key] => $value");
}

out("\$notValidated: Should contain a 'bif' property");
foreach ($notValidated as $key => $value) {
    out("\$notValidated[$key] => $value");
}

?>