<?php

namespace SchumacherFM\Markdown\Framework\View\TemplateEngine;

use Magento\Framework\View\TemplateEngine\Php,
    Magento\Framework\ObjectManagerInterface,
    Magento\Framework\App\Config\ScopeConfigInterface,
    Magento\Framework\Event\ManagerInterface,
    SchumacherFM\Markdown\Framework\View\MarkdownEngineInterface,
    SchumacherFM\Markdown\Framework\View\MarkdownEngineFactory;

class Markdown extends Php
{
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var MarkdownEngineInterface
     */
    private $mdEngine = null;

    /**
     * Event manager
     *
     * @var \Magento\Framework\Event\ManagerInterface
     */
    protected $eventManager;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param ScopeConfigInterface $scopeConfig
     * @param ManagerInterface $eventManager
     * @param MarkdownEngineFactory $engineFactory
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        ScopeConfigInterface $scopeConfig,
        ManagerInterface $eventManager,
        MarkdownEngineFactory $engineFactory
    ) {
        parent::__construct($objectManager);
        $this->scopeConfig = $scopeConfig;
        $this->eventManager = $eventManager;
        $this->mdEngine = $engineFactory->create($this->scopeConfig->getValue('dev/markdown/engine'));
        $this->eventManager->dispatch('markdown_init', ['engine' => $this->mdEngine]);
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
        return $this->mdEngine->transform(parent::render($block, $fileName, $dictionary));
    }
}
