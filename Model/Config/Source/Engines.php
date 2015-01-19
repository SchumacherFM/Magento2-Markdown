<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SchumacherFM\Markdown\Model\Config\Source;

use SchumacherFM\Markdown\Framework\View\MarkdownEngineFactory;

class Engines implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @var array
     */
    protected $_options;

    /**
     * @var MarkdownEngineFactory
     */
    protected $_engineFactory;

    /**
     * @param MarkdownEngineFactory $engineFactory
     */
    public function __construct(MarkdownEngineFactory $engineFactory) {
        $this->_engineFactory = $engineFactory;
    }

    /**
     * @return array
     */
    public function toOptionArray() {
        if (!$this->_options) {
            $this->_options = [];
            foreach ($this->_engineFactory->getEngines() as $key => $engine) {
                $this->_options[] = ['value' => $key, 'label' => __($key)];
            }
        }
        return $this->_options;
    }
}
