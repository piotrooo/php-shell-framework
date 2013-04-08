<?php
class ArgvInputTest extends PHPUnit_Framework_TestCase
{
    private $_mockedArgvInput;
    private $_mockedConstructorParams;

    public function setUp()
    {
        $this->_mockedConstructorParams = array(
            'psf.php',
            'app:hello',
            '-w',
            '-v',
            'value1',
            '-s=value2',
            '-cvalue3',
            '--name=value4',
            '--withoutval',
            'app:two',
            '-a',
            'test1'
        );

        $this->_mockedArgvInput = new \Psf\Input\ArgvInput($this->_mockedConstructorParams);
    }

    /**
     * @test
     */
    public function shouldParseShortParametersWithoutValue()
    {
        //given
        $this->_mockedArgvInput->parseParameters();

        //when
        $paramsExpected = '';
        $paramsReturned = $this->_mockedArgvInput->getParsedParameters();
        $paramToCompare = isset($paramsReturned['hello']['w']) ? $paramsReturned['hello']['w'] : ' ' ;

        //then
        $this->assertEquals($paramsExpected, $paramToCompare);
    }

    /**
     * @test
     */
    public function shouldParseShortParametersWithValueSpaceSepared()
    {
        //given
        $this->_mockedArgvInput->parseParameters();

        //when
        $paramsExpected = 'value1';
        $paramsReturned = $this->_mockedArgvInput->gzetParsedParameters();
        $paramToCompare = isset($paramsReturned['hello']['v']) ? $paramsReturned['hello']['v'] : '' ;

        //then
        $this->assertEquals($paramsExpected, $paramToCompare);
    }

    /**
     * @test
     */
    public function shouldParseShortParametersWithValueNonSpaceSepared ()
    {
        //given
        $this->_mockedArgvInput->parseParameters();

        //when
        $paramsExpected = 'value3';
        $paramsReturned = $this->_mockedArgvInput->getParsedParameters();
        $paramToCompare = isset($paramsReturned['hello']['c']) ? $paramsReturned['hello']['c'] : '' ;

        //then
        $this->assertEquals($paramsExpected, $paramToCompare);
    }

    /**
     * @test
     */
    public function shouldParseShortParametersWithValueEqualSignSepared ()
    {
        //given
        $this->_mockedArgvInput->parseParameters();

        //when
        $paramsExpected = 'value2';
        $paramsReturned = $this->_mockedArgvInput->getParsedParameters();
        $paramToCompare = isset($paramsReturned['hello']['s']) ? $paramsReturned['hello']['s'] : '' ;

        //then
        $this->assertEquals($paramsExpected, $paramToCompare);
    }

    /**
     * @test
     */
    public function shouldParseLongParametersWithoutValue()
    {
        //given

        //when
        //then
    }

    /**
     * @test
     */
    public function shouldParseLongParametersWithValue()
    {
        //given

        //when
        //then
    }
}
