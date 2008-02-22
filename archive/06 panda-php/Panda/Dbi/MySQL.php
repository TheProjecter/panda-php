<?php

/* vim: set expandtab tabstop=4 shiftwidth=4 softtabstop=4: */

abstract class Panda_Dbi_Mysql extends Panda_Dbi {
	
	protected $hostname;
	protected $username;
	protected $password;
	protected $database;
	
	private function aggrigateResults($results, $type = 'object') {
	    if(!$results) {
            die (mysql_error());
	    }
	    $out = array();

        while ($row = mysql_fetch_object($results)) {
           $out[] = $row;
	    }

	    return $out;
	}
	
	/**
	 * Wraps array elements or delimited string components in a set of custom
	 * formatted quotes.
	 * 
	 * @param array|string $input
	 * @param string $quote
	 * @param string $inputDelimiter
	 * @param string $outputDelimiter
	 * @return void
	 * @author Michael Girouard
	 **/
	private function quotify($input, $quote = "'", $inputDelimiter = ',', $outputDelimiter = ' , ') {
		$out = '';

		if(is_string($input)) {
			$input = explode($inputDelimiter, $input);
		}

		foreach($input as $value) {
			$out .= $quote.$value.$quote.$outputDelimiter;
		}

		return rtrim($out, $outputDelimiter) . ' ';
	}
	
	/**
	 * Wraps a set of fields in backticks
	 *
	 * @param array|string $fields
	 * @return void
	 * @author Michael Girouard
	 **/
	private function parseFields($fields = null) {
		if(is_null($fields)) {
			return ' * ';
		}
		
		return $this->quotify($fields, '`');
	}
	
	/**
	 * Wraps a set of tables in backticks
	 * 
	 * If a string is provided it will be returned with spaces padding the left
	 * and right sides of the string. 
	 *
	 * @param array|string $tables
	 * @return void
	 * @author Michael Girouard
	 **/
	private function parseTables($tables) {
		if(is_array($tables)) {
			return $this->quotify($tables, '`');
		}
		
		return " $tables ";
	}
	
	/**
	 * Generates a WHERE clause from an associative array
	 * 
	 * Currently only "AND" conditions are supported. Other condition styles 
	 * will be implemented in future releases. The keys in the $conditions 
	 * array should be the field names and the values will be the field values.
	 * 
	 * For example: array('id' => 123) will return `id` = '123'
	 *
	 * @return void
	 * @author Michael Girouard
	 **/
	private function parseConditions($conditions) {
		if(is_array($conditions)) {
			$out = '';
			
			foreach($conditions as $key => $value) {
				$out .= "AND (`$key` = '$value') ";
			}
			
			return ltrim($out, 'AND');
		}

		return " $conditions ";
	}
	
	protected function connect() {
		$this->connectionResource = mysql_connect($this->hostname, $this->username, $this->password);
		mysql_select_db($this->database, $this->connectionResource);
	}
	
	protected function disconnect() {
		mysql_close($this->connectionResource);
	}
	
	public function select($fields, $tables, $conditions = null, $count = null, $page = null) {
		$sql = 
			"SELECT ".$this->parseFields($fields).
			"FROM "  .$this->parseTables($tables);
		
		if(!empty($conditions)) {
			$sql .= "WHERE ".$this->parseConditions($conditions);
		}
		
		if(!empty($count) && !empty($page)) {
			$count = abs((int)$count);
			$page  = abs((int)$page);
			$start = ($page - 1) * $count;
			
			$sql .= "LIMIT $start, $count";
		}
		
		return $this->execute($sql);
	}
	
	public function insert($table, $data) {
		$sql = 
			"INSERT INTO `$table` ".
			' ('.$this->parseFields(array_keys($data)).') '.
			"VALUES ('".implode("' , '", array_values($data))."')";
		
		return $this->execute($sql);
	}
	
	public function update($table, $data, $conditions) {
		$sql = "UPDATE `$table` SET ";
		
		foreach($data as $field => $value) {
			$sql .= " `$field` = '$value' ,";
		}
		
		$sql = rtrim($sql, ',');
		$sql .= "WHERE " . $this->parseConditions($conditions);
		
		return $this->execute($sql);
	}
	
	public function delete($table, $conditions) {
		$sql = "DELETE FROM `$table` WHERE ".$this->parseConditions($conditions);
		
		return $this->execute($sql);
	}
	
	public function execute($sql) {
		if(preg_match('/^SELECT/', $sql)) {
			return $this->aggrigateResults(mysql_query($sql, $this->connectionResource));
		}
		else {
			return mysql_query($sql, $this->connectionResource);
		}
	}
	
}

?>