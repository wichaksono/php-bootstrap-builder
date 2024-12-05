<?php
declare(strict_types=1);

namespace NeonWebId\Classes\Components;

use NeonWebId\Classes\Common\Interfaces\ElementInterface;

class ButtonGroup implements ElementInterface
{
    private string $id = '';

    private string|array $class = '';

    private string $label = '';

    private string $size = '';

    private function __construct(string $id = '')
    {
        $this->id = $id;
    }

    public function id(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public static function make(string $id = ''): self
    {
        return new self($id);
    }

    public function class(string|array $class): self
    {
        $this->class = $class;
        return $this;
    }

    public function label(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function size(string $size): self
    {
        $this->size = $size;
        return $this;
    }


    public function render(): string
    {
        $class = is_array($this->class) ? implode(' ', $this->class) : $this->class;
        return <<<HTML
        <div class="btn-group $class" role="group" aria-label="Basic example">
            <button type="button" class="btn btn-primary">$this->label</button>
            <button type="button" class="btn btn-secondary">$this->label</button>
            <button type="button" class="btn btn-success">$this->label</button>
        </div>
        HTML;
    }
}