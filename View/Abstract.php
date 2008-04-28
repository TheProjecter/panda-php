<?php 

require_once 'Panda/View/Interface.php';

/**
 * A base class for views
 *
 * @package Panda_View
 * @author  Michael Girouard (mikeg@lovemikeg.com)
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
abstract class Panda_View_Abstract
implements Panda_View_Interface
{
    /**
     * Data for the view
     *
     * @var array
     */
    protected $data = array();
    
    /**
     * Whether or not to echo the rendered output
     *
     * @var unknown_type
     */
    protected $echoOutput = true;

    /**
     * Gets a view variable by its name
     * 
     * If the variable does not exist, a null value is returned. No warning is 
     * issued.
     *
     * @param string $name The name of the view variable
     * @return mixed
     */
    public function getVar($name)
    {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }
        else {
            return null;
        }
    }

    /**
     * Sets a view variable by its name and value
     *
     * @param  string $name The name of the view variable
     * @param  mixed $value The value of the view variable
     * @return mixed The value of the newly set view variable
     */
    public function setVar($name, $value)
    {
        return $this->data[$name] = $value;
    }

    /**
     * Unsets a view variable
     *
     * @param string $name
     */
    public function unsetVar($name)
    {
        if (array_key_exists($name, $this->data)) {
            unset($this->data[$name]);
        }
    }
    
    /**
     * Gets all view data
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }
    
    /**
     * Sets many view variables at once
     *
     * @param  array $data
     * @return array The newly set data array
     */
    public function setData(array $data)
    {
        $this->data = $data;
    }
    
    /**
     * Toggles between verbose mode and silent mode
     * 
     * Verbose mode will render directly to the output (browser, console, 
     * etc), whereas silent mode will not. In either case, the return value 
     * will always be a string representation of the view.
     *
     * @param boolean $bool True if verbose output is desired. False otherwise.
     */
    public function setEchoOutput($bool)
    {
        $this->echoOutput = (bool)$bool;
    }
    
    /**
     * Output the contents of the view
     * 
     * All render() implementations should call this method in order to render
     * the view properly.
     *
     * @param string $output
     * @return string
     */
    public function output($output)
    {
        if ($this->echoOutput) {
            echo $output;
        }
        
        return $output;
    }
}