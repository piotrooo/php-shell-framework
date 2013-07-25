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
    private $headers = array();
    private $rows = array();
    /**
     * @var Writer
     */
    private $output;

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
        return $this;
    }

    public function setRows(array $rows)
    {
        $this->rows = $rows;
        return $this;
    }

    public function render(Writer $output)
    {
        $this->output = $output;

        $this->renderHeaderRowSeparator();
        $this->generateHeaderRow();
        $this->renderHeaderRowSeparator();

        $this->generateBodyRows();
        $this->renderHeaderRowSeparator();
    }

    private function renderHeaderRowSeparator()
    {
        $separator = '+';
        foreach ($this->headers as $column => $header) {
            $columnWidth = $this->getColumnWidth($column);
            $separator .= str_repeat('-', $columnWidth) . '+';
        }
        $this->output->writeMessage($separator);
    }

    private function generateHeaderRow()
    {
        $this->renderDataRow($this->headers);
    }

    private function generateBodyRows()
    {
        foreach ($this->rows as $row) {
            $this->renderDataRow($row);
        }
    }

    private function renderDataRow($row)
    {
        $line = '|';
        foreach ($row as $column => $name) {
            $columnWidth = $this->getColumnWidth($column);
            $spaces = $columnWidth - strlen($name) - 1;
            $line .= ' ' . $name . str_repeat(' ', $spaces) . '|';
        }
        $this->output->writeMessage($line);
    }

    private function getColumnWidth($column)
    {
        $width = 0;
        if (isset($this->headers[$column])) {
            $width = strlen($this->headers[$column]);
        }
        array_map(function ($element) use (&$width, $column) {
            $length = strlen($element[$column]);
            if ($length > $width) {
                $width = $length;
            }
        }, $this->rows);
        return $this->widthWithSpaces($width);
    }

    private function widthWithSpaces($width)
    {
        return $width + 2;
    }
}