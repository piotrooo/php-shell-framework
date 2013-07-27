<?php
/**
 * Loader
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Helpers;

use Psf\Output\Writer;

class Loader
{
    /**
     * @var Writer
     */
    private $_output;
    private $_charSequence = array('|', '/', '-', '\\', '|');
    private $_currentSequenceId = 0;
    private $_loaderText = 'Loading ';

    public function initialize(Writer $output)
    {
        $this->_output = $output;
    }

    public function start()
    {
        if ($this->_currentSequenceId == sizeof($this->_charSequence)) {
            $this->_currentSequenceId = 0;
        }
        $char = $this->_charSequence[$this->_currentSequenceId];
        $this->_output->writeMessage(Writer::ANSI_CLEAR_LINE . $this->_loaderText . $char, 1, Writer::CR);
        $this->_currentSequenceId++;
    }

    public function setCharSequence($charSequence)
    {
        $this->_charSequence = $charSequence;
        $this->setCurrentSequenceId(0);
    }

    public function setCurrentSequenceId($currentSequenceId)
    {
        $this->_currentSequenceId = $currentSequenceId;
    }

    public function setLoaderText($loaderText)
    {
        $this->_loaderText = $loaderText;
    }
}