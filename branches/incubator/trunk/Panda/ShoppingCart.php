<?php

class Panda_ShoppingCart
{
    private $sessionKey = __CLASS__;
    
    public function __construct()
    {
        $this->initSession();
    }
    
    public function initSession()
    {
        // Start the session if it doesn't exist already
        if (empty(session_id())) {
            session_start();
        }
        
        // Register an items
        if (array_key_exists($this->sessionKey, $_SESSION)) {
            $_SESSION[$this->sessionKey] = array();
        }
    }
    
    public function getItems()
    {
        return $_SESSION[$this->sessionKey];
    }
    
    public function setItems($data)
    {
        $_SESSION[$this->sessionKey] = $data;
    }
    
    public function getSessionKey()
    {
        return $this->sessionKey;
    }
    
    public function setSessionKey($sessionKey)
    {
        $this->sessionKey = $sessionKey;
    }
    
    public function getItem($index)
    {
        return $_SESSION[$this->sessionKey][$index];
    }
    
    public function addItem($data)
    {
        $_SESSION[$this->sessionKey][] = $data;
    }
    
    public function updateItem($index, $data)
    {
        $_SESSION[$this->sessionKey][$index] = $data;
    }
    
    public function removeItem($index)
    {
        unset($_SESSION[$this->sessionKey][$index]);
    }
    
    public function emptyCart()
    {
        $_SESSION[$this->sessionKey] = array();
    }
}