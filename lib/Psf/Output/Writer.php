<?php
/**
 * ShellWriter
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Output;

class Writer
{
    const STREAM_STDOUT = 'php://stdout';
    const STREAM_STDERR = 'php://stderr';
    const VERBOSITY_QUIET = 0;
    const VERBOSITY_NORMAL = 1;
    const VERBOSITY_VERBOSE = 2;
    
    private $_streamHandle;

    public function __construct($stream = self::STREAM_STDOUT)
    {
        $this->_streamHandle = fopen($stream, 'w');
    }

    public function writeMessage($message, $numberOfNewLines = 1, $verbosityLevel = self::VERBOSITY_NORMAL)
    {
        $messageWithNewLines = $message . str_repeat(PHP_EOL, $numberOfNewLines);
        fwrite($this->_streamHandle, $messageWithNewLines);
    }

    public function __destruct()
    {
        fclose($this->_streamHandle);
    }
}