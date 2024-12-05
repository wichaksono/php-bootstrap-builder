<?php
declare(strict_types=1);

namespace NeonWebId\Classes\Common\Interfaces;

interface ElementInterface
{
    public function render(): string;
}