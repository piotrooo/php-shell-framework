<?php
class WriterTest extends PHPUnit_Framework_TestCase
{
    private $_writer;

    public function tearDown()
    {
        fclose($this->_writer);
    }

    private function _openWriteStdOut()
    {
        $this->_writer = new \Psf\Output\Writer(\Psf\Output\Writer::STREAM_STDOUT);
    }

    private function _getActualWriteMessage($message, $numberOfNewLines = 1)
    {
        $streamProp = new ReflectionProperty($this->_writer, '_streamHandle');
        $streamRead = fopen('php://memory', 'rw');

        $streamProp->setAccessible(true);
        $streamProp->setValue($this->_writer, $streamRead);

        $this->_writer->writeMessage($message, $numberOfNewLines);
        fseek($streamRead, 0);
        $actual = stream_get_contents($streamRead);
        fclose($streamRead);
        return $actual;
    }

    /**
     * @test
     */
    public function shouldWriteOnStdOut()
    {
        //given
        $this->_openWriteStdOut();

        //when
        $expected = 'test'.PHP_EOL;
        $actual = $this->_getActualWriteMessage('test');

        //then
        $this->assertSame($expected, $actual);
    }

    /**
     * @test
     */
    public function shouldWriteOnStdOutWithNumerOfNewLines()
    {
        //given
        $this->_openWriteStdOut();

        //when
        $numberOfNewLines = 6;
        $expected = 'test'.str_repeat(PHP_EOL, $numberOfNewLines);
        $actual = $this->_getActualWriteMessage('test', 6);

        //then
        $this->assertSame($expected, $actual);
    }
}