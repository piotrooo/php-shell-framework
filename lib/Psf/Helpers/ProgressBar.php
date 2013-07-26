<?php
/**
 * ProgressBar
 *
 * @author Piotr Olaszewski
 */
namespace Psf\Helpers;

use Psf\Output\Writer;

class ProgressBar
{
    /**
     * @var Writer
     */
    private $_output;
    private $_size = 0;
    private $_current = 0;
    private $_percent = 0;
    private $_counterMask = '{current}/{all} ({percent}%)';

    public function initialize(Writer $output, $size)
    {
        $this->_output = $output;
        $this->_size = $size;
    }

    public function increment()
    {
        $this->_current++;
        $this->_calculatePercent();
        if ($this->_current == $this->_size) {
            $this->_output->writeMessage($this->_fillMask());
        } else {
            $this->_output->writeMessage($this->_fillMask(), 1, Writer::CR);
        }
    }

    private function _calculatePercent()
    {
        $this->_percent = round($this->_current * 100 / $this->_size);
    }

    private function _fillMask()
    {
        $matches = array(
            '{current}' => $this->_current,
            '{all}' => $this->_size,
            '{percent}' => $this->_percent
        );
        return str_replace(array_keys($matches), array_values($matches), $this->_counterMask);
    }
}