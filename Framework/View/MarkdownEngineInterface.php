<?php

namespace SchumacherFM\Markdown\Framework\View;

/**
 * Interface for Template Engine
 */
interface MarkdownEngineInterface
{
    /**
     * @param string $text
     * @return string
     */
    public function transform($text);
}
