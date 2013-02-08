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

    public function testDoubleQuotes()
    {
        $string = '""Пиво"';
        $expected = '«Пиво»';

        $this->assertEquals($expected, $this->jevix->parse($string, $this->errors));

    }
}
