<?php

class AnotherTest_Bar
{
    public $a;
    public $b;
    public $c;
    
    public function __construct ($a, $b, $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }
    
    public function doTest ($a, $b, $c)
    {
        return $a === $this->a &&
               $b === $this->b &&
               $c === $this->c;
    }
}