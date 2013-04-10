<?php
/**
 * ShellWriter
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

    private $_streamHandle;
    private $_formatters = array();

    public function __construct($stream = self::STREAM_STDOUT)
    {
        $this->_streamHandle = fopen($stream, 'w');
    }

    public function setFormatter($xmlTag, StyleFormatter $formatter)
    {
        $this->_formatters[$xmlTag] = $formatter;
    }

    public function writeMessage($message, $numberOfNewLines = 1)
    {
        $messageWithNewLines = $message . str_repeat(PHP_EOL, $numberOfNewLines);

        $parsedMessage = $this->_parseMessage($messageWithNewLines);

        fwrite($this->_streamHandle, $parsedMessage);
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

    public function __destruct()
    {
        fclose($this->_streamHandle);
    }
}