<?php

declare(strict_types=1);

namespace NeonWebId\Layouts;

use NeonWebId\Common\Abstracts\RenderAbstract;

class Grid extends RenderAbstract
{

    private function __construct(array $columns = [])
    {
        $this->columns($columns);
    }

    public static function make(array $columns = []): self
    {
        return new self($columns);
    }

}
