<?php

declare(strict_types=1);

namespace NeonWebId\Classes\Common\Traits;

use NeonWebId\Classes\Common\Interfaces\ElementInterface;

use function sprintf;

trait LayoutTrait
{
    use ColumnTrait;
    use SchemaTrait;

    public function getSchema(): string
    {
        $schemas = '';
        $wrap = '';
        if ($this->getColumns() !== '') {
            $wrap = '<div class="' . $this->getColumns() . '">%s</div>';
        }

        if ( $this->schema !== [] ) {
            foreach ($this->schema as $schema) {
                if ( $schema instanceof ElementInterface ) {
                    if ($schema->hasColumnSpan()) {
                        $schemas .= sprintf($wrap, $schema->render());
                    } else {
                        $schemas .= $schema->render();
                    }
                    $schemas .= sprintf($wrap, $schema->render());
                }
            }
        }

        return $wrap ? sprintf('<div class="row">%s</div>', $schemas) : $schemas;
    }
}