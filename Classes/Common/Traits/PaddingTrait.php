<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Common\Traits;

trait PaddingTrait
{
    private string|int|array $padding = '';

    private array $paddings = [
        'x' => '',
        'y' => '',
        't' => '',
        'b' => '',
        's' => '',
        'e' => '',
    ];

    public function padding(string|int|array $value):self
    {
        $this->padding = $value;
        return $this;
    }

    public function paddingX(string|int|array $value):self
    {
        $this->paddings['x'] = $value;
        return $this;
    }

    public function paddingY(string|int|array $value):self
    {
        $this->paddings['y'] = $value;
        return $this;
    }

    public function paddingTop(string|int|array $value):self
    {
        $this->paddings['t'] = $value;
        return $this;
    }

    public function paddingBottom(string|int|array $value):self
    {
        $this->paddings['b'] = $value;
        return $this;
    }

    public function paddingStart(string|int|array $value):self
    {
        $this->paddings['s'] = $value;
        return $this;
    }

    public function paddingEnd(string|int|array $value):self
    {
        $this->paddings['e'] = $value;
        return $this;
    }

    public function getPadding():string
    {
        $paddingClass = '';

        if (is_array($this->padding)) {
            foreach ($this->padding as $key => $value) {
                $paddingClass .= $key === 'default'
                    ? 'p-' . $value  : 'p' . $key . '-' . $value;
                $paddingClass .= ' ';
            }
        } else {
            $paddingClass = 'p-' . $this->padding;
        }

        return trim($paddingClass);
    }
}
