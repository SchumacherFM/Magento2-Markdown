<?php

namespace SchumacherFM\Markdown\Framework\View;

use Magento\Framework\ObjectManagerInterface;

/**
 * Factory class for Template Engine
 */
class MarkdownEngineFactory
{
    /**
     * Object manager
     *
     * @var ObjectManagerInterface
     */
    protected $objectManager;

    /**
     * Engines
     *
     * @var array
     */
    protected $engines;

    /**
     * Constructor
     *
     * @param ObjectManagerInterface $objectManager
     * @param array $engines Format: array('<name>' => 'MarkdownEngine\Class', ...)
     */
    public function __construct(ObjectManagerInterface $objectManager, array $engines) {
        $this->objectManager = $objectManager;
        $this->engines = $engines;
    }

    /**
     * Retrieve a markdown engine instance by its unique name
     *
     * @param string $name
     * @return MarkdownEngineInterface
     * @throws \UnexpectedValueException If markdown engine doesn't implement the necessary interface
     * @throws \InvalidArgumentException If markdown engine doesn't exist
     */
    public function create($name) {
        if (!isset($this->engines[$name])) {
            throw new \InvalidArgumentException("Unknown template engine type: '{$name}'.");
        }
        $engineClass = $this->engines[$name];
        $engineInstance = $this->objectManager->create($engineClass);
        if (!$engineInstance instanceof MarkdownEngineInterface) {
            throw new \UnexpectedValueException("{$engineClass} has to implement the markdown engine interface.");
        }
        return $engineInstance;
    }

    /**
     * @return array
     */
    public function getEngines() {
        return $this->engines;
    }
}
