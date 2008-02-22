<?php 

/**
 * A Class Registry
 * 
 * A simple storage container for class instances. Use this when you want to 
 * make instances available across an entire project.
 *
 * @category   Utility
 * @package    Registry
 * @author     Michael Girouard <mikeg@lovemikeg.com>
 * @copyright  2007 Michael Girouard
 * @license    http://opensource.org/licenses/bsd-license.php The BSD License
 * @version    CVS: $Id:$
 * @link       http://pandaphp.org/package/Registry
 */
class Panda_Registry extends Panda_Collection 
{
    
    /**
     * The Singleton Instance
     *
     * @var Panda_Registry $Instance
     */
    private static $Instance;
    
    /**
     * Finalized Private Constructor
     */
    private final function __construct() {}
    
    /**
     * Finalized Private Cloner
     */
    private final function __clone() {}
    
    /**
     * Instance Getter
     * 
     * Grabs a registered class. If no instanceName is specified, an instance 
     * of this class is returned.
     */
    public static function getInstance($instanceName = null) 
    {
        if ($instanceName) {
            return self::$Instance->{$instanceName};
        }
        else {
            if (!self::$Instance) {
                self::$Instance = new Panda_Registry;
            }

            return self::$Instance;
        }
    }
    
}

?>