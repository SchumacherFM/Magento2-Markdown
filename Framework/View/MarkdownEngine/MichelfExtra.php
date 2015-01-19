<?php

namespace SchumacherFM\Markdown\Framework\View\MarkdownEngine;

use Michelf\MarkdownExtra,
    SchumacherFM\Markdown\Framework\View\MarkdownEngineInterface;

class MichelfExtra implements MarkdownEngineInterface
{
    /**
     * @var MarkdownExtra
     */
    private $engine;

    public function __construct(MarkdownExtra $engine) {
        $this->engine = $engine;
    }

    /**
     * @param string $text
     * @return string
     */
    public function transform($text) {
        return $this->engine->transform($text);
    }
}
