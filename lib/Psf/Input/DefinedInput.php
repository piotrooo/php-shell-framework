<?php
/**
 * DefinedInput
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Input;

class DefinedInput
{
    const VALUE_NONE = 1;
    const VALUE_REQUIRED = 2;
    const VALUE_OPTIONAL = 3;

    private $_applicationName;
    private $_shortName;
    private $_longName;

    public function __construct($applicationName)
    {
        $this->_applicationName = $applicationName;
    }

    public function addParameter($shortName, $longName)
    {
        $this->_shortName = $shortName;
        $this->_longName = $longName;
    }

    public function isFitAnyParameter($parameterName)
    {
        switch ($parameterName) {
            case $this->_longName:
            case $this->_shortName:
            {
                return true;
            }
                break;
        }
        return false;
    }

    public function getOppositeParameter($actualParameter)
    {
        if ($actualParameter == $this->_longName) {
            return $this->_shortName;
        } else {
            return $this->_longName;
        }
    }
}

class DefinedInputException extends \Exception
{
}