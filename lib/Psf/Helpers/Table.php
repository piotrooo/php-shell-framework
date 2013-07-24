<?php
/**
 * TableHelper
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Helpers;

use Psf\Interfaces\HelperInterface;
use Psf\Output\Writer;

class Table implements HelperInterface
{
    public function setHeaders(array $headers)
    {
        return $this;
    }

    public function render(Writer $output)
    {
    }
}