<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Layouts;

use NeonWebId\Classes\Common\Interfaces\SchemaInterface;
use NeonWebId\Classes\Common\Traits\SchemaTrait;

class FlexItem implements SchemaInterface
{
    use SchemaTrait;

    private string $id = '';

    private string|array $class = '';

    private string|array $flexFill = '';

    private string|array $autoMarginStart = '';



    public function render(): string
    {
        // TODO: Implement render() method.
    }
}