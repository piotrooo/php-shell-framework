<?php
/**
 * Dispatcher
 *
 * @author Piotrooo
 */
namespace Psf;

class Dispatcher 
{
    static public function runScript()
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
}