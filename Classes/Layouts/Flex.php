<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Layouts;

use NeonWebId\Classes\Common\Interfaces\ElementInterface;
use NeonWebId\Classes\Common\Traits\SchemaTrait;

class Flex implements ElementInterface
{
    use SchemaTrait;

    private string $id = '';

    private string|array $class = '';

    private string|array $direction = 'row';

    private string|array $justifyContent = 'start';

    private string|array $alignItems = 'start';

    private string|array $alignContent = 'start';

    private string|array $alignSelf = 'start';

    private string|array $flexWrap = 'nowrap';

    private string|array $flexGrow = '0';

    private string|array $flexShrink = '1';

    private string|array $flexBasis = 'auto';

    private string|array $order = '0';

    private string|array $gap = '0';

    private function __construct(string $id = '')
    {
        $this->id = $id;
    }

    public static function make(string $id = ''): self
    {
        return new self($id);
    }

    public function class(string|array $class): self
    {
        $this->class = $class;
        return $this;
    }

    public function direction(string|array $direction): self
    {
        $this->direction = $direction;
        return $this;
    }

    public function justifyContent(string|array $justifyContent): self
    {
        $this->justifyContent = $justifyContent;
        return $this;
    }

    public function alignItems(string|array $alignItems): self
    {
        $this->alignItems = $alignItems;
        return $this;
    }

    public function alignContent(string|array $alignContent): self
    {
        $this->alignContent = $alignContent;
        return $this;
    }

    public function alignSelf(string|array $alignSelf): self
    {
        $this->alignSelf = $alignSelf;
        return $this;
    }

    public function flexWrap(string|array $flexWrap): self
    {
        $this->flexWrap = $flexWrap;
        return $this;
    }

    public function flexGrow(string|array $flexGrow): self
    {
        $this->flexGrow = $flexGrow;
        return $this;
    }

    public function flexShrink(string|array $flexShrink): self
    {
        $this->flexShrink = $flexShrink;
        return $this;
    }

    public function flexBasis(string|array $flexBasis): self
    {
        $this->flexBasis = $flexBasis;
        return $this;
    }

    public function order(string|array $order): self
    {
        $this->order = $order;
        return $this;
    }

    public function gap(string|array $gap): self
    {
        $this->gap = $gap;
        return $this;
    }

    public function render(): string
    {
        // TODO: Implement render() method.
    }
}