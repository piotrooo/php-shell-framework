<?php
/**
 * Dispatcher
 *
 * @author Piotrooo
 */
namespace Psf;

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
        print_r($this->_userPassedArgv);
    }
}