<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

/**
 * Database Interface
 * 
 * This class provides a simple abstracted interface to the most common 
 * database operations.
 *
 * @category  Database
 * @package   DBI
 * @author    Michael Girouard <mikeg@lovemikeg.com>
 * @copyright (c) 2007, Michael Girouard
 * @license   http://www.opensource.org/licenses/bsd-license.php The BSD License
 **/
abstract class DBI {
	
	/**
	 * PHP's proprietary connection resource
	 *
	 * @var resource
	 **/
	protected $connectionResource;
	
	/**
	 * Constructor
	 * 
	 * Calls the abstracted DBI::connect() method to open a connection to the
	 * database.
	 *
	 * @return void
	 * @author Michael Girouard
	 **/
	public function __construct() {
		$this->connect();
	}
	
	/**
	 * Destructor
	 * 
	 * Calls the abstracted DBI::disconnect() method to close the connection 
	 * to the database.
	 *
	 * @return void
	 * @author Michael Girouard
	 **/
	public function __destruct() {
		$this->disconnect();
	}
	
	/**
	 * Opens a connection to the database
	 * 
	 * The abstracted method should store the resulting resource identifier in 
	 * the DBI::$connectionResource property.
	 *
	 * @return void
	 * @author Michael Girouard
	 **/
	abstract protected function connect();
	
	/**
	 * Disconnects from the database
	 * 
	 * The abstracted method should use the DBI::$connectionResource to 
	 * identify the specific connection to close (in the event where multiple
	 * connections is required).
	 *
	 * @return void
	 * @author Michael Girouard
	 **/
	abstract protected function disconnect();
	
	/**
	 * Fetches information from a database table
	 *
	 * @param string|array $fields
	 * @param string|array $tables
	 * @param string|array $conditions
	 * @param string|array $limits
	 * @return array
	 * @author Michael Girouard
	 **/
	abstract public function select($fields, $tables, $conditions = null, $count = null, $page = null);
	
	/**
	 * Inserts new data into a database table
	 *
	 * @param string $table
	 * @param object|array $data
	 * @return bool
	 * @author Michael Girouard
	 **/
	abstract public function insert($table, $data);
	
	/**
	 * Updates existing data within a database table
	 *
	 * @return void
	 * @author Michael Girouard
	 **/
	abstract public function update($table, $data, $conditions);
	
	/**
	 * Deletes datafrom a database table
	 *
	 * @return void
	 * @author Michael Girouard
	 **/
	abstract public function delete($table, $conditions);
	
	/**
	 * Executes a provided SQL statement
	 * 
	 * No effort is made by this method to escape the provided SQL statement
	 * so it is strongly advised that proper escaping routines are used before
	 * calling this method.
	 *
	 * @return void
	 * @author Michael Girouard
	 **/
	abstract public function execute($sql);
	
}

?>