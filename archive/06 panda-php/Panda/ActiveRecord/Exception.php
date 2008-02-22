<?php

/**
 * The ActiveRecord Exception
 *
 * Provides a custom set of error messages which are specific to ActiveRecord.
 *
 * @package default
 * @author Michael Girouard
 **/
class Panda_ActiveRecord_Exception 
extends Exception
{
    const INVALID_MODEL_NAME = 'Invalid model name. Model are alpha-numeric only [a-zA-Z0-9].';
}

?>