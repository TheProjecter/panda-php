# Faux Namespaces #

Versions of PHP prior to 5.3 do not support true namespaces. As a work-around, PHP developers have used underscores as a way of simulating namespaces. This process has become an industry-wide common practice and has been adopted by groups such as [PEAR](http://pear.php.net/) and and [Solar PHP](http://solarphp.org/).

## Package Management with Faux Namespaces ##

Part of the reason why the overly verbose technique of simulating namespaces with underscores is so popular is because of its flexibility. If the directory structure of an application is standardized into a package-like system, source code can be loaded easily by replacing the underscores with a directory separator.

```
function loadClass($className)
{
    require_once str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';
}
```

Similarly, class names can be generated from paths:

```
function getClassName($path)
{
    $search = array(DIRECTORY_SEPARATOR, '.php');
    $replace = array('_', '');
    
    return str_replace($search, $replace, $path);
}
```