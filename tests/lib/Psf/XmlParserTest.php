<?php
class XmlParserTest extends PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function shouldParseSingleXmlTag()
    {
        //given
        $stringToParse = '<tag>Is ok</tag> now?';

        //when
        $expectedXml = array('tag');
        $actualXml = \Psf\XmlParser::parseTags($stringToParse);

        //then
        $this->assertEquals($expectedXml, $actualXml);
    }

    /**
     * @test
     */
    public function shouldParseMultipleXmlTags()
    {
        //given
        $stringToParse = '<tag>Is ok</tag> now, maybe <tag2>multiple</tag2>?';

        //when
        $expectedXml = array('tag', 'tag2');
        $actualXml = \Psf\XmlParser::parseTags($stringToParse);

        //then
        $this->assertEquals($expectedXml, $actualXml);
    }

    /**
     * @test
     */
    public function shouldParseNestedXmlTags()
    {
        //given
        $stringToParse = '<tag>Is <subtag>ok</subtag></tag>, and now <tag2>second</tag2>!';

        //when
        $expectedXml = array('tag', 'subtag', 'tag2');
        $actualXml = \Psf\XmlParser::parseTags($stringToParse);

        //then
        $this->assertEquals($expectedXml, $actualXml);
    }

    /**
     * @test
     */
    public function shouldNotReturnTagsWhenNotFound ()
    {
        //given
        $stringToParse = 'String without XML tags.';

        //when
        $expectedXml = array();
        $actualXml = \Psf\XmlParser::parseTags($stringToParse);

        //then
        $this->assertEquals($expectedXml, $actualXml);
    }

    /**
     * @test
     */
    public function shouldReturnValueBetweenSingleTag()
    {
        //given
        $stringToParse = '<tag>Is ok</tag> now?';

        //when
        $expectedXml = array('Is ok');
        $actualXml = \Psf\XmlParser::getValueBetweenTags('tag', $stringToParse);

        //then
        $this->assertEquals($expectedXml, $actualXml);
    }

    /**
     * @test
     */
    public function shouldReturnValueBetweenMultipleTags ()
    {
        //given
        $stringToParse = '<tag>Is ok</tag> now, maybe <tag>multiple</tag>?';

        //when
        $expectedXml = array('Is ok', 'multiple');
        $actualXml = \Psf\XmlParser::getValueBetweenTags('tag', $stringToParse);

        //then
        $this->assertEquals($expectedXml, $actualXml);
    }

    /**
     * @test
     */
    public function shouldNotReturnWhenTagNotFound ()
    {
        //given
        $stringToParse = '<tag>Is ok</tag> now, maybe <tag>multiple</tag>?';

        //when
        $expectedXml = array();
        $actualXml = \Psf\XmlParser::getValueBetweenTags('another_tag', $stringToParse);

        //then
        $this->assertEquals($expectedXml, $actualXml);
    }
}