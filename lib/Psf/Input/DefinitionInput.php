<?php
/**
 * DefinitionInput
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Input;


class DefinitionInput
{
    const VALUE_NONE = 1;
    const VALUE_REQUIRED = 2;
    const VALUE_OPTIONAL = 3;
    private $_applicationName;

    public function __construct($applicationName)
    {
        $this->_applicationName = $applicationName;
    }

    public function addArgument($shortName, $longName)
    {

    }
}