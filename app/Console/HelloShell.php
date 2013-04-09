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