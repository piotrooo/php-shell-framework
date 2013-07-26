#!/usr/bin/env php
<?php
error_reporting(E_ALL);
$isComposer = true;

use Psf\Dispatcher;
use Psf\Loader;

define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

if ($isComposer) {
    define('APPLICATION_PATH', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
    /** @noinspection PhpIncludeInspection */
    $psfConfig = require_once APPLICATION_PATH . 'psf.conf.php';
} else {
    define('APPLICATION_PATH', __DIR__ . DIRECTORY_SEPARATOR);
    /** @noinspection PhpIncludeInspection */
    $psfConfig = require_once APPLICATION_PATH . 'config/psf.conf.php';
}

/** @noinspection PhpIncludeInspection */
require_once ROOT_PATH . 'lib' . DIRECTORY_SEPARATOR . 'Psf' . DIRECTORY_SEPARATOR . 'Loader.php';

$loader = new Loader();
$loader
    ->setIncludePath($psfConfig['application-dirs'])
    ->setIncludePath(ROOT_PATH . 'lib/')
    ->register();

Dispatcher::runScript($argv);