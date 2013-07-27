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
    private $_barWidth = 50;
    private $_currentBarWidth = 0;

    public function initialize(Writer $output, $size)
    {
        $this->_output = $output;
        $this->_size = $size;
    }

    public function increment()
    {
        $this->_current++;
        $this->_calculatePercent();
        $this->_calculateBarWidth();
        $fill = $this->_fillMask() . ' ' . $this->_generateBar();
        if ($this->_current == $this->_size) {
            $this->_output->writeMessage($fill);
        } else {
            $this->_output->writeMessage($fill, 1, Writer::CR);
        }
    }

    private function _calculatePercent()
    {
        $this->_percent = round($this->_current * 100 / $this->_size);
    }

    private function _calculateBarWidth()
    {
        $this->_currentBarWidth = round($this->_barWidth * $this->_percent / 100);
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

    private function _generateBar()
    {
        return "[" . str_pad(str_repeat('=', $this->_currentBarWidth), $this->_barWidth, '.') . "]";
    }
}