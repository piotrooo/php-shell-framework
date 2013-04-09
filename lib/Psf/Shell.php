<?php
/**
 * Shell
 *
 * @author Piotr Olaszewski
 */
namespace Psf;

use Psf\Input\DefinedInput;
use Psf\Input\DefinedInputException;
use Psf\Output\Writer;

class Shell
{
    public $parsedArgv;
    private $_stdout;
    private $_stderr;
    private $_userDefinedInput = array();
    private $_applicationName;

    public function __construct($applicationName, $parsedArgv)
    {
        $this->_applicationName = $applicationName;
        $this->parsedArgv = $parsedArgv;

        $this->_stdout = new Writer(Writer::STREAM_STDOUT);
        $this->_stderr = new Writer(Writer::STREAM_STDERR);
    }

    public function out($message, $numberOfNewLines = 1, $verbosityLevel = Writer::VERBOSITY_NORMAL)
    {
        $this->_stdout->writeMessage($message, $numberOfNewLines, $verbosityLevel);
    }

    public function err($message, $numberOfNewLines = 1, $verbosityLevel = Writer::VERBOSITY_NORMAL)
    {
        $this->_stderr->writeMessage($message, $numberOfNewLines, $verbosityLevel);
    }

    public function addParameter($shortName, $longName)
    {
        $definedInput = new DefinedInput($this->_applicationName);
        $definedInput->addParameter($shortName, $longName);

        $this->_userDefinedInput[] = $definedInput;

        return $this;
    }

    public function getParameterValue($parameterName)
    {
        $returnValue = null;
        foreach ($this->parsedArgv as $singleNameParameter => $singlevalueParameter) {
            if ($this->_isParameterFitUserDefined($singleNameParameter)) {
                $returnValue = $singlevalueParameter;
            }
        }

        if ($returnValue === null) {
            throw new DefinedInputException("No defined parameter");
        }

        return $returnValue;
    }

    private function _isParameterFitUserDefined($parameterName)
    {
        foreach ($this->_userDefinedInput as $singleUserDefinedInput) {
            if ($singleUserDefinedInput->isFitAnyParameter($parameterName)) {
                return true;
            }
        }
        return false;
    }
}