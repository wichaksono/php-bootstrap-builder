<?php

declare(strict_types=1);

namespace NeonWebId\Common\Traits;

trait ResponsiveDisplayTrait
{
    /**
     * Available Responsive Display Values
     * - default : ''
     * - sm
     * - md
     * - lg
     * - xl
     * - xxl
     */
    private array $availableResponsiveDisplay = [
        '',
        'sm',
        'md',
        'lg',
        'xl',
        'xxl',
    ];
}