<?php
/**
 * Created by JetBrains PhpStorm.
 * User: enlightened
 * Date: 09.02.13
 * Time: 2:21
 * To change this template use File | Settings | File Templates.
 */

class JevixQuotationsTest extends PHPUnit_Framework_TestCase
{
    /** @var Jevix */
    protected $jevix;
    protected $errors;

    public function setUp()
    {
        require_once(dirname(__FILE__).'/../src/Jevix/Jevix.php');
        $this->jevix = new Jevix();
        $this->errors = array();
    }

    public function testSkipDoubleQuotes()
    {
        $string = '""Пиво"';
        $expected = '«Пиво»';

        $this->assertEquals($expected, $this->jevix->parse($string, $this->errors));
    }

    public function testReplaceQuotes()
    {
        $string = '"Пиво"';
        $expected = '«Пиво»';

        $this->assertEquals($expected, $this->jevix->parse($string, $this->errors));
    }

    public function testReplaceNestedQuotes()
    {
        $string = 'Обработка "кавычек" и "вложенных "друг в друга" кавычек"';
        $expected = 'Обработка «кавычек» и «вложенных „друг в друга“ кавычек»';

        $this->assertEquals($expected, $this->jevix->parse($string, $this->errors));
    }

    public function testSkipOddQuotes()
    {
        $string = 'Обработка "кавычек" и "вложенных "друг в друга кавычек". Еще чуть-чуть текста.';
        $expected = 'Обработка «кавычек» и «вложенных друг в друга кавычек». Еще чуть-чуть текста.';

        $this->assertEquals($expected, $this->jevix->parse($string, $this->errors));
    }

    public function testSkipAttributeQuotes()
    {
        $string = '<a href="http://yandex.ru">"Привет"</a>';
        $expected = '<a href="http://yandex.ru">«Привет»</a>';

        $this->jevix->cfgAllowTags('a');
        $this->jevix->cfgAllowTagParams('a', 'href');

        $this->assertEquals($expected, $this->jevix->parse($string, $this->errors));
    }
}
