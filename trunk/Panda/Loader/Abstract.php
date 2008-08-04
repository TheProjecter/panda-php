<?php

require_once 'Panda/Loader/Interface.php';
require_once 'Panda/Configurable/Interface.php';

/**
 * A generic source code loader
 *
 * @package Panda_Loader
 * @author Michael Girouard (mikeg@lovemikeg.com)
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class Panda_Loader_Abstract
implements Panda_Loader_Interface,
           Panda_Configurable_Interface
{
    /**
     * The namespace to use while loading source
     *
     * @var string
     */
    protected $namespace;

    /**
     * The base directory
     *
     * @var string
     */
    protected $baseDir;

    /**
     * Configures the loader
     *
     * Configurable values are: <br />
     * 	[namespace] string The namespace to use <br />
     * 	[baseDir] string The base directory to use <br />
     * 	[load] string|array A class or array of classes to automatically load <br />
     *
     * @param array $configuration
     */
    public function configure(array $configuration = array())
    {
        if (array_key_exists('namespace', $configuration)) {
            $this->setNamespace($configuration['namespace']);
        }

        if (array_key_exists('baseDir', $configuration)) {
            $this->setBaseDir($configuration['baseDir']);
        }

        if (array_key_exists('load', $configuration)) {
            if (is_string($configuration['load'])) {
                $this->load($configuration['load']);
            }
            elseif (is_array($configuration['load'])) {
                foreach ($configuration['load'] as $className) {
                    $this->load($className);
                }
            }
        }
    }

    /**
     * Returns the current namespace
     *
     * @return string
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Sets the namespace
     *
     * @param string $namespace
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    }

    /**
     * Returns the base directory to load from
     *
     * @return string
     */
    public function getBaseDir()
    {
        return $this->baseDir;
    }

    /**
     * Sets the base directory to load from
     *
     * @param string $baseDir
     */
    public function setBaseDir($baseDir)
    {
        $this->baseDir = $baseDir;
    }

    /**
     * Returns a fully namespaced class name
     *
     * @param string $className
     * @return string
     */
    public function getClassName($className)
    {
        // If it's already namespaced, just return it back out
        if (preg_match("/^(Panda|$this->namespace)/i", $className)) {
            return $className;
        }

        return sprintf('%s_%s', $this->namespace, $className);
    }

    /**
     * Returns a full path and file name of the given class
     *
     * @param string $className
     * @return string
     */
    public function getFileName($className)
    {
        $className = $this->getClassName($className);

        return sprintf('%s%s%s.php',
            $this->baseDir,
            DIRECTORY_SEPARATOR,
            str_replace('_', DIRECTORY_SEPARATOR, $className)
        );
    }

    /**
     * Loads a class file in from a class name
     *
     * @param string $className
     * @return boolean True if the file was loaded, false otherwise.
     */
    public function load($className)
    {
        $fileName = $this->getFileName($className);

        if (is_file($fileName)) {
            require_once $fileName;
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Loads a class file and returns an instance from the provided class name
     *
     * @param string $className
     * @param array $parameters
     * @param object The instance of the class
     */
    public function loadInstance($className, array $parameters = array())
    {
        if ($this->load($className)) {
            $Class = new ReflectionClass( $this->getClassName($className) );

            if ($Class->hasMethod('__construct')) {
                return $Class->newInstanceArgs($parameters);
            }
            else {
                return $Class->newInstance();
            }
        }
    }
}