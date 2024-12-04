<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Common\Traits;

use function trim;

trait ColumnTrait
{
    private array|int $columns = [];

    private array|int|string $columnSpan = [];

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

    public function getColumns():string
    {
        $columnClass = '';

        if (is_array($this->columns)) {
            foreach ($this->columns as $key => $value) {
                $columnClass .= $key === 'default'
                    ? 'col-' . $value  : 'col-' . $key . '-' . $value;
                $columnClass .= ' ';
            }
        } else {
            $columnClass = 'col-' . $this->columns;
        }

        return trim($columnClass);
    }

    public function getColumnSpan():string
    {
        $columnSpanClass = '';

        if (is_array($this->columnSpan)) {
            foreach ($this->columnSpan as $key => $value) {
                $columnSpanClass .= 'col-' . $key . '-span-' . $value . ' ';
            }
        } else {
            $columnSpanClass = 'col-' . $this->columnSpan;
        }

        return $columnSpanClass;
    }
}