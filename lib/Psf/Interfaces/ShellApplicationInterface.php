<?php
/**
 * ShellApplicationInterface
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Interfaces;

interface ShellApplicationInterface
{
    public function configure();

    public function main();
}