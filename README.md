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
