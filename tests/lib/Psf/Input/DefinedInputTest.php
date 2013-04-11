<?php
class DefinedInputTest extends PHPUnit_Framework_TestCase
{
    private $_mockDefinedInput;

    public function setUp()
    {
        $this->_mockDefinedInput = new \Psf\Input\DefinedInput('hello');
    }

    /**
     * @test
     */
    public function shouldAddCorrectShortParameter()
    {
        //given
        $this->_mockDefinedInput->addParameter('N', 'namespace');

        //when
        $short = PHPUnit_Framework_Assert::readAttribute($this->_mockDefinedInput, '_shortName');

        //then
        $this->assertEquals('N', $short);
    }

    /**
     * @test
     */
    public function shouldAddCorrectLongParameter()
    {
        //given
        $this->_mockDefinedInput->addParameter('N', 'namespace');

        //when
        $long = PHPUnit_Framework_Assert::readAttribute($this->_mockDefinedInput, '_longName');

        //then
        $this->assertEquals('namespace', $long);
    }

    /**
     * @test
     */
    public function shouldAddCorrectLongParameterWhenShortIsNull()
    {
        //given
        $this->_mockDefinedInput->addParameter(null, 'longname');

        //when
        $long = PHPUnit_Framework_Assert::readAttribute($this->_mockDefinedInput, '_longName');

        //then
        $this->assertEquals('longname', $long);
    }

    /**
     * @test
     */
    public function shouldAddCorrectShortParameterWhenLongIsNull()
    {
        //given
        $this->_mockDefinedInput->addParameter('s', null);

        //when
        $short = PHPUnit_Framework_Assert::readAttribute($this->_mockDefinedInput, '_shortName');

        //then
        $this->assertEquals('s', $short);
    }

    /**
     * @test
     */
    public function shouldFitShortParameter()
    {
        //given
        $this->_mockDefinedInput->addParameter('s', 'long');

        //when
        $isFit = $this->_mockDefinedInput->isFitAnyParameter('s');

        //then
        $this->assertTrue($isFit);
    }

    /**
     * @test
     */
    public function shouldNotFitShortParameter()
    {
        //given
        $this->_mockDefinedInput->addParameter('s', 'long');

        //when
        $isNotFit = $this->_mockDefinedInput->isFitAnyParameter('a');

        //then
        $this->assertFalse($isNotFit);
    }

    /**
     * @test
     */
    public function shouldFitLongParameter()
    {
        //given
        $this->_mockDefinedInput->addParameter('s', 'long');

        //when
        $isFit = $this->_mockDefinedInput->isFitAnyParameter('long');

        //then
        $this->assertTrue($isFit);
    }

    /**
     * @test
     */
    public function shouldNotFitLongParameter()
    {
        //given
        $this->_mockDefinedInput->addParameter('s', 'long');

        //when
        $isFit = $this->_mockDefinedInput->isFitAnyParameter('longother');

        //then
        $this->assertFalse($isFit);
    }

    /**
     * @test
     */
    public function shouldGetShortArgWhenLongGiven()
    {
        //given
        $this->_mockDefinedInput->addParameter('s', 'long');

        //when
        $oppositeParameter = $this->_mockDefinedInput->getOppositeParameter('long');

        //then
        $this->assertEquals('s', $oppositeParameter);
    }

    /**
     * @test
     */
    public function shouldGetLongArgWhenShortGiven()
    {
        //given
        $this->_mockDefinedInput->addParameter('s', 'long');

        //when
        $oppositeParameter = $this->_mockDefinedInput->getOppositeParameter('s');

        //then
        $this->assertEquals('long', $oppositeParameter);
    }

    /**
     * @test
     */
    public function shouldGetCorrectApplicationName()
    {
        //when
        $appName = PHPUnit_Framework_Assert::readAttribute($this->_mockDefinedInput, '_applicationName');

        //then
        $this->assertEquals('hello', $appName);
    }
}