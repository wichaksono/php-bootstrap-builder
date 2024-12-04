<?php
declare(strict_types=1);

namespace NeonWebId\Classes\Common\Interfaces;

interface SchemaInterface
{
    public function render(): string;
}