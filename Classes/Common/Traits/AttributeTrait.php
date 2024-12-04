<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Common\Traits;

trait AttributeTrait
{
    private array $attributes = [];

    public function attributes(array $attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function addAttribute(string $key, string $value): self
    {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function getAttributes(): string
    {
        // remove general attributes id, and class
        unset($this->attributes['id']);
        unset($this->attributes['class']);

        $attributes = '';
        foreach ($this->attributes as $key => $value) {
            $attributes .= sprintf(' %s="%s"', $key, $value);
        }
        return $attributes;
    }
}