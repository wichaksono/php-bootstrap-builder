<?php

declare(strict_types=1);

namespace NeonWebId\Common\Traits;

use function implode;
use function in_array;
use function is_array;
use function is_int;
use function trim;

trait LayoutColumnsTrait
{
    use BreakpointTrait;

    /**
     * Available Columns Values
     * - default
     * - first
     * - last
     * - 1
     * - 2
     * - 3
     * - 4
     * - 5
     *
     * [
     *   'default' => 0,
     *   'sm' => 'last',
     *   'md' => 'first',
     *   'lg' => 1,
     *   'xl' => 1,
     *   'xxl' => 1,
     * ]
     */
    private array $order = [];

    /**
     * Available Columns Values
     * - default : 1
     * - 1 ... 12
     * [
     *   'default' => 1,
     *   'sm' => 1,
     *   'md' => 4,
     *   'lg' => 6,
     * ]
     */
    private array $columns = [];

    /**
     * Available ColumnSpan Values
     * - default : 1
     * - 1 ... 12
     * [
     *   'default' => 1,
     *   'sm' => 1,
     *   'md' => 4,
     *   'lg' => 6,
     * ]
     */
    private array $columnSpan = [];

    /**
     * Columns
     */

    public function order(int|array $order = 0): self
    {
        if (is_int($order)) {
            $this->order[] = "order-{$order}";
            return $this;
        }

        if (is_array($order)) {
            // Handle 'default' case
            if (isset($order['default'])) {
                $defaultOrder = $order['default'];
                $this->order[] = "order-{$defaultOrder}";
                unset($order['default']);
            }

            // Apply specific breakpoint orders
            foreach ($order as $display => $value) {
                if (in_array($display, $this->availableBreakpoints)) {
                    $this->order[] = "order-{$display}-{$value}";
                }
            }
        }

        return $this;
    }

    public function columns(int|array $columns = 1): self
    {
        if ( is_int($columns) ) {
            $this->columns["split-col"] = $columns;
            return $this;
        }

        if ( is_array($columns) ) {
            // Handle 'default' case
            if ( isset($columns['default']) ) {
                $defaultColumns = $columns['default'];
                $this->columns["split-col"] = $defaultColumns;
                unset($columns['default']);
            }

            // Apply specific breakpoint columns
            foreach ( $columns as $display => $value ) {
                if ( in_array($display, $this->availableBreakpoints) ) {
                    $this->columns["split-col-{$display}"] = $value;
                }
            }
        }

        return $this;
    }

    public function getColumns():string
    {
        unset($this->columns['default']);
        $classes = [];
        foreach ($this->columns as $column => $value) {
            $classes[]= "{$column}-{$value}";
        }

        return implode(' ', $classes);
    }

    public function columnSpan(int|array $columnSpan = 0): self
    {
        $this->columnSpan = is_int($columnSpan) ? ['default' => $columnSpan] : $columnSpan;
        return $this;
    }

    public function getColumnClasses(array $parentColumns):string
    {
        $columns = [];

        if ($this->columnSpan) {
            foreach ($parentColumns as  $display => $value) {
                $display    = $display === 'default' ? 'split-col' : $display;
                $columnSpan = $this->columnSpan[$display] ?? $this->columnSpan['default'];
                if ($columnSpan > 0 ) {
                    $calc = $value - $columnSpan;
                    $columns[$display] = $calc > 0 ? $calc : 1;
                }
            }
        }

        $classes = '';

        if ($columns) {
            unset($columns['default']);
            foreach ($columns as $display => $value) {
                $classes .= "{$display}-{$value} ";
            }
        } else {
            unset($parentColumns['default']);
            foreach ($parentColumns as $display => $value) {
                $classes .= "{$display}-{$value} ";
            }
        }

        $classes .= " " . $this->getColumnsMarginClasses();
        $classes .= " " . $this->getColumnsPaddingClasses();

        return trim($classes);
    }

}