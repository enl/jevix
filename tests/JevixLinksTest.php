<?php

require_once dirname(__FILE__).'/../src/Jevix/Jevix.php';

use Jevix\Jevix;

/**
 * 
 * @author Alex Panshin <deadyaga@gmail.com>
 * @package
 * @subpackage 
 */

class JevixLinksTest extends PHPUnit_Framework_TestCase
{
    /** @var Jevix */
    private $jevix;
    private $errors = array();

    protected function setUp()
    {
        $this->jevix = new Jevix();
        $this->jevix->cfgAllowTags('a');
        $this->jevix->cfgAllowTagParams('a', array('href' => '#link', 'rel' => '#text', 'title' => '#text'));
    }

    public function testInsertsLinkIfAllowed()
    {
        $this->jevix->cfgSetAutoLinkMode(true);

        $string = 'автозамена ссылок с http:// и www: www.habrahabr.ru, http://google.com';
        $expected = 'автозамена ссылок с http:// и www: <a href="http://www.habrahabr.ru">www.habrahabr.ru</a>, <a href="http://google.com">google.com</a>';

        $this->assertEquals($expected, $this->jevix->parse($string, $this->errors));

        $this->jevix->cfgSetAutoLinkMode(false);
        $this->assertEquals($string, $this->jevix->parse($string, $errors));
    }

    public function testSkipTrailingDot()
    {
        $this->jevix->cfgSetAutoLinkMode(true);

        $string = 'автозамена ссылок с http:// и www: www.habrahabr.ru, http://google.com/chrome.';
        $expected = 'автозамена ссылок с http:// и www: <a href="http://www.habrahabr.ru">www.habrahabr.ru</a>, <a href="http://google.com">google.com/chrome</a>.';

        $this->assertEquals($expected, $this->jevix->parse($string, $this->errors));

        $this->jevix->cfgSetAutoLinkMode(false);
        $this->assertEquals($string, $this->jevix->parse($string, $errors));
    }

    public function testAddsRelNoFollowIfConfigured()
    {
        $string = 'Идите вы в <a href="http://yandex.ru">Яндекс</a>.';
        $expected = 'Идите вы в <a href="http://yandex.ru" rel="nofollow">Яндекс</a>.';

        $this->jevix->cfgSetTagParamDefault('a', 'rel', 'nofollow');

        $this->assertEquals($expected, $this->jevix->parse($string, $this->errors));
    }

    public function testDeletesLinkWithoutHref()
    {
        $string = 'Идите вы в <a>Яндекс</a>.';
        $expected = 'Идите вы в Яндекс.';

        $this->jevix->cfgSetTagParamsRequired('a', array('href'));

        $this->assertEquals($expected, $this->jevix->parse($string, $this->errors));
    }

    public function testAutoParamsShouldNotReplaceExisting()
    {
        $string = 'Идите вы в <a href="http://yandex.ru" rel="vote-for">Яндекс</a>.';
        $this->jevix->cfgSetTagParamDefault('a', 'rel', 'nofollow');

        $this->assertEquals($string, $this->jevix->parse($string, $this->errors));
    }
}
