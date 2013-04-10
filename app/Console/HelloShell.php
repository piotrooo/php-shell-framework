<?php
/**
 * HelloShell
 *
 * @author Piotrooo
 */
namespace Console;

use Psf\Input\DefinedInputException;
use Psf\Interfaces\ShellApplicationInterface;
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
        $this->out("Hello !!!");

        $name = $this->_getParameterWrapper('N');
        if (isset($name)) {
            $this->out($name);
        }

        $this->out("Type how old are you: ", 0);
        $age = $this->read();
        if (!empty($age)) {
            $this->out('You have ' . $age . ' years old - nice!');
        }
    }

    private function _getParameterWrapper($parameterName)
    {
        try {
            return $this->getParameterValue($parameterName);
        } catch (DefinedInputException $e) {
            $this->err($e->getMessage());
        }
    }
}