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

### Basicly call from shell:
    $ php psf.php app:hello

Constraint `app` determines which application should be called.
