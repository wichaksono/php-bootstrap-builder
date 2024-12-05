<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Layouts;

use NeonWebId\Classes\Common\Interfaces\ElementInterface;
use NeonWebId\Classes\Common\Traits\LayoutTrait;

class Row implements ElementInterface
{
    use LayoutTrait;

    private string $id = '';

    private string|array $class = '';

    private string|array $justifyContent = 'start';

    private string|array $alignItems = 'start';

    private function __construct(string $id = '')
    {
        $this->id = $id;
    }

    public function id(string $id): self
    {
        $this->id = $id;
        return $this;
    }

    public static function make(string $id = ''): self
    {
        return new self($id);
    }

    public function render(): string
    {
        // TODO: Implement render() method.
    }
}