<?php

declare(strict_types=1);

namespace NeonWebId\Common\Traits;

use NeonWebId\Common\Interfaces\RenderInterface;

trait LayoutTrait
{
    use LayoutContainerTrait,
        LayoutColumnsTrait,
        SpacingTrait,
        AttributeTrait;

    /**
     * Schema
     *
     * @var RenderInterface[]
     */
    private array $schema = [];


    public function schema(array $schema): self
    {
        $this->schema = $schema;
        return $this;
    }
}