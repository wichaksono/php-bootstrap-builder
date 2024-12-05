<?php
declare(strict_types=1);

namespace NeonWebId\Classes\Common\Interfaces;

interface FieldInterface extends ElementInterface
{
    public function render(): string;
}