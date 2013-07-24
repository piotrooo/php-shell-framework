<?php
/**
 * ApplicationInterface
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Interfaces;

interface ApplicationInterface
{
    public function configure();
    public function main();
}