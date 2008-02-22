<?php

/**
 * ActiveRecord
 * 
 * A wrapper for a database table providing basic CRUD functionality with 
 * little or no need to code SQL by hand. This class should be extended with
 * a concrete Model providing it with the name of the table. Table names will 
 * guessed if none is provided (don't rely on this).
 *
 * @category Database
 * @package default
 * @author Michael Girouard
 **/
abstract class ActiveRecordModel extends Model {
	
	/**
	 * The database interface
	 *
	 * @var DBI
	 **/
	protected $DBI;
	
	/**
	 * Name of the database table
	 *
	 * @var string
	 **/
	protected $table;
	
	/**
	 * Constructor
	 * 
	 * Opens a connection to the database and sets the table name to query 
	 * against.
	 * 
	 * @param Controller $Controller
	 * @return void
	 * @author Michael Girouard
	 **/
	public function __construct(Controller $Controller) {
		parent::__construct($Controller);
		$this->openDBI();
		$this->setTable();
	}
	
	/**
	 * Opens a connection to the database
	 *
	 * @return void
	 * @author Michael Girouard
	 **/
	private function openDBI() {
		$this->DBI = new Database;
	}
	
	/**
	 * Guesses a name of a database table if one doesn't already exist
	 *
	 * @return void
	 * @author Michael Girouard
	 **/
	private function setTable() {
		if(is_null($this->table)) {
			$this->table = strtolower(get_class($this));
		}
	}
	
	public function execute($sql) {
        return $this->DBI->execute($sql);
	}
	
	/**
	 * Reads a single record from the current table
	 *
	 * @param int $id
	 * @param array|string $fields
	 * @return void
	 * @author Michael Girouard
	 **/
	public function read($id, $fields = '*') {
		$result = $this->DBI->select($fields, $this->table, array('id' => $id));
		
		if(!empty($result)) {
			$this->data = $result[0];
			return $this->data;
		}
		else {
			return null;
		}
	}
	
	/**
	 * Finds records within a table
	 *
	 * @param array|string $fields
	 * @param array|string $conditions
	 * @param int $count
	 * @param int $page
	 * @return void
	 * @author Michael Girouard
	 **/
	public function find($fields = null, $conditions = null, $count = null, $page = null) {
		$result = $this->DBI->select($fields, $this->table, $conditions, $count, $page);
		
		if(!empty($result)) {
			$this->data = $result;
			return $this->data;
		}
		else {
			return null;
		}
	}
	
	/**
	 * A unified interface for inserting or updating records.
	 * 
	 * @param array|object $data
	 * @return void
	 * @author Michael Girouard
	 **/
	public function save($data) {
		if(array_key_exists('id', $data) && !empty($data['id'])) {
			$this->DBI->update($this->table, $data, array('id' => $data['id']));
		}
		else {
			$this->DBI->insert($this->table, $data);
		}
	}
	
	/**
	 * Deletes a record from a table
	 *
	 * @param int $id
	 * @return void
	 * @author Michael Girouard
	 **/
	public function delete($id) {
		$this->DBI->delete($this->table, array('id' => $id));
	}
	
}

?>