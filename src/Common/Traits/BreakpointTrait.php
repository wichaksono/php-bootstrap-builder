<?php

declare(strict_types=1);

namespace NeonWebId\Common\Traits;

use function in_array;
use function is_scalar;
use function var_dump;

trait BreakpointTrait
{
    /**
     * Available Breakpoints
     * - default : ''
     * - sm
     * - md
     * - lg
     * - xl
     * - xxl
     */
    private array $availableBreakpoints = [
        'default',
        'xs',
        'sm',
        'md',
        'lg',
        'xl',
        'xxl',
    ];

    private array $generalBreakpoints = [
        'default',
        'xs',
    ];

    private function generateVisibilities(string|int|array $properties, string $prefix, string $suffix = ''): array
    {
        $visibilities = [];
        $_properties  = [];

        if (is_scalar($properties) && $properties !== '') {
            $_properties['default'] = $properties;
        } else {
            $_properties = $properties;
        }

        foreach ($_properties as $display => $value) {
            if (in_array($display, $this->availableBreakpoints) && $value !== '') {
                $display = in_array($display, $this->generalBreakpoints) ? '' : "-{$display}";

                $visibilities["{$prefix}{$display}{$suffix}"] = $value;
            }
        }

        return $visibilities;
    }
}