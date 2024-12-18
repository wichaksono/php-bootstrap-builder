<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Common\Traits;

use NeonWebId\Classes\Common\Interfaces\ElementInterface;

trait SchemaTrait
{
    private array $schema = [];

    public function schema(array $schema): self
    {
        $this->schema = $schema;
        return $this;
    }

    public function getSchema(): string
    {
        $schemas = '';

        if ($this->schema !== []) {
            foreach ($this->schema as $schema) {
                if ($schema instanceof ElementInterface) {
                    $schemas .= $schema->render();
                }
            }
        }

        return $schemas;
    }
}