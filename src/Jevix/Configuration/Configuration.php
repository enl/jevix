<?php

namespace Jevix\Configuration;

/**
 * This class stores all configuration options for Jevix.
 *
 * @author Alex Panshin <deadyaga@gmail.com>
 * @package Jevix
 * @subpackage Configuration
 */
class Configuration
{
    /**
     * @var bool
     */
    protected $xhtmlMode = true;

    /**
     * Sets xhtml mode. It's true by default
     *
     * @api
     * @param boolean $value
     * @return $this
     */
    public function setXhtmlMode($value)
    {
        $this->xhtmlMode = $value;

        return $this;
    }

    /**
     * Returns xhtml mode. Used in process of short tags generation
     * @api
     * @return bool
     */
    public function isXhtmlMode()
    {
        return $this->xhtmlMode;
    }

    /**
     * Returns tha tag to use as Linebreak.
     * @api
     * @return string
     */
    public function getLinebreakTag()
    {
        return $this->isXhtmlMode() ? '<br />' : '<br>';
    }

    /**
     * @var bool
     */
    protected $autoInsertBR = true;

    /**
     * Returns true is auto br mode is switched on.
     * @api
     * @return bool
     */
    public function isAutoBrMode()
    {
        return $this->autoInsertBR;
    }

    /**
     * Sets auto br mode
     * @api
     * @param $value
     */
    public function setAutoBrMode($value)
    {
        $this->autoInsertBR = $value;
    }
}