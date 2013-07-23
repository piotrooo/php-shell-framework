<?php
class StyleFormatterTest extends \PHPUnit_Framework_TestCase
{
    private $_mockStyleFormatter;

    public function setUp()
    {
        $this->_mockStyleFormatter = new \Psf\Output\StyleFormatter('green', 'red', array('blink', 'bold'));
    }

    /**
     * @test
     */
    public function shouldReturnCorrectFgColorCode()
    {
        //when
        $expectedCode = 32;
        $actualCode = $this->_mockStyleFormatter->getFgColorCode();

        //then
        $this->assertEquals($expectedCode, $actualCode);
    }

    /**
     * @test
     */
    public function shouldReturnCorrectBgColorCode()
    {
        //when
        $expectedCode = 41;
        $actualCode = $this->_mockStyleFormatter->getBgColorCode();

        //then
        $this->assertEquals($expectedCode, $actualCode);
    }

    /**
     * @test
     */
    public function shouldReturnCorrectEffectCode()
    {
        //when
        $expectedCode = 5;
        $actualCode = $this->_mockStyleFormatter->getEffectCode('blink');

        //then
        $this->assertEquals($expectedCode, $actualCode);
    }

    /**
     * @test
     */
    public function shouldReturnCorrectParsedEffectCode()
    {
        //when
        $expectedCode = '5;1';
        $actualCode = $this->_mockStyleFormatter->getParsedToStringEffects();

        //then
        $this->assertEquals($expectedCode, $actualCode);
    }

    /**
     * @test
     */
    public function shouldRenderFormattedMessageWithFgAndBgAndOption()
    {
        //given
        $xmlTag = 'test';
        $message = '<test>Hello</test> test is working!';

        //when
        $expectedRender = "\033[41;32;5;1mHello\033[0m test is working!";
        $actualRender = $this->_mockStyleFormatter->render($xmlTag, $message);

        //then
        $this->assertEquals($expectedRender, $actualRender);
    }
}