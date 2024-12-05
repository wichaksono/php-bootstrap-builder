<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Layouts;

use NeonWebId\Classes\Common\Interfaces\ElementInterface;
use NeonWebId\Classes\Common\Traits\AttributeTrait;
use NeonWebId\Classes\Common\Traits\LayoutTrait;

use function implode;
use function is_array;
use function trim;

class Section implements ElementInterface
{
    use LayoutTrait, AttributeTrait;

    private string $id = '';

    private string|array $class = '';

    private string $title = '';

    private string $description = '';

    private string $icon = '';

    private bool $collapse = false;

    private bool $collapsed = false;

    private bool $aside = false;

    private function __construct(string $title = '')
    {
        $this->title = $title;
    }

    public function id(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public static function make(string $title = ''): self
    {
        return new self($title);
    }

    public function description(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function icon(string $icon): self
    {
        $this->icon = $icon;
        return $this;
    }

    public function collapse(bool $collapse = true): self
    {
        $this->collapse = $collapse;
        return $this;
    }

    public function collapsed(bool $collapsed = true): self
    {
        $this->collapsed = $collapsed;
        return $this;
    }

    public function aside(bool $aside = true): self
    {
        $this->aside = $aside;
        return $this;
    }

    public function render(): string
    {
        $classes = 'section' . (is_array($this->class) ? implode(' ', $this->class) : $this->class);
        $classes .= $this->aside ? ' aside' : '';
        $classes .= $this->collapse ? ' collapse' : '';
        $classes .= $this->collapsed ? ' collapsed' : '';

        $id          = $this->id ? 'id="' . $this->id . '"' : '';
        $icon        = $this->icon ? '<i class="' . $this->icon . '"></i>' : '';
        $description = $this->description ? '<p class="text-muted">' . $this->description . '</p>' : '';

        $render = '<section class="' . trim($classes) . '" ';
        $render .= $id;
        $render .= $this->getAttributes();
        $render .= '>';

        $render .= '<div class="section-header">';
        $render .= '<h2>' . $icon . $this->title . '</h2>';
        $render .= $description;
        $render .= '</div>';
        $render .= '<div class="section-body">';
        $render .= $this->getSchema();
        $render .= '</div>';
        $render .= '</section>';


        return $render;
    }
}