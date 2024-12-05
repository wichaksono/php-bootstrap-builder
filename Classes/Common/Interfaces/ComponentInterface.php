<?php
declare(strict_types=1);

namespace NeonWebId\Classes\Common\Interfaces;

interface ComponentInterface extends ElementInterface
{
    public function getColumnSpan():string;

    public function render(): string;
}