<?php
/**
 * Helper
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Helpers;

use Exception;

class Helper
{
    public static function loadHelper($helperName)
    {
        $helperClassName = '\Psf\Helpers\\' . $helperName;
        if (class_exists($helperClassName)) {
            return new $helperClassName();
        }
        throw new HelperException("Couldn't load helper [$helperName], please check is exists.");
    }
}

class HelperException extends Exception
{
}