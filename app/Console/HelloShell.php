<?php
/**
 * HelloShell
 *
 * @author Piotrooo
 */
namespace Console;

use Psf\Input\DefinedInputException;
use Psf\Interfaces\ShellApplicationInterface;
use Psf\Output\StyleFormatter;
use Psf\Shell;

class HelloShell extends Shell implements ShellApplicationInterface
{
    public function configure()
    {
        $this
            ->addParameter('N', 'name')
            ->addParameter('u', 'user');
    }

    public function main()
    {
        $styleFormat = new StyleFormatter('gray', 'magenta');
        $this->setFormatter('special', $styleFormat);
        $styleFormat = new StyleFormatter('blue', 'white');
        $this->setFormatter('special2', $styleFormat);

        $this->out("<special>Hello</special> <special2>World</special2> <special>Today</special>!!!");

        $name = $this->_getParameterWrapper('N');
        if (isset($name)) {
            $this->out($name);
        }

        $user = $this->_getParameterWrapper('u');
        $this->out($user);

        $this->out("Type how old are you: ", 0);
        $age = $this->read();
        if (!empty($age)) {
            $styleFormat = new StyleFormatter('red', 'white');
            $this->setFormatter('info', $styleFormat);
            $this->out('You have <info>' . $age . '</info> years old - nice!');
        }
    }

    private function _getParameterWrapper($parameterName)
    {
        try {
            return $this->getParameterValue($parameterName);
        } catch (DefinedInputException $e) {
            $this->err($e->getMessage());
            return false;
        }
    }
}