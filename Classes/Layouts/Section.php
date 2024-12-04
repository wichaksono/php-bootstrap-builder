<?php
declare(strict_types=1);

namespace NeonWebId\Classes\Layouts;

use NeonWebId\Classes\Common\Interfaces\SchemaInterface;
use NeonWebId\Classes\Common\Traits\ColumnTrait;
use NeonWebId\Classes\Common\Traits\SchemaTrait;

class Section implements SchemaInterface
{
    use ColumnTrait, SchemaTrait;

    private string $id = '';

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
        $collapse    = $this->collapse ? 'collapse' : '';
        $collapsed   = $this->collapsed ? 'collapsed' : '';
        $aside       = $this->aside ? 'aside' : '';
        $id          = $this->id ? 'id="' . $this->id . '"' : '';
        $icon        = $this->icon ? '<i class="' . $this->icon . '"></i>' : '';
        $description = $this->description ? '<p class="text-muted">' . $this->description . '</p>' : '';

        $render = '<section class="section ' . $aside . '" ';
        $render .= $id;
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