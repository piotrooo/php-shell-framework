PHP Shell Framework
===================

This framework can be used to creating fully shell scripts.

Configuration
-------------
* Copy `/path/to/php-shell-framework/config/psf.config.php` to your code base location `/path/to/application/psf.config.php` and set `application_dirs` to corresponding console applications.
* Inside application dir create catalog `Console` which contains shell apps.

Creating new application
------------------------
To create new application, you must create a new PHP file in __your_name_path/Console__ location, name of file this should be __YourApplicationNameShell.php__.

Newly created file should have number of requirements:
* Name of class inside file should be corresponding name to file.
* Class should extends from `Shell` and implements `ApplicationInterface`.

So created appliaction should looks like:
```php
<?php
namespace Console;

use Psf\Interfaces\ShellApplicationInterface;
use Psf\Shell;

class HelloShell extends Shell implements ApplicationInterface
{
    public function configure()
    {
    }

    public function main()
    {
      $this->out("Hello world");
    }
}
?>
```

Running application
-------------------

After create application, we want run it from our console. 

### Basicly call from shell
    $ php psf.php app:hello

Constraint `app` determines which application should be called. After this call, our application print - by use `out` method - on `STDOUT` string __Hello world__.

### Calling with arguments
    $ php psf.php app:hello -N --user=Piotr
    
Application can accept short and long types of parameters.

PHP Shell Framework implements this approach:

[http://www.gnu.org/software/libc/manual/html_node/Argument-Syntax.html](http://www.gnu.org/software/libc/manual/html_node/Argument-Syntax.html)

[http://pubs.opengroup.org/onlinepubs/009695399/basedefs/xbd_chap12.html](http://pubs.opengroup.org/onlinepubs/009695399/basedefs/xbd_chap12.html)

Possible combinations:

* `-n` *short parameter without argument, return true*
* `-n hello` *short parameter with argument, space separed, return hello*
* `-nhello` *short parameter with argument, no space separed, return hello*
* `--user` *long parameter without argument, return true*
* `--user=Piotr` *long parameter with argument, equal sign separed, return Piotr*

To add support to parameters in application in method `configure`, we must set parameters of each parameter.

```php
public function configure()
{
    $this
        ->addParameter('N', 'namespace')
        ->addParameter('u', 'user');
}
```

This configuration allows us to many possibilities call our parameters.

This call:

    $ php psf.php app:hello -N php/\shell/\output

is corresponding to:

    $ php psf.php app:hello --namespace php/\shell/\output

In `main` method we get parameter like this:

    $namespace = $this->getParameterValue('namespace');

this getter working on `-N` and `--namespace` parameter equally.

__Special case.__ If we call application like that:

    $ php psf.php app:hello -N php/\shell/\output --namespace php/\formatter
    
The `getParameterValue` method will return `php/formatter`.

Output
------

When you want display someting on `STDOUT` you can use `out` method:

```php
$this->out("Hello World Today!!!");
```

print:

```
Hello World Today!!!
```

You can aslo defined how many new lines should be after output message:

```php
$this->out("Hello World Today!!!", 5);
```

print:

```
Hello World Today!!!




```
### Console output levels

Sometimes you need different levels of verbosity. PHP Shell Framework provide three levels:

1. QUIET
2. NORMAL
3. VERBOSE

Default all outputs working in `NORMAL` level. If you want change level you must define this in `out` method.

__Example:__

```php
$this->out('This message is in normal verbosity');
$this->out('This message is in quiet verbosity', 1, Writer::VERBOSITY_QUIET);
$this->out('This message is in verbose verbosity', 1, Writer::VERBOSITY_VERBOSE);
```

If you want run application in `NORMAL` level:

    $ php psf.php app:hello

output:

    This message is in normal verbosity
    This message is in quiet verbosity

If you want run application in `QUIET` level:

    $ php psf.php app:hello --quiet

output:

    This message is in quiet verbosity
    
If you want run application in `VERBOSE` level:

    $ php psf.php app:hello --verbose
    
output:

    This message is in normal verbosity
    This message is in quiet verbosity
    This message is in verbose verbosity

Styling output
--------------

Styling output is done by user-defined tags - like XML. PHP Shell Framework using style formetter will replace XML tag to correct defined ANSI code sequence.

To declare new XML tag and corresonding with him ANSI code you do:

```php
$styleFormat = new StyleFormatter('gray', 'magenta', array('blink', 'underline'));
$this->setFormatter('special', $styleFormat);
```

This would you to allow `<special>` tag in you output messages and will set text color to `gray`, background color to `magenta` and have two effects - `blink` and `underline`.

```php
$this->out("<special>Hello</special> orld <special>Today</special>!!!");
```

You can use following color for text attributes:

* black
* red
* green
* brown
* blue
* magenta
* cyan
* gray

For background color use:

* black
* red
* green
* brown
* blue
* magenta
* cyan
* white

Also you can use following effects:

* defaults
* bold
* underline
* blink
* reverse
* conceal

Reading
-------

Method `read` reads and interprest characters from `STDIN`, which usually recives what the user type at the keyboard.

Usage of `read`:

```php
$this->out("Type how old are you: ", 0);
$age = $this->read();
if (!empty($age)) {
    $this->out('You have ' . $age . ' years old - nice!');
}
```

This piece of code wait unit user type something on keyboard.

Helpers
-------

In framework we can use helpers to generate some views.

### Table
Table is simple helper which generate tabular data.

Usage of `table`:

```php
$table = $this->getHelper('Table');
$table
    ->setHeaders(array('ID', 'Name', 'Surname'))
    ->setRows(array(
        array('1', 'John', 'Smith'),
        array('2', 'Brad', 'Pitt'),
        array('3', 'Denzel', 'Washington'),
        array('4', 'Angelina', 'Jolie')
    ));
$table->render($this->getStdout());
```

will generate:

    +----+----------+------------+
    | ID | Name     | Surname    |
    +----+----------+------------+
    | 1  | John     | Smith      |
    | 2  | Brad     | Pitt       |
    | 3  | Denzel   | Washington |
    | 4  | Angelina | Jolie      |
    +----+----------+------------+

Additionaly we can add single row to our table by using `addRow` method:

```php
$table->addRow(array('5', 'Peter', 'Nosurname'));
```

will produce:

    +----+----------+------------+
    | ID | Name     | Surname    |
    +----+----------+------------+
    | 1  | John     | Smith      |
    | 2  | Brad     | Pitt       |
    | 3  | Denzel   | Washington |
    | 4  | Angelina | Jolie      |
    | 5  | Peter    | Nosurname  |
    +----+----------+------------+

### Progress bar
This helper provide progress functionality.

Usage of `progress bar`:
```php
$progress = $this->getHelper('ProgressBar');
$progress->initialize($this->getStdout(), 9);
for ($i = 0; $i < 9; $i++) {
    $progress->increment();
    sleep(1);
}
```

will produce:

    4/9 (44%) [======================............................]
    
### Loader
Loader helper get possibility of display loader pseudo animation.

Usage of `loader`:
```php
$loader = $this->getHelper('Loader');
$loader->initialize($this->getStdout());
for ($i = 0; $i < 10; $i++) {
    $loader->start();
    sleep(1);
}
```

Also we can customizing loader through setting display char sequence by method `setCharSequence`:
```php
$loader->setCharSequence(array('.', '..', '...'));
```
