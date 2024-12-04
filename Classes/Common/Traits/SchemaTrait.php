<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Common\Traits;

use NeonWebId\Classes\Common\Interfaces\SchemaInterface;

use function sprintf;

trait SchemaTrait
{
    use ColumnTrait;

    private array $schema = [];

    public function schema(array $schema): self
    {
        $this->schema = $schema;
        return $this;
    }

    public function getSchema(): string
    {
        $schemas = '';
        $wrap = '';
        if ($this->getColumns() !== '') {
            $wrap = '<div class="' . $this->getColumns() . '">%s</div>';
        }

        if ( $this->schema !== [] ) {
            foreach ($this->schema as $schema) {
                if ( $schema instanceof SchemaInterface ) {
                    $schemas .= sprintf($wrap, $schema->render());
                }
            }
        }

        return $wrap ? sprintf('<div class="row">%s</div>', $schemas) : $schemas;
    }
}