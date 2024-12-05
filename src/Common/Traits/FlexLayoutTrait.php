<?php

declare(strict_types=1);

namespace NeonWebId\Common\Traits;

use function implode;
use function in_array;
use function is_array;
use function is_string;

trait FlexLayoutTrait
{
    use LayoutContainerTrait;

    /**
     * Available Flex Direction Values
     * - row
     * - row-reverse
     * - column
     * - column-reverse
     */
    private array $direction = [];

    private array $grow = [];

    private array $shrink = [];

    /**
     * Available Gap Values
     * - default
     * - row
     * - column
     * - [
     *    'default' => 0,
     *    'row' => 0,
     *    'column' => 0,
     * ]
     */
    private array $gap = [];

    /**
     * Available Wrap Values
     * - true
     * - false
     */
    private bool $nowrap = false;



    /**
     * Set the flex direction
     *
     * @param string|array $direction
     *
     * @return $this
     */
    public function direction(string|array $direction = 'row'): self
    {
        if (is_string($direction)) {
            $this->direction[] = "flex-$direction";
            return $this;
        }

        // If the direction is an array, apply specific directions for each breakpoint
        if (is_array($direction)) {
            // Handle 'default' case, which applies to all breakpoints
            if (isset($direction['default'])) {
                $defaultDirection  = $direction['default'];
                $this->direction[] = "flex-{$defaultDirection}";
                unset($direction['default']); // Remove the default key after applying it
            }

            // Now handle individual breakpoints
            foreach ($direction as $display => $value) {
                // If the display is a valid breakpoint, apply the direction for that specific display
                if (in_array($display, $this->availableResponsiveDisplay)) {
                    $this->direction[] = "flex-{$display}-{$value}";
                }
            }
        }

        return $this;
    }

    /**
     * Set the gap
     *
     * @param int|array $gap
     *
     * @return $this
     */
    public function gap(int $gap = 0): self
    {
        $this->gap['row']    = $gap;
        $this->gap['column'] = $gap;
        return $this;
    }

    /**
     * Set the gap row
     *
     * @param int $gap
     *
     * @return $this
     */
    public function gapRow(int $gap = 0): self
    {
        $this->gap['row'] = $gap;
        return $this;
    }

    /**
     * Set the gap column
     *
     * @param int $gap
     *
     * @return $this
     */
    public function gapColumn(int $gap = 0): self
    {
        $this->gap['column'] = $gap;
        return $this;
    }

    /**
     * Get the container classes
     *
     * @return string
     */
    private function getContainerClasses(): string
    {
        $classes = [];

        foreach ($this->direction as $direction) {
            $classes[] = $direction;
        }

        foreach ($this->justifyContent as $justifyContent) {
            $classes[] = $justifyContent;
        }

        foreach ($this->alignItems as $alignItems) {
            $classes[] = $alignItems;
        }

        foreach ($this->alignContent as $alignContent) {
            $classes[] = $alignContent;
        }

        foreach ($this->alignSelf as $alignSelf) {
            $classes[] = $alignSelf;
        }

        // Generating classes with reduced redundancy
        if ($this->gap) {
            // Check if both row and column are set and equal
            if (isset($this->gap['row'], $this->gap['column']) && $this->gap['row'] === $this->gap['column']) {
                $classes[] = "gap-{$this->gap['row']}";
            } else {
                // Add separate row and column gaps if they are different
                if (isset($this->gap['row'])) {
                    $classes[] = "row-gap-{$this->gap['row']}";
                }
                if (isset($this->gap['column'])) {
                    $classes[] = "column-gap-{$this->gap['column']}";
                }
            }
        }


        if ($this->nowrap) {
            $classes[] = 'flex-nowrap';
        }

        return implode(' ', $classes);
    }
}