<?php

namespace SchumacherFM\Markdown\Framework\View\MarkdownEngine;

use \Parsedown as pDown,
    SchumacherFM\Markdown\Framework\View\MarkdownEngineInterface;

class Parsedown implements MarkdownEngineInterface
{
    /**
     * @var pDown
     */
    private $engine;

    public function __construct(pDown $engine) {
        $this->engine = $engine;
    }

    /**
     * @param string $text
     * @return string
     */
    public function transform($text) {
        return $this->engine->text($text);
    }
}
