<?php

declare(strict_types=1);

namespace NeonWebId\Common\Traits;

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

    public function removeAttribute(string $key): self
    {
        unset($this->attributes[$key]);
        return $this;
    }

    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function getAttribute(string $key): string
    {
        return $this->attributes[$key] ?? '';
    }

    public function hasAttribute(string $key): bool
    {
        return isset($this->attributes[$key]);
    }

    public function clearAttributes(): self
    {
        $this->attributes = [];
        return $this;
    }

    public function renderAttributes(): string
    {
        $attributes = '';
        foreach ($this->attributes as $key => $value) {
            $attributes .= " {$key}=\"{$value}\"";
        }
        return $attributes;
    }
}