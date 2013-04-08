<?php
error_reporting(0);
define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

require_once ROOT_PATH . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Psf' . DIRECTORY_SEPARATOR . 'Loader.php';

$loader = new \Psf\Loader();
$loader
    ->setIncludePath('app/')
    ->setIncludePath('lib/')
    ->register();

\Psf\Dispatcher::runScript($argv);