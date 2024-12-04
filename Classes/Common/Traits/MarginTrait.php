<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Common\Traits;

trait MarginTrait
{
    private string|int|array $margin = '';

    private array $margins = [
        'x' => '',
        'y' => '',
        't' => '',
        'b' => '',
        's' => '',
        'e' => '',
    ];

    public function margin(string|int|array $value):self
    {
        $this->margin = $value;
        return $this;
    }

    public function marginX(string|int|array $value):self
    {
        $this->margins['x'] = $value;
        return $this;
    }

    public function marginY(string|int|array $value):self
    {
        $this->margins['y'] = $value;
        return $this;
    }

    public function marginTop(string|int|array $value):self
    {
        $this->margins['t'] = $value;
        return $this;
    }

    public function marginBottom(string|int|array $value):self
    {
        $this->margins['b'] = $value;
        return $this;
    }

    public function marginStart(string|int|array $value):self
    {
        $this->margins['s'] = $value;
        return $this;
    }

    public function marginEnd(string|int|array $value):self
    {
        $this->margins['e'] = $value;
        return $this;
    }

    public function getMargin():string
    {
        $marginClass = '';

        if (is_array($this->margin)) {
            foreach ($this->margin as $key => $value) {
                // default value
                $marginClass .= $key === 'default'
                    ? 'm-' . $value  : 'm-' . $key . '-' . $value;
            }
        } else {
            $marginClass = 'm-' . $this->margin;
        }

        return $marginClass;
    }
}