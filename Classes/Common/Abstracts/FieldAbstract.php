<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Common\Abstracts;

use NeonWebId\Classes\Common\Interfaces\FieldInterface;
use NeonWebId\Classes\Common\Traits\AttributeTrait;
use NeonWebId\Classes\Common\Traits\FormFieldTrait;

abstract class FieldAbstract implements FieldInterface
{
    use FormFieldTrait, AttributeTrait;

    private string $id;

    private string $name;

    private string $label = '';

    private bool $ariaLabel = false;

    private string $readonly = '';

    private string $disabled = '';

    private string $required = '';

    private string $value;

    private string $placeholder = '';

    /**
     * The size attribute works with the following input types: text, search, tel, url, email, and password.
     *
     * @var string $size
     */
    private string $size = '';

    /**
     * When a maxlength is set, the input field will not accept more than the specified number of characters.
     * However, this attribute does not provide any feedback. So, if you want to alert the user, you must write JavaScript code.
     *
     * @var string $maxlength
     */
    private string $maxlength = '';

    private string $pattern = '';

    /**
     * The min and max attributes work with the following input types: number, range, date, datetime-local, month, time and week.
     *
     * @var string $min
     * @var string $max
     */
    private string $min = '';

    private string $max = '';

    /**
     * The step attribute works with the following input types: number, range, date, datetime-local, month, time and week.
     * @var string $step
     */
    private string $step = '';

    /**
     * The multiple attribute works with the following input types: email, and file.
     * @var string $multiple
     */
    private string $multiple = '';

    private string $autofocus = '';

    private string $autocomplete = '';

    private string $autocapitalize = '';

    private string $prefix = '';

    private string $suffix = '';

    private string $prefixIcon = '';

    private string $suffixIcon = '';

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->id   = $name . '-' . substr(md5(microtime()), 0, 5);
    }

    public function id(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function label(string $label): self
    {
        $this->label = $label;
        return $this;
    }

    public function ariaLabel(bool $ariaLabel = true): self
    {
        $this->ariaLabel = $ariaLabel;
        return $this;
    }

    public function value(string $value): self
    {
        $this->value = $value;
        return $this;
    }

    public function readonly(): self
    {
        $this->readonly = 'readonly';
        return $this;
    }

    public function disabled(): self
    {
        $this->disabled = 'disabled';
        return $this;
    }

    public function required(): self
    {
        $this->required = 'required';
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function size(string $size): self
    {
        $this->size = $size;
        return $this;
    }

    public function maxlength(string $maxlength): self
    {
        $this->maxlength = $maxlength;
        return $this;
    }

    public function pattern(string $pattern): self
    {
        $this->pattern = $pattern;
        return $this;
    }

    public function min(string $min): self
    {
        $this->min = $min;
        return $this;
    }

    public function max(string $max): self
    {
        $this->max = $max;
        return $this;
    }

    public function step(string $step): self
    {
        $this->step = $step;
        return $this;
    }

    public function multiple(): self
    {
        $this->multiple = 'multiple';
        return $this;
    }

    public function autofocus(): self
    {
        $this->autofocus = 'autofocus';
        return $this;
    }

    public function autocomplete(string $autocomplete): self
    {
        $this->autocomplete = $autocomplete;
        return $this;
    }

    public function autocapitalize(string $autocapitalize): self
    {
        $this->autocapitalize = $autocapitalize;
        return $this;
    }

    public function prefix(string $prefix): self
    {
        $this->prefix = $prefix;
        return $this;
    }

    public function suffix(string $suffix): self
    {
        $this->suffix = $suffix;
        return $this;
    }

    public function prefixIcon(string $prefixIcon): self
    {
        $this->prefixIcon = $prefixIcon;
        return $this;
    }

    public function suffixIcon(string $suffixIcon): self
    {
        $this->suffixIcon = $suffixIcon;
        return $this;
    }

    public function render(): string
    {
        $column        = $this->getColumns();
        $columnMargin  = $this->getColumnMargin();
        $columnPadding = $this->getColumnPadding();
        $columnSpan    = $this->getColumnSpan();


        return '';
    }
}