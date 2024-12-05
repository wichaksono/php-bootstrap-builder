<?php

declare(strict_types=1);

namespace NeonWebId\Common\Abstracts;

use NeonWebId\Common\Interfaces\RenderInterface;
use NeonWebId\Common\Traits\LayoutTrait;

use function implode;

abstract class RenderAbstract implements RenderInterface
{
    use LayoutTrait;

    /**
     * Render
     *
     * @return string
     */
    public function render(): string
    {
        $containerClasses = [];

        if ($this->getContainerClasses()) {
            $containerClasses[] = $this->getContainerClasses();
        }

        if ($this->getMarginClasses()) {
            $containerClasses[] = $this->getMarginClasses();
        }

        if ($this->getPaddingClasses()) {
            $containerClasses[] = $this->getPaddingClasses();
        }

        $containerClasses = implode(' ', $containerClasses);

        if ( ! empty($containerClasses)) {
            $render = '<div class="row ' . $containerClasses . '">';
            if ($this->schema) {
                foreach ($this->schema as $schema) {
                    $render .= '<div class="' . $schema->getColumnClasses($this->columns) . '">';
                    $render .= $schema->render();
                    $render .= '</div>';
                }
            }
            $render .= '</div>';
        } else {
            $render = '';
            if ($this->schema) {
                foreach ($this->schema as $schema) {
                    $render .= $schema->render();
                }
            }
        }

        return $render;
    }
}