<?php
/**
 * Dispatcher
 *
 * @author Piotrooo
 */
namespace Psf;

class Dispatcher 
{
    static public function runScript($argv)
    {
        $dispatcher = new Dispatcher();
        $dispatcher->dispatch();
    }

    public function __construct()
    {

    }

    public function dispatch()
    {

    }

    public function parseArgumnet()
    {

    }
}