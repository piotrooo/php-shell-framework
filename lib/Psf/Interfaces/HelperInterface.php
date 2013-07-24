<?php
/**
 * HelperInterface
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Interfaces;

use Psf\Output\Writer;

interface HelperInterface
{
    public function render(Writer $output);
}