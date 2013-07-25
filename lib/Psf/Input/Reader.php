<?php
/**
 * Reader
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Input;

class Reader
{
    const STREAM_READ = 'php://stdin';

    private $_streamHandle;

    public function __construct($stream = self::STREAM_READ)
    {
        $this->_streamHandle = fopen($stream, 'r');
    }

    public function getReadedValue()
    {
        return trim(fgets($this->_streamHandle));
    }

    public function __destruct()
    {
        fclose($this->_streamHandle);
    }
}