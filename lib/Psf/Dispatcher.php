<?php
/**
 * Dispatcher
 *
 * @author Piotr Olaszewski
 */
namespace Psf;

use Psf\Input\ArgvParser;

class Dispatcher
{
    private $_userPassedArgv = array();

    static public function runScript($argv)
    {
        $dispatcher = new Dispatcher($argv);
        $dispatcher->dispatch();
    }

    public function __construct($argv)
    {
        $this->_userPassedArgv = $argv;
    }

    public function dispatch()
    {
        $parsedArgv = $this->getParseInputArgv();
        foreach ($parsedArgv as $applicationName => $applicationParameters) {
            $this->_callApplication($applicationName, $applicationParameters);
        }
    }

    private function _callApplication($applicationName, $applicationParameters)
    {
        $preparedApplicationName = '\Console\\' . ucfirst($applicationName) . 'Shell';
        $application = new $preparedApplicationName($applicationName, $applicationParameters);
        $application->configure();
        $application->main();
    }

    public function getParseInputArgv(array $argv = array())
    {
        $paramsToParse = (!empty($argv) ? $argv : $this->_userPassedArgv);
        $argvParsed = new ArgvParser($paramsToParse);
        $argvParsed->parseParameters();
        return $argvParsed->getParsedParameters();
    }
}