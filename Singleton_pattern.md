# The Singleton Design Pattern #

## Introduction ##

Singleton is a design pattern which only allows for a single instance of a class to exist. In PHP this is achieved by removing public access from a class' constructor and clone method and also by defining a static method which returns the singleton instance.

## Common Implementations ##

The following code demonstrates the most common technique for PHP Singletons.

```
class Example_Singleton
{
    /* A private, static property to contain the instance */
    private $Instance;
    
    /* Constructors must be private or protected to prevent direct 
     * instantiation */
    private function __construct()
    {}
    
    /* PHP allows for object cloning -- this can be circumvented by making the
     * clone method private or protected */
    private function __clone()
    {}
    
    /* The instance of the class is obtained via a static 'getInstance' method
     * which insures that only one instance is ever created. */
    public static function getInstance()
    {
        if (self::$Instance === null) {
            self::$Instance = new self;
        }
        
        return self::$Instance;
    }
}
```