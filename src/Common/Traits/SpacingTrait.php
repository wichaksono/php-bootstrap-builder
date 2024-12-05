<?php

declare(strict_types=1);

namespace NeonWebId\Common\Traits;

use function array_merge;
use function implode;
use function in_array;
use function print_r;

/**
 * Trait for handling spacing (margin and padding) in a flexible manner.
 * Allows setting margins and paddings with different options for each side.
 * It supports both string and array input for defining values for all sides.
 */
trait SpacingTrait
{
    use BreakpointTrait;

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
        $this->marginTop($value);
        $this->marginBottom($value);
        $this->marginStart($value);
        $this->marginEnd($value);
        return $this;
    }

    /**
     * Set the margin for the top side.
     *
     * @param string|int $value The margin value for the top side.
     *
     * @return $this
     */
    public function marginTop(string|int|array $value): self
    {
        $this->margin = array_merge($this->margin, $this->generateVisibilities($value, 'mt'));
        return $this;
    }

    /**
     * Set the margin for the bottom side.
     *
     * @param string|int $value The margin value for the bottom side.
     *
     * @return $this
     */
    public function marginBottom(string|int|array $value): self
    {
        $this->margin = array_merge($this->margin, $this->generateVisibilities($value, 'mb'));
        return $this;
    }

    /**
     * Set the margin for the start side (left in LTR languages).
     *
     * @param string|int $value The margin value for the start side.
     *
     * @return $this
     */
    public function marginStart(string|int|array $value): self
    {
        $this->margin = array_merge($this->margin, $this->generateVisibilities($value, 'ms'));
        return $this;
    }

    /**
     * Set the margin for the end side (right in LTR languages).
     *
     * @param string|int $value The margin value for the end side.
     *
     * @return $this
     */
    public function marginEnd(string|int|array $value): self
    {
        $this->margin = array_merge($this->margin, $this->generateVisibilities($value, 'me'));
        return $this;
    }

    /**
     * Set the horizontal margin (left and right).
     *
     * @param string|int $value The margin value for the left and right sides.
     *
     * @return $this
     */
    public function marginX(string|int|array $value): self
    {
        $this->marginStart($value);
        $this->marginEnd($value);
        return $this;
    }

    /**
     * Set the vertical margin (top and bottom).
     *
     * @param string|int $value The margin value for the top and bottom sides.
     *
     * @return $this
     */
    public function marginY(string|int|array $value): self
    {
        $this->marginTop($value);
        $this->marginBottom($value);
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
        $this->paddingStart($value);
        $this->paddingEnd($value);
        $this->paddingTop($value);
        $this->paddingBottom($value);

        return $this;
    }

    /**
     * Set the padding for the top side.
     *
     * @param string|int $value The padding value for the top side.
     *
     * @return $this
     */
    public function paddingTop(string|int|array $value): self
    {
        $this->padding = array_merge($this->padding, $this->generateVisibilities($value, 'pt'));
        return $this;
    }

    /**
     * Set the padding for the bottom side.
     *
     * @param string|int $value The padding value for the bottom side.
     *
     * @return $this
     */
    public function paddingBottom(string|int|array $value): self
    {
        $this->padding = array_merge($this->padding, $this->generateVisibilities($value, 'pb'));
        return $this;
    }

    /**
     * Set the padding for the start side (left in LTR languages).
     *
     * @param string|int $value The padding value for the start side.
     *
     * @return $this
     */
    public function paddingStart(string|int|array $value): self
    {
        $this->padding = array_merge($this->padding, $this->generateVisibilities($value, 'ps'));
        return $this;
    }

    /**
     * Set the padding for the end side (right in LTR languages).
     *
     * @param string|int $value The padding value for the end side.
     *
     * @return $this
     */
    public function paddingEnd(string|int|array $value): self
    {
        $this->padding = array_merge($this->padding, $this->generateVisibilities($value, 'pe'));
        return $this;
    }

    /**
     * Set the horizontal padding (left and right).
     *
     * @param string|int $value The padding value for the left and right sides.
     *
     * @return $this
     */
    public function paddingX(string|int|array $value): self
    {
        $this->paddingStart($value);
        $this->paddingEnd($value);
        return $this;
    }

    /**
     * Set the vertical padding (top and bottom).
     *
     * @param string|int $value The padding value for the top and bottom sides.
     *
     * @return $this
     */
    public function paddingY(string|int|array $value): self
    {
        $this->paddingTop($value);
        $this->paddingBottom($value);
        return $this;
    }

    private function processSpacing(string|int|array $value): array
    {
        return $this->defaultSpacing;
    }


    private function getSpacingString(string $prefix, array $spacing): string
    {
        $defaultSpacings = [];
        foreach ($this->availableBreakpoints as $breakpoint) {
            if ( ! in_array($breakpoint, ['default', 'xs'])) {
                $defaultSpacings["{$prefix}t-{$breakpoint}"] = "";
                $defaultSpacings["{$prefix}b-{$breakpoint}"] = "";
                $defaultSpacings["{$prefix}s-{$breakpoint}"] = "";
                $defaultSpacings["{$prefix}e-{$breakpoint}"] = "";
            }
        }

        $spacings = array_merge($defaultSpacings, $spacing);

        $_spacings = [];
        foreach ($spacings as $key => $value) {
            if ($value !== '') {
                $_spacings[$key] = $value;
            }
        }

        if (
            isset($_spacings[$prefix . 't'])
            && isset($_spacings[$prefix . 'b'])
            && $_spacings[$prefix . 't'] === $_spacings[$prefix . 'b']) {
            $_spacings[$prefix . 'y'] = $_spacings[$prefix . 't'];
            unset($_spacings[$prefix . 't']);
            unset($_spacings[$prefix . 'b']);
        }

        if (
            isset($_spacings[$prefix . 's'])
            && isset($_spacings[$prefix . 'e'])
            && $_spacings[$prefix . 's'] === $_spacings[$prefix . 'e']) {
            $_spacings[$prefix . 'x'] = $_spacings[$prefix . 's'];
            unset($_spacings[$prefix . 's']);
            unset($_spacings[$prefix . 'e']);
        }

        if (
            isset($_spacings[$prefix . 'x'])
            && isset($_spacings[$prefix . 'y'])
            && $_spacings[$prefix . 'x'] === $_spacings[$prefix . 'y']
        ) {
            $_spacings[$prefix] = $_spacings[$prefix . 'x'];
            unset($_spacings[$prefix . 'x']);
            unset($_spacings[$prefix . 'y']);
        }

        // -sm
        if (isset($_spacings[$prefix . 't-sm'])
            && isset($_spacings[$prefix . 'b-sm'])
            && $_spacings[$prefix . 't-sm'] === $_spacings[$prefix . 'b-sm']) {
            $_spacings[$prefix . 'y-sm'] = $_spacings[$prefix . 't-sm'];
            unset($_spacings[$prefix . 't-sm']);
            unset($_spacings[$prefix . 'b-sm']);
        }

        if (isset($_spacings[$prefix . 's-sm'])
            && isset($_spacings[$prefix . 'e-sm'])
            && $_spacings[$prefix . 's-sm'] === $_spacings[$prefix . 'e-sm']) {
            $_spacings[$prefix . 'x-sm'] = $_spacings[$prefix . 's-sm'];
            unset($_spacings[$prefix . 's-sm']);
            unset($_spacings[$prefix . 'e-sm']);
        }

        if (
            isset($_spacings[$prefix . 'x-sm'])
            && isset($_spacings[$prefix . 'y-sm'])
            && $_spacings[$prefix . 'x-sm'] === $_spacings[$prefix . 'y-sm']
        ) {
            $_spacings[$prefix . '-sm'] = $_spacings[$prefix . 'x-sm'];
            unset($_spacings[$prefix . 'x-sm']);
            unset($_spacings[$prefix . 'y-sm']);
        }

        //  -md
        if (isset($_spacings[$prefix . 't-md'])
            && isset($_spacings[$prefix . 'b-md'])
            && $_spacings[$prefix . 't-md'] === $_spacings[$prefix . 'b-md']) {
            $_spacings[$prefix . 'y-md'] = $_spacings[$prefix . 't-md'];
            unset($_spacings[$prefix . 't-md']);
            unset($_spacings[$prefix . 'b-md']);
        }

        if (isset($_spacings[$prefix . 's-md'])
            && isset($_spacings[$prefix . 'e-md'])
            && $_spacings[$prefix . 's-md'] === $_spacings[$prefix . 'e-md']) {
            $_spacings[$prefix . 'x-md'] = $_spacings[$prefix . 's-md'];
            unset($_spacings[$prefix . 's-md']);
            unset($_spacings[$prefix . 'e-md']);
        }

        if (
            isset($_spacings[$prefix . 'x-md'])
            && isset($_spacings[$prefix . 'y-md'])
            && $_spacings[$prefix . 'x-md'] === $_spacings[$prefix . 'y-md']
        ) {
            $_spacings[$prefix . '-md'] = $_spacings[$prefix . 'x-md'];
            unset($_spacings[$prefix . 'x-md']);
            unset($_spacings[$prefix . 'y-md']);
        }

        // -lg
        if (isset($_spacings[$prefix . 't-lg']) && $_spacings[$prefix . 't-lg'] === $_spacings[$prefix . 'b-lg']) {
            $_spacings[$prefix . 'y-lg'] = $_spacings[$prefix . 't-lg'];
            unset($_spacings[$prefix . 't-lg']);
            unset($_spacings[$prefix . 'b-lg']);
        }

        if (isset($_spacings[$prefix . 's-lg']) && $_spacings[$prefix . 's-lg'] === $_spacings[$prefix . 'e-lg']) {
            $_spacings[$prefix . 'x-lg'] = $_spacings[$prefix . 's-lg'];
            unset($_spacings[$prefix . 's-lg']);
            unset($_spacings[$prefix . 'e-lg']);
        }

        if (
            isset($_spacings[$prefix . 'x-lg'])
            && isset($_spacings[$prefix . 'y-lg'])
            && $_spacings[$prefix . 'x-lg'] === $_spacings[$prefix . 'y-lg']
        ) {
            $_spacings[$prefix . '-lg'] = $_spacings[$prefix . 'x-lg'];
            unset($_spacings[$prefix . 'x-lg']);
            unset($_spacings[$prefix . 'y-lg']);
        }

        // -xl

        if (isset($_spacings[$prefix . 't-xl'])
            && isset($_spacings[$prefix . 'b-xl'])
            && $_spacings[$prefix . 't-xl'] === $_spacings[$prefix . 'b-xl']) {
            $_spacings[$prefix . 'y-xl'] = $_spacings[$prefix . 't-xl'];
            unset($_spacings[$prefix . 't-xl']);
            unset($_spacings[$prefix . 'b-xl']);
        }

        if (isset($_spacings[$prefix . 's-xl'])
            && isset($_spacings[$prefix . 'e-xl'])
            && $_spacings[$prefix . 's-xl'] === $_spacings[$prefix . 'e-xl']) {
            $_spacings[$prefix . 'x-xl'] = $_spacings[$prefix . 's-xl'];
            unset($_spacings[$prefix . 's-xl']);
            unset($_spacings[$prefix . 'e-xl']);
        }

        if (
            isset($_spacings[$prefix . 'x-xl'])
            && isset($_spacings[$prefix . 'y-xl'])
            && $_spacings[$prefix . 'x-xl'] === $_spacings[$prefix . 'y-xl']
        ) {
            $_spacings[$prefix . '-xl'] = $_spacings[$prefix . 'x-xl'];
            unset($_spacings[$prefix . 'x-xl']);
            unset($_spacings[$prefix . 'y-xl']);
        }

        //  -xxl
        if (isset($_spacings[$prefix . 't-xxl'])
            && isset($_spacings[$prefix . 'b-xxl'])
            && $_spacings[$prefix . 't-xxl'] === $_spacings[$prefix . 'b-xxl']) {
            $_spacings[$prefix . 'y-xxl'] = $_spacings[$prefix . 't-xxl'];
            unset($_spacings[$prefix . 't-xxl']);
            unset($_spacings[$prefix . 'b-xxl']);
        }

        if (isset($_spacings[$prefix . 's-xxl'])
            && isset($_spacings[$prefix . 'e-xxl'])
            && $_spacings[$prefix . 's-xxl'] === $_spacings[$prefix . 'e-xxl']) {
            $_spacings[$prefix . 'x-xxl'] = $_spacings[$prefix . 's-xxl'];
            unset($_spacings[$prefix . 's-xxl']);
            unset($_spacings[$prefix . 'e-xxl']);
        }

        if (
            isset($_spacings[$prefix . 'x-xxl'])
            && isset($_spacings[$prefix . 'y-xxl'])
            && $_spacings[$prefix . 'x-xxl'] === $_spacings[$prefix . 'y-xxl']
        ) {
            $_spacings[$prefix . '-xxl'] = $_spacings[$prefix . 'x-xxl'];
            unset($_spacings[$prefix . 'x-xxl']);
            unset($_spacings[$prefix . 'y-xxl']);
        }

        $spacings = [];
        foreach ($_spacings as $key => $value) {
            $spacings[] = $key . '-' . $value;
        }

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
     * Set the columnsMargin for the top side.
     *
     * @param string|int $value The columnsMargin value for the top side.
     *
     * @return $this
     */
    public function columnsMarginTop(string|int $value): self
    {
        $this->columnsMargin = array_merge($this->columnsMargin, $this->generateVisibilities($value, 'mt'));
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
        $this->columnsMargin = array_merge($this->columnsMargin, $this->generateVisibilities($value, 'mb'));
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
        $this->columnsMargin = array_merge($this->columnsMargin, $this->generateVisibilities($value, 'ms'));
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
        $this->columnsMargin = array_merge($this->columnsMargin, $this->generateVisibilities($value, 'me'));
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
        $this->columnsMarginStart($value);
        $this->columnsMarginEnd($value);
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
        $this->columnsMarginTop($value);
        $this->columnsMarginBottom($value);
        return $this;
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
        $this->columnsMarginTop($value);
        $this->columnsMarginEnd($value);
        $this->columnsMarginStart($value);
        $this->columnsMarginBottom($value);
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
        $this->columnsPadding = array_merge($this->columnsPadding, $this->generateVisibilities($value, 'pt'));
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
        $this->columnsPadding = array_merge($this->columnsPadding, $this->generateVisibilities($value, 'pb'));
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
        $this->columnsPadding = array_merge($this->columnsPadding, $this->generateVisibilities($value, 'ps'));
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
        $this->columnsPadding = array_merge($this->columnsPadding, $this->generateVisibilities($value, 'pe'));
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
        $this->columnsPaddingStart($value);
        $this->columnsPaddingEnd($value);
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
        $this->columnsPaddingX($value);
        $this->columnsPaddingY($value);
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
        $this->columnsPaddingTop($value);
        $this->columnsPaddingBottom($value);
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
