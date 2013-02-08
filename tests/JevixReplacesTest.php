<?php



/**
 * 
 *
 * @author Alex Panshin <deadyaga@gmail.com>
 * @package
 * @subpackage
 */
class JevixReplacesTest extends PHPUnit_Framework_TestCase
{
    /** @var Jevix */
    protected $jevix;

    public function setUp()
    {
        require_once(dirname(__FILE__).'/../src/Jevix/Jevix.php');
        $this->jevix = new Jevix();
    }

    public function testJevixReplacesCopyright()
    {
        $string = 'Copyright (c) Vasya Pupkin';
        $this->jevix->cfgSetAutoReplace(array('(c)'), array('©'));

        $expected = 'Copyright © Vasya Pupkin';
        $errors = array();
        $this->assertEquals($expected, $this->jevix->parse($string, $errors));
    }
}
