<?php
class ArgvParserTest extends PHPUnit_Framework_TestCase
{
    private $_mockedArgvParser;
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

        $this->_mockedArgvParser = new \Psf\Input\ArgvParser($this->_mockedConstructorParams);
    }

    private function _getValueForParameter($parameter)
    {
        $paramsReturned = $this->_mockedArgvParser->getParsedParameters();
        $paramToCompare = isset($paramsReturned['hello'][$parameter]) ? $paramsReturned['hello'][$parameter] : ' ';
        return $paramToCompare;
    }

    /**
     * @test
     */
    public function shouldParseShortParametersWithoutValue()
    {
        //given
        $this->_mockedArgvParser->parseParameters();

        //when
        $paramsExpected = '';
        $paramToCompare = $this->_getValueForParameter('w');

        //then
        $this->assertEquals($paramsExpected, $paramToCompare);
    }

    /**
     * @test
     */
    public function shouldParseShortParametersWithValueSpaceSepared()
    {
        //given
        $this->_mockedArgvParser->parseParameters();

        //when
        $paramsExpected = 'value1';
        $paramToCompare = $this->_getValueForParameter('v');

        //then
        $this->assertEquals($paramsExpected, $paramToCompare);
    }

    /**
     * @test
     */
    public function shouldParseShortParametersWithValueNonSpaceSepared()
    {
        //given
        $this->_mockedArgvParser->parseParameters();

        //when
        $paramsExpected = 'value3';
        $paramToCompare = $this->_getValueForParameter('c');

        //then
        $this->assertEquals($paramsExpected, $paramToCompare);
    }

    /**
     * @test
     */
    public function shouldParseShortParametersWithValueEqualSignSepared()
    {
        //given
        $this->_mockedArgvParser->parseParameters();

        //when
        $paramsExpected = 'value2';
        $paramToCompare = $this->_getValueForParameter('s');

        //then
        $this->assertEquals($paramsExpected, $paramToCompare);
    }

    /**
     * @test
     */
    public function shouldParseLongParametersWithoutValue()
    {
        //given
        $this->_mockedArgvParser->parseParameters();

        //when
        $paramsExpected = '';
        $paramToCompare = $this->_getValueForParameter('withoutval');

        //then
        $this->assertEquals($paramsExpected, $paramToCompare);
    }

    /**
     * @test
     */
    public function shouldParseLongParametersWithValue()
    {
        //given
        $this->_mockedArgvParser->parseParameters();

        //when
        $paramsExpected = 'value4';
        $paramToCompare = $this->_getValueForParameter('name');

        //then
        $this->assertEquals($paramsExpected, $paramToCompare);
    }
}
