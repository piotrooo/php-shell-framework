<?php
/**
 * HelloShell
 *
 * @author Piotr Olaszewski
 */
namespace Console;

use Psf\Interfaces\ApplicationInterface;
use Psf\Output\StyleFormatter;
use Psf\Output\Writer;
use Psf\Shell;

class HelloShell extends Shell implements ApplicationInterface
{
    public function configure()
    {
    }

    public function main()
    {
        $styleFormat = new StyleFormatter('gray', 'magenta', array('blink', 'underline'));
        $this->setFormatter('special', $styleFormat);
        $styleFormat = new StyleFormatter('', 'white', array('bold'));
        $this->setFormatter('special2', $styleFormat);

        $this->out("<special>Hello</special> <special2> World </special2> <special>Today</special>!!!");

        $this->out('This message is in normal verbosity');
        $this->out('This message is in quiet verbosity', 1, Writer::VERBOSITY_QUIET);
        $this->out('This message is in verbose verbosity', 1, Writer::VERBOSITY_VERBOSE);

        $this->out("Type how old are you: ", 0);
        $age = $this->read();
        if (!empty($age)) {
            $styleFormat = new StyleFormatter('red', 'white');
            $this->setFormatter('info', $styleFormat);
            $this->out('You have <info>' . $age . '</info> years old - nice!');
        }
    }
}