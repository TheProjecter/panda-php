<?php

/**
 * Creates a new Ajax Service from PHP Classes
 *
 * @package Panda
 * @author Michael Girouard (mikeg@lovemikeg.com)
 * @license The New BSD License (http://pandaphp.org/license.html)
 */
class Panda_AjaxService
{
    /**
     * The class name to use as the service
     *
     * @var string
     */
	private $name;

	/**
	 * The name of the JavaScript object
	 *
	 * @var string
	 */
	private $jsName;

	/**
	 * A list of all public properties for the service
	 *
	 * @var array
	 */
	private $properties = array();

	/**
	 * A list of all public methods for the service
	 *
	 * @var array
	 */
	private $methods = array();

	/**
	 * The template JavaScript document used by the service
	 *
	 * @var string
	 */
	private $serviceTemplate;

	/**
	 * Constructs a new Ajax Service
	 *
	 * @param string $name
	 * @param string $jsName
	 */
	public function __construct($name, $jsName = false)
	{
		$this->name = $name;

		if ($jsName) {
			$this->jsName = $jsName;
		}
		else {
			$this->jsName = $name;
		}

		$this->captureClassMethods($name);
	}

	/**
	 * Object to string converter
	 *
	 * @return string
	 */
	public function __toString()
	{
		$serviceDefinition = '';
		$methods = $this->renderAllMethods();
		$properties = $this->renderAllProperties();

		if (!empty($properties)) {
			$serviceDefinition = "$properties,\n";
		}

		$serviceDefinition .= $methods;

		$template = $this->getServiceTemplate();

		return sprintf(
		    $template,
		    $this->jsName,
		    $this->name,
		    $this->jsName,
		    $serviceDefinition
		);
	}

	/**
	 * Sets a property in the service
	 *
	 * @param string $name
	 * @param s $value
	 */
	public function setProperty($name, $value)
	{
		$this->properties[$name] = $value;
	}

	/**
	 * Unsets a property in the service
	 *
	 * @param unknown_type $name
	 */
	public function unsetProperty($name)
	{
		unset($this->properties[$name]);
	}

	/**
	 * Adds a method to the service
	 *
	 * @param string $name
	 * @param array $params
	 */
	public function addMethod($name, array $params = array())
	{
		$this->methods[$name] = $params;
	}

	/**
	 * Removes a method from the service
	 *
	 * @param string $name
	 */
	public function removeMethod($name)
	{
		if ($key = array_search($name, $this->methods)) {
			unset($this->methods[$key]);
		}
	}

	/**
	 * Captures all class methods via reflection
	 *
	 * @param string $className
	 * @param boolean $autoload
	 */
	public function captureClassMethods($className, $autoload = true)
	{
		if (class_exists($className, $autoload)) {
			$class = new ReflectionClass($className);
			$methods = $class->getMethods();

			foreach ($methods as $method) {
				$params = array();

				if ($method->isPublic()) {
					$methodParams = $method->getParameters();

					foreach ($methodParams as $param) {
						$params[] = $param->name;
					}
				}

				$this->addMethod($method->name, $params);
			}
		}
	}

	/**
	 * Returns the current service template, lazy-loading if necessary
	 *
	 * @return string
	 */
	private function getServiceTemplate()
	{
		if (empty($this->serviceTemplate)) {
			$fileName = sprintf(
				'%s%sAjaxService%stemplates%sservice.js',
				dirname(__FILE__),
				DIRECTORY_SEPARATOR,
				DIRECTORY_SEPARATOR,
				DIRECTORY_SEPARATOR
			);

			$this->serviceTemplate = file_get_contents($fileName);
		}

		return $this->serviceTemplate;
	}

	/**
	 * Renders all properties in the service
	 *
	 * @return string
	 */
	private function renderAllProperties()
	{
		$out = array();

		foreach ($this->properties as $property => $value) {
			$out[] = "\t\t'$property' : $value";
		}

		return implode(",\n", $out);
	}

	/**
	 * Renders all methods in the service
	 *
	 * @return string
	 */
	private function renderAllMethods()
	{
		$out = array();

		foreach ($this->methods as $name => $params) {
			$out[] = $this->renderMethod($name, $params);
		}

		return implode(",\n", $out);
	}

	/**
	 * Renders a service method
	 *
	 * @param string $name
	 * @param array $params
	 * @return string
	 */
	private function renderMethod($name, $params)
	{
		return sprintf(
			"\n\t\t'$name' : function (%s) {\n\t\t\t%s\n\t\t}",
			implode(', ', $this->methods[$name]),
			$this->renderMethodBody($name)
		);
	}

	/**
	 * Renders the body of a method
	 *
	 * @param string $name
	 * @return string
	 * @todo This should be abstracted into a separate class
	 */
	private function renderMethodBody($name)
	{
		return "sendRequest('$name', arguments);";
	}
}