<?php
/**
 * Shell
 *
 * @author Piotr Olaszewski
 */
namespace Psf;

use Psf\Input\DefinitionInput;
use Psf\Output\Writer;

class Shell
{
    private $_stdout;
    private $_userDefinedInput;

    public function __construct()
    {
        $this->_stdout = new Writer(Writer::STREAM_STDOUT);
        $this->_userDefinedInput = new DefinitionInput('hello');
    }

    public function out($message, $numberOfNewLines = 1, $verbosityLevel = Writer::VERBOSITY_NORMAL)
    {
        $this->_stdout->writeMessage($message, $numberOfNewLines, $verbosityLevel);
    }

    public function addArgument($shortName, $longName)
    {
        return $this;
    }
}