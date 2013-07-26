#!/usr/bin/env php
<?php
use Psf\Dispatcher;
use Psf\Loader;

error_reporting(E_ALL);
define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);
define('APPLICATION_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);

$psfConfig = require_once APPLICATION_PATH . 'psf.conf.php';
require_once ROOT_PATH . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Psf' . DIRECTORY_SEPARATOR . 'Loader.php';

$loader = new Loader();
$loader
    ->setIncludePath($psfConfig['application-dirs'])
    ->setIncludePath(ROOT_PATH . 'lib/')
    ->register();

Dispatcher::runScript($argv);