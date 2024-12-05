<?php

declare(strict_types=1);

namespace NeonWebId\Common\Traits;

use function array_merge;
use function array_unique;
use function count;
use function implode;
use function is_array;
use function reset;

/**
 * Trait for handling spacing (margin and padding) in a flexible manner.
 * Allows setting margins and paddings with different options for each side.
 * It supports both string and array input for defining values for all sides.
 */
trait SpacingTrait
{
    use ResponsiveDisplayTrait;

    /**
     * Default spacing values applied to all sides.
     * Each side (t, b, s, e) defaults to a value of empty-string.
     *
     * @var array<string, string>
     */
    private array $defaultSpacing = [
        't' => '', // Top spacing
        'b' => '', // Bottom spacing
        's' => '', // Start (left in LTR languages)
        'e' => '', // End (right in LTR languages)
    ];

    /**
     * Array to hold margin values.
     *
     * @var array<string, string>
     */
    private array $margin = [];

    /**
     * Array to hold padding values.
     *
     * @var array<string, string>
     */
    private array $padding = [];

    /**
     * Array to hold columnsMargin values.
     *
     * @var array<string, string>
     */
    private array $columnsMargin = [];

    /**
     * Array to hold columnsPadding values.
     *
     * @var array<string, string>
     */
    private array $columnsPadding = [];

    /**
     * Set margin values.
     *
     * @param string|int|array $value The margin value or array of values for different sides.
     *
     * @return $this
     */
    public function margin(string|int|array $value): self
    {
        $this->margin = $this->processSpacing($value);
        return $this;
    }

    /**
     * Set the margin for the top side.
     *
     * @param string|int $value The margin value for the top side.
     *
     * @return $this
     */
    public function marginTop(string|int $value): self
    {
        $this->margin['t'] = $value;
        return $this;
    }

    /**
     * Set the margin for the bottom side.
     *
     * @param string|int $value The margin value for the bottom side.
     *
     * @return $this
     */
    public function marginBottom(string|int $value): self
    {
        $this->margin['b'] = $value;
        return $this;
    }

    /**
     * Set the margin for the start side (left in LTR languages).
     *
     * @param string|int $value The margin value for the start side.
     *
     * @return $this
     */
    public function marginStart(string|int $value): self
    {
        $this->margin['s'] = $value;
        return $this;
    }

    /**
     * Set the margin for the end side (right in LTR languages).
     *
     * @param string|int $value The margin value for the end side.
     *
     * @return $this
     */
    public function marginEnd(string|int $value): self
    {
        $this->margin['e'] = $value;
        return $this;
    }

    /**
     * Set the horizontal margin (left and right).
     *
     * @param string|int $value The margin value for the left and right sides.
     *
     * @return $this
     */
    public function marginX(string|int $value): self
    {
        $this->margin['s'] = $value;
        $this->margin['e'] = $value;
        return $this;
    }

    /**
     * Set the vertical margin (top and bottom).
     *
     * @param string|int $value The margin value for the top and bottom sides.
     *
     * @return $this
     */
    public function marginY(string|int $value): self
    {
        $this->margin['t'] = $value;
        $this->margin['b'] = $value;
        return $this;
    }

    /**
     * Set padding values.
     *
     * @param string|int|array $value The padding value or array of values for different sides.
     *
     * @return $this
     */
    public function padding(string|int|array $value): self
    {
        $this->padding = $this->processSpacing($value);
        return $this;
    }

    /**
     * Set the padding for the top side.
     *
     * @param string|int $value The padding value for the top side.
     *
     * @return $this
     */
    public function paddingTop(string|int $value): self
    {
        $this->padding['t'] = $value;
        return $this;
    }

    /**
     * Set the padding for the bottom side.
     *
     * @param string|int $value The padding value for the bottom side.
     *
     * @return $this
     */
    public function paddingBottom(string|int $value): self
    {
        $this->padding['b'] = $value;
        return $this;
    }

    /**
     * Set the padding for the start side (left in LTR languages).
     *
     * @param string|int $value The padding value for the start side.
     *
     * @return $this
     */
    public function paddingStart(string|int $value): self
    {
        $this->padding['s'] = $value;
        return $this;
    }

    /**
     * Set the padding for the end side (right in LTR languages).
     *
     * @param string|int $value The padding value for the end side.
     *
     * @return $this
     */
    public function paddingEnd(string|int $value): self
    {
        $this->padding['e'] = $value;
        return $this;
    }

    /**
     * Set the horizontal padding (left and right).
     *
     * @param string|int $value The padding value for the left and right sides.
     *
     * @return $this
     */
    public function paddingX(string|int $value): self
    {
        $this->padding['s'] = $value;
        $this->padding['e'] = $value;
        return $this;
    }

    /**
     * Set the vertical padding (top and bottom).
     *
     * @param string|int $value The padding value for the top and bottom sides.
     *
     * @return $this
     */
    public function paddingY(string|int $value): self
    {
        $this->padding['t'] = $value;
        $this->padding['b'] = $value;
        return $this;
    }

    /**
     * Helper function to process margin/padding input.
     * Converts string to array and merges with default spacing values.
     *
     * @param string|int|array $value The value or array of values for spacing.
     *
     * @return array<string, string> Processed spacing values.
     */
    private function processSpacing(string|int|array $value): array
    {
        // If the value is an array, merge with default spacing
        if (is_array($value)) {
            return $value + $this->defaultSpacing;
        }

        // If the value is a string or integer, apply it to specific sides:
        if (is_string($value) || is_int($value)) {
            return [
                't' => $value,  // Top margin
                'b' => $value,  // Bottom margin
                's' => $value,  // Start margin (left in LTR)
                'e' => $value,  // End margin (right in LTR)
            ];
        }

        // Return the default spacing if it's not a valid value
        return $this->defaultSpacing;
    }

    /**
     * Converts a spacing array into a space-separated string of CSS utility class names.
     *
     * This function generates class names with a specified prefix (`m` for margin or `p` for padding).
     * It applies shorthand classes (e.g., `my-`, `mx-`) when possible,
     * and falls back to individual classes (e.g., `mt-`, `mb-`) when values are inconsistent.
     *
     * Logic:
     * - Combines default spacing values with the provided array.
     * - Checks consistency for vertical (`t` and `b`) and horizontal (`s` and `e`) axes.
     * - Use shorthand (e.g., `my-`, `mx-`) for consistent values.
     * - Falls back to individual classes (e.g., `mt-`, `mb-`) for inconsistent values.
     *
     * @param string $prefix The prefix for the CSS class names ('m' for margin, 'p' for padding).
     * @param array<string, string> $spacing An associative array of spacing values with keys:
     *  - 't' (top)
     *  - 'b' (bottom)
     *  - 's' (start/left)
     *  - 'e' (end/right)
     *
     * @return string Space-separated class names generated based on the spacing values.
     */
    private function getSpacingString(string $prefix, array $spacing): string
    {
        if (empty($spacing)) {
            // Early exit if spacing is empty
            return '';
        }

        // Merge default values to ensure all keys ('t', 'b', 's', 'e') are set
        $spacing = array_merge($this->defaultSpacing, $spacing);

        $spacings = [];

        // Check for vertical axis (top and bottom) consistency
        if ($spacing['t'] === $spacing['b'] && $spacing['t'] !== '') {
            // Use shorthand for consistent top and bottom values
            $spacings[] = "{$prefix}y-{$spacing['t']}";
        } else {
            // Use individual classes for inconsistent values
            if ($spacing['t'] !== '') {
                $spacings[] = "{$prefix}t-{$spacing['t']}";
            }
            if ($spacing['b'] !== '') {
                $spacings[] = "{$prefix}b-{$spacing['b']}";
            }
        }

        // Check for horizontal axis (start and end) consistency
        if ($spacing['s'] === $spacing['e'] && $spacing['s'] !== '') {
            // Use shorthand for consistent start and end values
            $spacings[] = "{$prefix}x-{$spacing['s']}";
        } else {
            // Use individual classes for inconsistent values
            if ($spacing['s'] !== '') {
                $spacings[] = "{$prefix}s-{$spacing['s']}";
            }
            if ($spacing['e'] !== '') {
                $spacings[] = "{$prefix}e-{$spacing['e']}";
            }
        }

        // Handle case where all values are the same (e.g., 'm-2')
        if (count(array_unique($spacing)) === 1 && reset($spacing) !== '') {
            return "{$prefix}-" . reset($spacing);
        }

        // Join all generated class names with space
        return implode(' ', $spacings);
    }


    /**
     * Get the margin as a space-separated string with the 'm' prefix.
     *
     * @return string Space-separated margin class names.
     */
    private function getMarginClasses(): string
    {
        return $this->getSpacingString('m', $this->margin);
    }

    /**
     * Get the padding as a space-separated string with the 'p' prefix.
     *
     * @return string Space-separated padding class names.
     */
    private function getPaddingClasses(): string
    {
        return $this->getSpacingString('p', $this->padding);
    }

    /**
     * Set columnsMargin values.
     *
     * @param string|int|array $value The columnsMargin value or array of values for different sides.
     *
     * @return $this
     */
    public function columnsMargin(string|int|array $value): self
    {
        $this->columnsMargin = $this->processSpacing($value);
        return $this;
    }

    /**
     * Set the columnsMargin for the top side.
     *
     * @param string|int $value The columnsMargin value for the top side.
     *
     * @return $this
     */
    public function columnsMarginTop(string|int $value): self
    {
        $this->columnsMargin['t'] = $value;
        return $this;
    }

    /**
     * Set the columnsMargin for the bottom side.
     *
     * @param string|int $value The columnsMargin value for the bottom side.
     *
     * @return $this
     */
    public function columnsMarginBottom(string|int $value): self
    {
        $this->columnsMargin['b'] = $value;
        return $this;
    }

    /**
     * Set the columnsMargin for the start side (left in LTR languages).
     *
     * @param string|int $value The columnsMargin value for the start side.
     *
     * @return $this
     */
    public function columnsMarginStart(string|int $value): self
    {
        $this->columnsMargin['s'] = $value;
        return $this;
    }

    /**
     * Set the columnsMargin for the end side (right in LTR languages).
     *
     * @param string|int $value The columnsMargin value for the end side.
     *
     * @return $this
     */
    public function columnsMarginEnd(string|int $value): self
    {
        $this->columnsMargin['e'] = $value;
        return $this;
    }

    /**
     * Set the horizontal columnsMargin (left and right).
     *
     * @param string|int $value The columnsMargin value for the left and right sides.
     *
     * @return $this
     */
    public function columnsMarginX(string|int $value): self
    {
        $this->columnsMargin['s'] = $value;
        $this->columnsMargin['e'] = $value;
        return $this;
    }

    /**
     * Set the vertical columnsMargin (top and bottom).
     *
     * @param string|int $value The columnsMargin value for the top and bottom sides.
     *
     * @return $this
     */
    public function columnsMarginY(string|int $value): self
    {
        $this->columnsMargin['t'] = $value;
        $this->columnsMargin['b'] = $value;
        return $this;
    }

    /**
     * Set columnsPadding values.
     *
     * @param string|int|array $value The columnsPadding value or array of values for different sides.
     *
     * @return $this
     */
    public function columnsPadding(string|int|array $value): self
    {
        $this->columnsPadding = $this->processSpacing($value);
        return $this;
    }

    /**
     * Set the columnsPadding for the top side.
     *
     * @param string|int $value The columnsPadding value for the top side.
     *
     * @return $this
     */
    public function columnsPaddingTop(string|int $value): self
    {
        $this->columnsPadding['t'] = $value;
        return $this;
    }

    /**
     * Set the columnsPadding for the bottom side.
     *
     * @param string|int $value The columnsPadding value for the bottom side.
     *
     * @return $this
     */
    public function columnsPaddingBottom(string|int $value): self
    {
        $this->columnsPadding['b'] = $value;
        return $this;
    }

    /**
     * Set the columnsPadding for the start side (left in LTR languages).
     *
     * @param string|int $value The columnsPadding value for the start side.
     *
     * @return $this
     */
    public function columnsPaddingStart(string|int $value): self
    {
        $this->columnsPadding['s'] = $value;
        return $this;
    }

    /**
     * Set the columnsPadding for the end side (right in LTR languages).
     *
     * @param string|int $value The columnsPadding value for the end side.
     *
     * @return $this
     */
    public function columnsPaddingEnd(string|int $value): self
    {
        $this->columnsPadding['e'] = $value;
        return $this;
    }

    /**
     * Set the horizontal columnsPadding (left and right).
     *
     * @param string|int $value The columnsPadding value for the left and right sides.
     *
     * @return $this
     */
    public function columnsPaddingX(string|int $value): self
    {
        $this->columnsPadding['s'] = $value;
        $this->columnsPadding['e'] = $value;
        return $this;
    }

    /**
     * Set the vertical columnsPadding (top and bottom).
     *
     * @param string|int $value The columnsPadding value for the top and bottom sides.
     *
     * @return $this
     */
    public function columnsPaddingY(string|int $value): self
    {
        $this->columnsPadding['t'] = $value;
        $this->columnsPadding['b'] = $value;
        return $this;
    }


    /**
     * Get the columnsMargin as a space-separated string with the 'm' prefix.
     *
     * @return string Space-separated columnsMargin class names.
     */
    private function getColumnsMarginClasses(): string
    {
        return $this->getSpacingString('m', $this->columnsMargin);
    }

    /**
     * Get the columnsPadding as a space-separated string with the 'p' prefix.
     *
     * @return string Space-separated columnsPadding class names.
     */
    private function getColumnsPaddingClasses(): string
    {
        return $this->getSpacingString('p', $this->columnsPadding);
    }
}
