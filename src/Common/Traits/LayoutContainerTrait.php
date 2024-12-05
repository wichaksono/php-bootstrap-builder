<?php

declare(strict_types=1);

namespace NeonWebId\Common\Traits;

use function implode;
use function in_array;
use function is_array;
use function is_string;

trait LayoutContainerTrait
{
    use ResponsiveDisplayTrait;

    /**
     * Available Justify Content Values
     * - start
     * - end
     * - center
     * - between
     * - around
     * - evenly
     */
    private array $justifyContent = [];

    /**
     * Available Align Items Values
     * - start
     * - end
     * - center
     * - baseline
     * - stretch
     */
    private array $alignItems = [];

    /**
     * Available Align Content Values
     * - start
     * - end
     * - center
     * - between
     * - around
     * - stretch
     */
    private array $alignContent = [];

    /**
     * Available Align Self Values
     * - auto
     * - start
     * - end
     * - center
     * - baseline
     * - stretch
     */
    private array $alignSelf = [];


    /**
     * Set the justify content
     *
     * @param string|array $justifyContent
     *
     * @return $this
     */
    public function justifyContent(string|array $justifyContent = 'start'): self
    {
        if (is_string($justifyContent)) {
            $this->justifyContent[] = "justify-content-{$justifyContent}";
            return $this;
        }

        if (is_array($justifyContent)) {
            // Handle 'default' case
            if (isset($justifyContent['default'])) {
                $defaultJustify         = $justifyContent['default'];
                $this->justifyContent[] = "justify-content-{$defaultJustify}";
                unset($justifyContent['default']);
            }

            // Apply specific breakpoint justifications
            foreach ($justifyContent as $display => $value) {
                if (in_array($display, $this->availableResponsiveDisplay)) {
                    $this->justifyContent[] = "justify-content-{$display}-{$value}";
                }
            }
        }

        return $this;
    }

    /**
     * Set the align items
     *
     * @param string|array $alignItems
     *
     * @return $this
     */
    public function alignItems(string|array $alignItems = 'start'): self
    {
        if (is_string($alignItems)) {
            $this->alignItems[] = "align-items-{$alignItems}";
            return $this;
        }

        if (is_array($alignItems)) {
            // Handle 'default' case
            if (isset($alignItems['default'])) {
                $defaultAlign       = $alignItems['default'];
                $this->alignItems[] = "align-items-{$defaultAlign}";
                unset($alignItems['default']);
            }

            // Apply specific breakpoint alignments
            foreach ($alignItems as $display => $value) {
                if (in_array($display, $this->availableResponsiveDisplay)) {
                    $this->alignItems[] = "align-items-{$display}-{$value}";
                }
            }
        }

        return $this;
    }

    /**
     * Set the align content
     *
     * @param string|array $alignContent
     *
     * @return $this
     */
    public function alignContent(string|array $alignContent = 'start'): self
    {
        if (is_string($alignContent)) {
            $this->alignContent[] = "align-content-{$alignContent}";
            return $this;
        }

        if (is_array($alignContent)) {
            // Handle 'default' case
            if (isset($alignContent['default'])) {
                $defaultAlign         = $alignContent['default'];
                $this->alignContent[] = "align-content-{$defaultAlign}";
                unset($alignContent['default']);
            }

            // Apply specific breakpoint alignments
            foreach ($alignContent as $display => $value) {
                if (in_array($display, $this->availableResponsiveDisplay)) {
                    $this->alignContent[] = "align-content-{$display}-{$value}";
                }
            }
        }

        return $this;
    }

    /**
     * Set the align self
     *
     * @param string|array $alignSelf
     *
     * @return $this
     */
    public function alignSelf(string|array $alignSelf = 'start'): self
    {
        if (is_string($alignSelf)) {
            $this->alignSelf[] = "align-self-{$alignSelf}";
            return $this;
        }

        if (is_array($alignSelf)) {
            // Handle 'default' case
            if (isset($alignSelf['default'])) {
                $defaultAlign      = $alignSelf['default'];
                $this->alignSelf[] = "align-self-{$defaultAlign}";
                unset($alignSelf['default']);
            }

            // Apply specific breakpoint alignments
            foreach ($alignSelf as $display => $value) {
                if (in_array($display, $this->availableResponsiveDisplay)) {
                    $this->alignSelf[] = "align-self-{$display}-{$value}";
                }
            }
        }

        return $this;
    }


    /**
     * Set the nowrap
     *
     * @return $this
     */
    public function nowrap(): self
    {
        $this->wrap = true;
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

        return implode(' ', $classes);
    }
}