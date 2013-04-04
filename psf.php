<?php
define('ROOT_PATH', realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR);

$loader = new \Psf\Loader();
$loader
    ->setIncludePath('app/')
    ->setIncludePath('lib/')
    ->register();

