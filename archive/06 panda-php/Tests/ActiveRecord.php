<?php

require 'setup.php';
require '../Panda/ValueObject.php';
require '../Panda/String.php';
require '../Panda/ActiveRecord/Interface.php';
require '../Panda/ActiveRecord/Exception.php';
require '../Panda/ActiveRecord.php';

class Test_ActiveRecord_Test extends Panda_ActiveRecord {
    protected $fields = array('id','foo','bar','baz');
}

// Configure the DSN for PDO
$host = 'localhost';
$user = 'root';
$pass = '';
$name = 'ActiveRecord';
$dsn = "mysql:host=$host;dbname=$name";

$AR = new Test_ActiveRecord_Test( 
    new PDO($dsn, $user, $pass)
);

// INSERT
out('Inserting some junk data:');
$AR->foo = md5(microtime());
$AR->bar = md5( md5(rand()) . md5(microtime()) );
$AR->baz = md5( md5(microtime()) . md5(microtime()) );

if ($AR->save()) {
    $AR->id = $AR->lastInsertId();
    out("Last inserted Id (if supported): $AR->id");
    out($AR->find(null, array('custom' => "WHERE id = $AR->id")));
}
else {
    out('Insert failed');
}

// UPDATE 
out("Updating row $AR->id");
$AR->foo = microtime();
if ($AR->save()) {
    out("Done:");
    out($AR->find(null, array('custom' => "WHERE id = $AR->id")));
}
else {
    out('Update failed');
}

// SELECT
out("SELECTing Everything from " . $AR->getTableName());
out($AR->find());

out("Changing fetch modes");
$AR->setFetchMode( PDO::FETCH_BOTH );
out($AR->find());

// DELETE
out("DELETING the row we just made");

if ($AR->remove()) {
    out("Done. Row $AR->id is no more:");
    out($AR->find(null, array('custom' => "WHERE id = $AR->id")));
}
else {
    out('Delete failed');
}

?>