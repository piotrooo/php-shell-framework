PHP Shell Framework
===================

This framework can be used to creating fully shell scripts.

Creating new application
------------------------
To create new application, you must create a new PHP file in __app/Console__ location, name of file this should be __YourApplicationNameShell.php__.

Newly created file should have number of requirements:
* Name of class inside file should be corresponding name to file.
* Class should extends from `Shell` and implements `ShellApplicationInterface`.

So created appliaction should looks like:
```php
<?php
namespace Console;

use Psf\Interfaces\ShellApplicationInterface;
use Psf\Shell;

class HelloShell extends Shell implements ShellApplicationInterface
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

Framework implements this approach:

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

Styling output
--------------

Styling output is done by user-defined tags - like XML. Style formetter will replace XML tag to correct defined ANSI code sequence.

To declare new XML tag and corresonding with him ANSI code you do:

```php
$styleFormat = new StyleFormatter('gray', 'magenta', array('blink', 'underline'));
$this->setFormatter('special', $styleFormat);
```

This would you to allow `<special>` tag in you output messages:

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
