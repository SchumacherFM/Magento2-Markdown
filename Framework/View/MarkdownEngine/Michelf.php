<?php

namespace SchumacherFM\Markdown\Framework\View\MarkdownEngine;

use \Michelf\Markdown,
    SchumacherFM\Markdown\Framework\View\MarkdownEngineInterface;

class Michelf implements MarkdownEngineInterface
{
    /**
     * @var Markdown
     */
    private $engine;

    public function __construct(Markdown $engine) {
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
