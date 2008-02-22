<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * MySQL Result
 * 
 * This class provides MySQL specific implementations for the abstracted 
 * methods defined in DBI.
 *
 * @category  Database
 * @package   MySQL
 * @author    Michael Girouard <mikeg@lovemikeg.com>
 * @copyright (c) 2007, Michael Girouard
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 **/
class DBI_MySQLResult {
	
	private $resource;
	private $fetchAs;
	private $resultSet = array();
	private $fetchTypeWhitelist = array('object', 'assoc', 'array');
	
	public function __construct($resource, $fetchAs = 'object') {
		if(is_resource($resource)) {
			$this->resource = $resource;
			$this->fetchResultSet($fetchAs);
		}
	}
	
	private function fetchResultSet($fetchAs) {
		if(in_array($fetchAs, $this->fetchTypeWhitelist)) {
			$fetchFunction = "mysql_fetch_$fetchAs";
			
			while($row = $fetchFunction($this->resource)) {
				$this->resultSet[] = $row;
			}
		}
		else {
			throw new Exception('Invalid fetch type specified.');
		}
	}
	
	public function getResultSet() {
		return $this->resultSet;
	}
	
}

?>