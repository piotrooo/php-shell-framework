<?php
/**
 * XmlParser
 *
 * @author Piotr Olaszewski
 */
namespace Psf;

class XmlParser
{
    public static function parseTags($stringToParse)
    {
        preg_match_all('#<([\w-]*?)>#', $stringToParse, $tagsMatched);

        return $tagsMatched[1];
    }

    public static function getValueBetweenTags($tag, $stringToParse)
    {
        $regexp = '#<' . $tag . '>(.+?)</' . $tag . '>#';
        preg_match_all($regexp, $stringToParse, $valuesMatched);

        return $valuesMatched[1];
    }
}