# Panda Date #

`Panda_Date` is a utility class for simple date manipulation and comparison.

On this wiki page, you can read up on how to [get started](#Getting_Started.md) using the `Panda_Date` class, how to class constants to offset time, and also how to compare dates against each other. An [overview](#API.md) and [detailed documentation](http://docs.pandaphp.org/class_panda___date.html) is available for developers who just want to see its guts.

## Getting Started ##

The easiest way to get started with `Panda_Date` is to create a new instance of the class and then echo its contents to the browser.

```
$rightNow = new Panda_Date;

echo $rightNow;
```

This should display something like: `2008-09-02 22:41:15`. By default, `Panda_Date` formats dates in a `YYYY-MM-DD HH:MM:SS` format. You can change this at any time by calling the `set()` method. If you prefer, you can pass your preferred format directly to the constructor.

```
// Change the format for $rightNow to only show Year/Month/Day
$rightNow->setFormat('Y/m/d');

echo $rightNow;

// This should be the same thing
echo new Panda_Date('today', 'Y/m/d');
```

As you can see, you have the ability to specify dates to the constructor such as `'today'`, `'yesterday'` or `'3 weeks ago'`. This power comes from PHP's [strtotime()](http://www.php.net/strtotime) function which converts most english date/time string into a Unix timestamp.

## Offsetting Time ##

While working with dates, it's a common task to need to offset a specific date by a full day, week, year, etc. Fortunately `Panda_Date` has several useful constants which simplify things greatly.

Constants exist for `MINUTE`, `HOUR`, `DAY`, `WEEK`, `MONTH`, and `YEAR`; each of which are measured in seconds. `MONTH` is of course averaged since the days can vary from month-to-month.

```
$today = new Panda_Date;
```

## Comparing Dates ##

## API ##

The following list of methods defines the public API.

  * `set(mixed $date)`: Sets the date to any valid [strtotime()](http://www.php.net/strtotime) format.
  * `offset(int $offset)`: Offsets the date by the provided offset (in seconds).
  * `setFormat(string $format)`: Sets the date format to any valid [date()](http://www.php.net/date) format.
  * `isLessThan(mixed $date)`: Compares the date with the supplied date. Returns true if the date is less than the supplied date.
  * `isGreaterThan(mixed $date)`: Compares the date with the supplied date. Returns true if the date is greater than the supplied date.