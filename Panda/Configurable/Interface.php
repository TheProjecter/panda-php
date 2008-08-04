<?php

/**
 * An interface for configurable objects
 *
 * @package Panda_Loader
 * @author Michael Girouard (mikeg@lovemikeg.com)
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
interface Panda_Configurable_Interface
{
    public function configure(array $configuration = array());
}