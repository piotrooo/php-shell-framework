<?php
/**
 * ArgvParser
 *
 * @author Piotr Olaszewski
 *
 * @link http://www.gnu.org/software/libc/manual/html_node/Argument-Syntax.html
 * @link http://pubs.opengroup.org/onlinepubs/009695399/basedefs/xbd_chap12.html
 */
namespace Psf\Input;

class ArgvParser
{
    private $_userPassedParams;
    private $_parsedParametersList = array();
    private $_currentApplicationName;
    private $_currentParameter;

    public function __construct($paramsToParse)
    {
        $this->_userPassedParams = $paramsToParse;
    }

    public function getParsedParameters()
    {
        return $this->_parsedParametersList;
    }

    public function parseParameters()
    {
        foreach ($this->_userPassedParams as $singleParameter) {
            $this->_detectParameterType($singleParameter);
        }
        return $this;
    }

    private function _detectParameterType($parameter)
    {
        if (preg_match('/^app:(.+)/', $parameter, $groupParameter)) {
            $this->_currentApplicationName = $groupParameter[1];
            $this->_parsedParametersList[$this->_currentApplicationName] = array();
        } else if (preg_match('/^-{1,2}(.+)/', $parameter, $groupParameter)) {
            $checkAndParseShortParameters = $this->_parseShortParameter($parameter);

            if (!empty($checkAndParseShortParameters)) {
                $parseParameter = $checkAndParseShortParameters;
            } else {
                $parseParameter = $this->_getExplodeValueIfEqualSign($groupParameter[1]);
            }

            $parameterName = $parseParameter['parameter'];
            $parameterValue = $parseParameter['value'];

            $this->_currentParameter = $parameterName;
            $this->_parsedParametersList[$this->_currentApplicationName][$this->_currentParameter] = $parameterValue;
        } else if (!preg_match('/psf.php/', $parameter)) {
            $this->_parsedParametersList[$this->_currentApplicationName][$this->_currentParameter] = $parameter;
        }
    }

    private function _parseShortParameter($parameter)
    {
        if (preg_match('/^-{1,1}([^-])([^=].*)/', $parameter, $groupParameter)) {
            return array('parameter' => $groupParameter[1], 'value' => $groupParameter[2]);
        }
        return array();
    }

    private function _getExplodeValueIfEqualSign($parameter)
    {
        if (strpos($parameter, '=')) {
            $parameterParts = explode('=', $parameter);
            return array('parameter' => $parameterParts[0], 'value' => $parameterParts[1]);
        } else {
            return array('parameter' => $parameter, 'value' => '');
        }
    }
}