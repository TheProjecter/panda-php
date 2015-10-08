# The ActiveRecord Design Pattern #

## Introduction ##

ActiveRecord is a design pattern that provides an object-oriented wrapper around a single database record. This makes common tasks such as inserting, updating, and deleting as easy as calling a method on an object.

## Common Implementations ##

Implementations vary as almost all programmers interpret the pattern differently. A very common interface would be the following:

```
<?php

interface Example_ActiveRecord_Interface
{
    function read();
    function save();
    function delete();
}

?>
```

## External Links ##

  * [Wikipedia's ActiveRecord Entry](http://www.wikipedia.org/wiki/ActiveRecord)
  * [Martin Fowler's Explanation](http://www.martinfowler.com/eaaCatalog/activeRecord.html)
  * [Nuno Mariz's Implementation](http://nmariz.estadias.com/archives/31) ([UML](http://nmariz.estadias.com/files/images/activerecord_part_1.gif))
  * [Ruby on Rails' Implementation](http://wiki.rubyonrails.org/rails/pages/ActiveRecord)
  * [CakePHP's Implementation](http://manual.cakephp.org/chapter/models)