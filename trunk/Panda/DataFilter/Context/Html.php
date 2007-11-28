<?php

class Panda_DataFilter_Context_Html extends Panda_DataFilter_Context
{
    private $charset = 'UTF-8';
    private $quotes = ENT_COMPAT;

    public function __get($name) {
        return htmlentities($this->data[$name], $this->quotes, $this->charset);
    }

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }

    public function setCharset($charset) {
        $this->charset = $charset;
    }

    public function setQuoteStyle($quoteStyle) {
        $this->quotes = $quoteStyle;
    }
}

?>