<?php
class ReaderTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldGetReadedValue ()
    {
        $r = new \Psf\Input\Reader('php://stdin');

        $a = new \org\bovigo\vfs\vfsStreamWrapper();
        $a->stream_open('php://stdin', 'r', STREAM_USE_PATH, 'php:/stdin');
        $a->stream_write('test');

        echo $r->getReadedValue();
    }
}

