<?php

/**
 * An ActiveRecord Implementation
 *
 * @package ActiveRecord
 * @author Michael Girouard
 **/
abstract class Panda_ActiveRecord
extends Panda_ValueObject
implements Panda_ActiveRecord_Interface
{
    /**
     * The name of the corresponding table
     *
     * @var string
     **/
    protected $tableName;
    
    /**
     * The name of the primary key column
     *
     * @var string
     **/
    protected $primaryKey = 'id';
    
    /**
     * A PDO instance for database stuff
     *
     * @var PDO
     **/
    protected $Pdo;
    
    /**
     * The PDO fetch mode to use
     * 
     * @var int
     */
    protected $pdoFetchMode = PDO::FETCH_OBJ;
    
    /**
     * Constructor
     *
     * @param PDO $Pdo
     * @author Michael Girouard
     **/
    public function __construct($Pdo) {
        $this->Pdo = $Pdo;
    }
    
    /**
     * Returns the corresponding table name
     *
     * @return string
     * @author Michael Girouard
     **/
    public function getTableName() {
        if (empty($this->tableName)) {
            preg_match('/[a-zA-Z0-9]+$/', get_class($this), $matches);

            if (count($matches) > 0) {
                $this->tableName = $matches[0];
            }
            else {
                throw new Panda_ActiveRecord_Exception(
                    Panda_ActiveRecord_Exception::INVALID_MODEL_NAME
                );
            }
        }

        return $this->tableName;
    }

    /**
     * Changes the PDO statement fetch mode
     *
     * @return void
     * @author Michael Girouard
     **/
    public function setFetchMode($pdoFetchMode) {
        $this->pdoFetchMode = $pdoFetchMode;
    }
    
    /**
     * Returns the last inserted ID (if supported by the driver)
     * 
     *
     * @return string
     * @author Michael Girouard
     */
    public function lastInsertId()
    {
        return $this->Pdo->lastInsertId();
    }
    
    /**
     * Satisfies the interface requirement of save()
     *
     * @return boolean
     * @author Michael Girouard
     **/
    public function save() {
        if (empty($this->values)) {
            return false;
        }
        
        $keys = array_keys($this->values);
        
        if (!array_key_exists($this->primaryKey, $this->values)) {
            $sql = sprintf(
                "INSERT INTO %s (%s) VALUES(%s)",
                $this->getTableName(),
                implode(',', $keys),
                Panda_String::asprintf(':%k', $this->values, ',')
            );
        }
        else {
            $sql = sprintf(
                "UPDATE %s SET %s WHERE $this->primaryKey = :$this->primaryKey",
                $this->getTableName(),
                Panda_String::asprintf("%k = :%k", $this->values, ','),
                $this->values[$this->primaryKey]
            );
        }

        $Statement = $this->Pdo->prepare($sql);
        
        foreach ($this->values as $key => $value) {
            $Statement->bindValue(":$key", $value);
        }
        
        return $Statement->execute();
    }

    /**
     * Satisfies the interface requirement of find()
     *
     * @param array $fields 
     * @param array $modifiers
     * @return array
     * @author Michael Girouard
     **/
    public function find($fields = array(), $modifiers = array()) {
        if (empty($fields)) {
            $fields = $this->fields;
        }
        
        $sql = sprintf(
            'SELECT %s FROM %s',
            implode(', ', $fields),
            $this->getTableName()
        );
        
        if (!empty($modifiers)) {
            if (array_key_exists('where', $modifiers)) {
                // build where clause
            }
            
            if (array_key_exists('limit', $modifiers)) {
                // build limit clause
            }
            
            if (array_key_exists('custom', $modifiers)) {
                $sql .= ' ' . $modifiers['custom'];
            }
        }
        
        $Statement = $this->Pdo->prepare($sql);
        $Statement->setFetchMode($this->pdoFetchMode);
        $Statement->execute();
        
        return $Statement->fetchAll();
    }
    
    /**
     * Satisfies the interface requirement of remove()
     *
     * @return boolean
     * @author Michael Girouard
     **/
    public function remove() {
        if (array_key_exists($this->primaryKey, $this->values) &&
            !empty($this->values[$this->primaryKey])) {
            
            $sql = sprintf(
                "DELETE FROM %s WHERE $this->primaryKey = :$this->primaryKey",
                $this->getTableName()
            );
            
            $Statement = $this->Pdo->prepare($sql);
            $Statement->bindValue(":$this->primaryKey", $this->values[$this->primaryKey]);
            return $Statement->execute();
        }
        else {
            return false;
        }
    }
    
    /**
     * A generic query method
     *
     * @return mixed
     * @author Michael Girouard
     **/
    public function query($sql) {
        $Statement = $this->Pdo->prepare($sql);
        
        if (preg_match('/^SELECT/i', $sql)) {
            $Statement->execute();
            return $Statement->fetchAll();
        }
        else {
            return $Statement->execute();
        }
    }
}

?>
