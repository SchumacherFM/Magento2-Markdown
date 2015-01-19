<?php

namespace SchumacherFM\Markdown\Framework\View\TemplateEngine;

use Magento\Framework\View\TemplateEngine\Php,
    Magento\Framework\App\Filesystem\DirectoryList,
    Magento\Framework\ObjectManagerInterface,
    Magento\Framework\App\Config\ScopeConfigInterface,
    Magento\Framework\Event\ManagerInterface,
    SchumacherFM\Markdown\Framework\View\MarkdownEngineInterface;

class Markdown extends Php
{
    const CACHE_DIR = 'markdown';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $_scopeConfig;

    /**
     * @var MarkdownEngineInterface
     */
    private $mdEngine = null;

    /**
     * @var DirectoryList
     */
    protected $_directoryList;

    /**
     * Event manager
     *
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager;

    /**
     * @param ObjectManagerInterface $helperFactory
     * @param DirectoryList $directoryList
     * @param ScopeConfigInterface $scopeConfig
     * @param ManagerInterface $eventManager
     */
    public function __construct(
        ObjectManagerInterface $helperFactory,
        DirectoryList $directoryList,
        ScopeConfigInterface $scopeConfig,
        ManagerInterface $eventManager
    ) {
        parent::__construct($helperFactory);
        $this->_directoryList = $directoryList;
        $this->_scopeConfig = $scopeConfig;
        $this->eventManager = $eventManager;
        $this->_init();
    }

    private function _init() {


        $this->eventManager->dispatch('twig_init', ['twig' => $this->mdEngine]);
    }

    /**
     * @return \Twig_LoaderInterface
     */
    private function getLoader() {
        $loader = new \stdClass();
        $this->eventManager->dispatch('twig_loader', ['loader' => $loader]);
        if (false === ($loader instanceof \Twig_LoaderInterface)) {
            $loader = new \Twig_Loader_Filesystem($this->_directoryList->getPath(DirectoryList::ROOT));
        }
        return $loader;
    }

    /**
     * @return string
     */
    private function getCachePath() {
        if (false === $this->_scopeConfig->isSetFlag('dev/twig/cache')) {
            return false;
        }
        return $this->_directoryList->getPath(DirectoryList::VAR_DIR) . DIRECTORY_SEPARATOR . self::CACHE_DIR;
    }

    /**
     * @return mixed
     */
    public function catchGet() {
        $args = func_get_args();
        $name = array_shift($args);
        return $this->__call('get' . $name, $args);
    }

    /**
     * Render template
     *
     * Render the named template in the context of a particular block and with
     * the data provided in $vars.
     *
     * @param \Magento\Framework\View\Element\BlockInterface $block
     * @param string $fileName
     * @param array $dictionary
     * @return string rendered template
     */
    public function render(\Magento\Framework\View\Element\BlockInterface $block, $fileName, array $dictionary = []) {

        // same as in PHP ngin ...
    }

    /**
     * @param $fileName
     * @return \Twig_TemplateInterface
     */
    private function getTemplate($fileName) {
        $tf = str_replace($this->_directoryList->getPath(DirectoryList::ROOT) . DIRECTORY_SEPARATOR, '', $fileName);
        return $this->mdEngine->loadTemplate($tf);
    }

    /**
     * Get helper singleton
     *
     * @param string $className
     * @return \Magento\Framework\App\Helper\AbstractHelper
     * @throws \LogicException
     */
    public function helper($className) {
        $helper = $this->_helperFactory->get($className);
        if (false === $helper instanceof \Magento\Framework\App\Helper\AbstractHelper) {
            throw new \LogicException($className . ' doesn\'t extends Magento\Framework\App\Helper\AbstractHelper');
        }
        return $helper;
    }
}
