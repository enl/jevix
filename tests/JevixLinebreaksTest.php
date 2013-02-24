<?php

require_once dirname(__FILE__).'/../src/Jevix/Jevix.php';

use Jevix\Jevix;

/**
 * 
 * @author Alex Panshin <deadyaga@gmail.com>
 * @package
 * @subpackage 
 */

class JevixLinebreaksTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Jevix
     */
    private $jevix;
    private $errors = array();

    protected function setUp()
    {
        $this->jevix = new Jevix();
    }

    public function testJevixReplacesLinebreaksWithBR()
    {
        $from = 'Проверим, а не вставит ли Jevix
br вместо разрыва строки.';

        $to = 'Проверим, а не вставит ли Jevix<br/>
br вместо разрыва строки.';

        // test if jevix replaces newline with BR
        $this->assertEquals($to, $this->jevix->parse($from, $this->errors));
        // test if jevix does not replace newline with BR if newline is followed by BR
        $this->assertEquals($to, $this->jevix->parse($to, $this->errors));

        $this->jevix->cfgSetAutoBrMode(false);

        // test if jevix does not replace newlines with BR if this option is switched off.
        $this->assertEquals($from, $this->jevix->parse($from, $this->errors));
    }

}
