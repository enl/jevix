<?php
/**
 * This class is a first step of Jevix refactoring.
 * It provides better configuration API for Jevix
 *
 * @author Alex Panshin <deadyaga@gmail.com>
 * @package Jevix
 */
namespace Jevix;


class Configurator
{
    /** @var \Jevix\Jevix */
    private $jevix;

    public function __construct(Jevix $jevix = null)
    {
        $this->jevix = is_null($jevix) ? new Jevix() : $jevix;
    }

    /**
     * Returns configured instance
     * @return Jevix
     */
    public function getJevix()
    {
        return $this->jevix;
    }

    /**
     * Allows links and configures links-related options
     *
     * @param array $requiredAttributes
     * @param array $defaultAttributes
     * @param bool $autoLinks
     */
    public function allowLinks($requiredAttributes = array(), $defaultAttributes = array(), $autoLinks = true)
    {
        $this->jevix->cfgAllowTags('a');

        $requiredAttributes = is_array($requiredAttributes) ? $requiredAttributes : array($requiredAttributes);
        if (!in_array('href', $requiredAttributes)) {
            $requiredAttributes[] = 'href';
        }
        $this->jevix->cfgSetTagParamsRequired('a', $requiredAttributes);

        if (count($defaultAttributes)) {
            $this->jevix->cfgSetTagParamsAutoAdd('a', $defaultAttributes);
        }

        $this->jevix->cfgSetAutoLinkMode($autoLinks);
    }

    /**
     * Configures basic rules for html parsing. It must be used AFTER you allowed a bunch of tags
     */
    protected function configureBasics()
    {
        $this->jevix->cfgSetTagShort('br', 'img');
        $this->jevix->cfgSetTagPreformatted('pre');
        $this->jevix->cfgSetTagNoTypography('code');
        $this->jevix->cfgSetTagCutWithContent(array('script', 'style'));
    }
}