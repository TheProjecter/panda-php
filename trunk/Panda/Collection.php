<?php

/**
 * An abstract collection
 * 
 * Uses the magic __set interceptor to store values into the concrete class. 
 * This comes in handy when you want to have a storage bin containing members 
 * of all the same type: simply override this __set and typehint the value;
 *
 * @category   Utility
 * @package    Collection
 * @author     Michael Girouard <mikeg@lovemikeg.com>
 * @copyright  2007 Michael Girouard
 * @license    http://opensource.org/licenses/bsd-license.php The BSD License
 * @version    CVS: $Id:$
 * @link       http://pandaphp.org/package/Collection
 */
abstract class Panda_Collection {
    
    /**
     * The __set Interceptor
     * 
     * This is called automatically when an undefined class property is set.
     *
     * @param string $key
     * @param mixed $value
     **/
    public function __set($key, $value) {
        $this->{$key} = $value;
    }
    
}

?>