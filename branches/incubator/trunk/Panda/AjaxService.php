<?php

class Panda_AjaxService
{
	private $name;
	private $jsName;
	private $properties = array();
	private $methods = array();
	private $serviceTemplate;

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
		$template = str_replace('NAME', $this->jsName, $template);
		$template = str_replace('SERVICE', $this->name, $template);
		$template = str_replace('/* Service Definition */', "\n$serviceDefinition\n\t", $template);

		return $template;
	}

	public function setProperty($name, $value)
	{
		$this->properties[$name] = $value;
	}

	public function unsetProperty($name)
	{
		unset($this->properties[$name]);
	}

	public function addMethod($name, array $params = array())
	{
		$this->methods[$name] = $params;
	}

	public function removeMethod($name)
	{
		if ($key = array_search($name, $this->methods)) {
			unset($this->methods[$key]);
		}
	}

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

	private function renderAllProperties()
	{
		$out = array();

		foreach ($this->properties as $property => $value) {
			$out[] = "\t\t'$property' : $value";
		}

		return implode(",\n", $out);
	}

	private function renderAllMethods()
	{
		$out = array();

		foreach ($this->methods as $name => $params) {
			$out[] = $this->renderMethod($name, $params);
		}

		return implode(",\n", $out);
	}

	private function renderMethod($name, $params)
	{
		return sprintf(
			"\n\t\t'$name' : function (%s) {\n\t\t\t%s\n\t\t}",
			implode(', ', $this->methods[$name]),
			$this->renderMethodBody($name)
		);
	}

	private function renderMethodBody($name)
	{
		return "sendRequest('$name', arguments);";
	}
}