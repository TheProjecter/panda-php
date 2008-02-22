<?php


function pr($obj) {
	echo "<pre>";
	if (trim(print_r($obj, true)) == '' || $obj === true) {
		var_dump($obj);
	} else {
		print_r($obj);
	}
	echo "</pre>";
}

define('show_them_debugzzzz', true);
function dev($text) {
	if (show_them_debugzzzz) {
		pr($text);
	}
}

?>