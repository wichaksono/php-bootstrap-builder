<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Common\Traits;

use function trim;

trait ColumnTrait
{
    private array|int $columns = [];

    private array|int|string $columnSpan = [];

    private string|int|array $columnMargin = '';

    private array $columnsMargins = [
        'x' => '',
        'y' => '',
        't' => '',
        'b' => '',
        's' => '',
        'e' => '',
    ];

    private string|int|array $columPadding = '';

    private array $columPaddings = [
        'x' => '',
        'y' => '',
        't' => '',
        'b' => '',
        's' => '',
        'e' => '',
    ];

    public function columns(array|int $columns): self
    {
        $this->columns = $columns;
        return $this;
    }

    public function columnSpan(array|int|string $columnSpan): self
    {
        $this->columnSpan = $columnSpan;
        return $this;
    }

    public function columnMargin(string|int|array $value):self
    {
        $this->columnMargin = $value;
        return $this;
    }

    public function columnMarginX(string|int|array $value):self
    {
        $this->columnsMargins['x'] = $value;
        return $this;
    }

    public function columnMarginY(string|int|array $value):self
    {
        $this->columnsMargins['y'] = $value;
        return $this;
    }

    public function columnMarginTop(string|int|array $value):self
    {
        $this->columnsMargins['t'] = $value;
        return $this;
    }

    public function columnsMarginBottom(string|int|array $value):self
    {
        $this->columnsMargins['b'] = $value;
        return $this;
    }

    public function columnMarginStart(string|int|array $value):self
    {
        $this->columnsMargins['s'] = $value;
        return $this;
    }

    public function columnMarginEnd(string|int|array $value):self
    {
        $this->columnsMargins['e'] = $value;
        return $this;
    }

    public function columnPadding(string|int|array $value):self
    {
        $this->columPadding = $value;
        return $this;
    }

    public function columnPaddingX(string|int|array $value):self
    {
        $this->columPaddings['x'] = $value;
        return $this;
    }

    public function columnPaddingY(string|int|array $value):self
    {
        $this->columPaddings['y'] = $value;
        return $this;
    }

    public function columnPaddingTop(string|int|array $value):self
    {
        $this->columPaddings['t'] = $value;
        return $this;
    }

    public function columnPaddingBottom(string|int|array $value):self
    {
        $this->columPaddings['b'] = $value;
        return $this;
    }

    public function columnPaddingStart(string|int|array $value):self
    {
        $this->columPaddings['s'] = $value;
        return $this;
    }

    public function columnPaddingEnd(string|int|array $value):self
    {
        $this->columPaddings['e'] = $value;
        return $this;
    }

    public function getColumnMargin():string
    {
        $columnMarginClass = '';

        if (is_array($this->columnMargin)) {
            foreach ($this->columnMargin as $key => $value) {
                $columnMarginClass .= 'col-' . $key . '-' . $value . ' ';
            }
        } else {
            $columnMarginClass = 'col-' . $this->columnMargin;
        }

        return trim($columnMarginClass);
    }

    public function getColumnPadding():string
    {
        $columnPaddingClass = '';

        if (is_array($this->columPadding)) {
            foreach ($this->columPadding as $key => $value) {
                $columnPaddingClass .= 'col-' . $key . '-' . $value . ' ';
            }
        } else {
            $columnPaddingClass = 'col-' . $this->columPadding;
        }

        return trim($columnPaddingClass);
    }


    public function getColumns():string
    {
        $columnClass = '';

        if (is_array($this->columns)) {
            foreach ($this->columns as $key => $value) {
                $columnClass .= $key === 'default'
                    ? 'split-col-' . $value  : 'split-col-' . $key . '-' . $value;
                $columnClass .= ' ';
            }
        } else {
            $columnClass = 'split-col-' . $this->columns;
        }

        return trim($columnClass);
    }

    private function columnSpanCalculate(array|int $columns):string
    {
       return '';
    }
}