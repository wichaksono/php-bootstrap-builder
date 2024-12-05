<?php
declare(strict_types=1);

namespace NeonWebId\Classes\Common\Interfaces;

interface ContentInterface extends ElementInterface
{
    public function getColumnSpan():string;

    public function render(): string;
}