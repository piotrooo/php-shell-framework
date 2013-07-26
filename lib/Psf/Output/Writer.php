<?php
/**
 * Writer
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Output;

use Psf\XmlParser;

class Writer
{
    const STREAM_STDOUT = 'php://stdout';
    const STREAM_STDERR = 'php://stderr';
    const VERBOSITY_QUIET = 0;
    const VERBOSITY_NORMAL = 1;
    const VERBOSITY_VERBOSE = 2;
    const LF = PHP_EOL;
    const CR = "\r";

    private $_streamHandle;
    private $_formatters = array();
    private $_currentVerbosity = self::VERBOSITY_NORMAL;
    private $_applicationVerbosity = self::VERBOSITY_NORMAL;

    public function __construct($stream = self::STREAM_STDOUT)
    {
        $this->_streamHandle = fopen($stream, 'w');
    }

    public function setFormatter($xmlTag, StyleFormatter $formatter)
    {
        $this->_formatters[$xmlTag] = $formatter;
    }

    public function writeMessage($message, $numberOfNewLines = 1, $eol = self::LF)
    {
        if ($this->_checkVerbosityCanNotWrite()) {
            return false;
        }
        $messageWithNewLines = $message . str_repeat($eol, $numberOfNewLines);
        $parsedMessage = $this->_parseMessage($messageWithNewLines);
        fwrite($this->_streamHandle, $parsedMessage);
    }

    private function _checkVerbosityCanNotWrite()
    {
        return !$this->_checkVerbosityCanWrite();
    }

    private function _checkVerbosityCanWrite()
    {
        return $this->_currentVerbosity <= $this->_applicationVerbosity;
    }

    private function _parseMessage($message)
    {
        $parsedTags = array_unique(XmlParser::parseTags($message));
        $formatMessage = $message;
        foreach ($parsedTags as $xmlTag) {
            if (!empty($this->_formatters[$xmlTag])) {
                $formatter = $this->_formatters[$xmlTag];

                $formatMessage = $formatter->render($xmlTag, $formatMessage);
            }
        }
        return $formatMessage;
    }

    public function setVerbosityForOutput($verbosity)
    {
        $this->_currentVerbosity = $verbosity;
    }

    public function setApplicationVerbosity($verbosity)
    {
        $this->_applicationVerbosity = $verbosity;
    }

    public function __destruct()
    {
        fclose($this->_streamHandle);
    }
}