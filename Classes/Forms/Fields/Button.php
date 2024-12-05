<?php
declare(strict_types=1);

namespace NeonWebId\Classes\Forms\Fields;

use NeonWebId\Classes\Common\Interfaces\ElementInterface;
/**
 *<button type="button" class="btn btn-primary">Primary</button>
 * <button type="button" class="btn btn-secondary">Secondary</button>
 * <button type="button" class="btn btn-success">Success</button>
 * <button type="button" class="btn btn-danger">Danger</button>
 * <button type="button" class="btn btn-warning">Warning</button>
 * <button type="button" class="btn btn-info">Info</button>
 * <button type="button" class="btn btn-light">Light</button>
 * <button type="button" class="btn btn-dark">Dark</button>
 *
 * <button type="button" class="btn btn-link">Link</button>
 */
class Button implements ElementInterface
{

    private string $id = '';

    private string $class = '';

    private string $color = 'primary';

    private bool $outline = false;

    private string $size = 'md';

    private bool $block = false;

    private bool $disabled = false;

    private bool $toggle = false;

    private string $label = '';


    private function __construct(string $label)
    {
        $this->label = $label;
        $this->id = $label . '-' . substr(md5(microtime()), 0, 5);
    }

    public static function make(string $label): self
    {
        return new self($label);
    }

    public function id(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function class(string $class): self
    {
        $this->class = $class;
        return $this;
    }

    public function color(string $color): self
    {
        $this->color = $color;
        return $this;
    }

    public function outline(): self
    {
        $this->outline = true;
        return $this;
    }

    public function size(string $size): self
    {
        $this->size = $size;
        return $this;
    }

    public function block(): self
    {
        $this->block = true;
        return $this;
    }

    public function disabled(): self
    {
        $this->disabled = true;
        return $this;
    }

    public function toggle(): self
    {
        $this->toggle = true;
        return $this;
    }

    public function render(): string
    {
        $class = 'btn btn-' . $this->color;
        $class .= $this->outline ? '-outline' : '';
        $class .= ' btn-' . $this->size;
        $class .= $this->block ? ' btn-block' : '';
        $class .= $this->disabled ? ' disabled' : '';
        $class .= $this->toggle ? ' active' : '';
        $class .= ' ' . $this->class;
        return '<button type="button" class="' . $class . '">' . $this->label . '</button>';
    }
}