<?php
declare(strict_types=1);

namespace NeonWebId\Classes\Forms\Fields;

use NeonWebId\Classes\Common\Interfaces\SchemaInterface;
use NeonWebId\Classes\Common\Traits\ColumnTrait;

class TextInput implements SchemaInterface
{
    use ColumnTrait;

    private string $id;

    private string $name;

    private string $label;

    private string $value;

    private string $type = 'text';

    private array $availableTypes = [
        'text',
        'email',
        'password',
        'number',
        'tel',
        'url',
        'file',
        'color',
        'datalist',
        'date',
        'time',
        'datetime-local',
    ];

    private function __construct(string $name)
    {
        $this->name = $name;
        $this->id = $name . '-' . substr(md5(microtime()), 0, 5);
    }

    public static function make(string $name): self
    {
        return new self($name);
    }

    public function type(string $type = 'text'): self
    {
        $this->type = in_array($type, $this->availableTypes) ? $type : 'text';
        return $this;
    }

    public function label(string $label):self
    {
        $this->label = $label;
        return $this;
    }

    public function value(string $value):self
    {
        $this->value = $value;
        return $this;
    }

    public function render(): string
    {
        /**
         * <label for="exampleFormControlInput1" class="form-label">Email address</label>
         * <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
         */
        return sprintf(
            '<label for="%s" class="form-label">%s</label><input type="%s" class="form-control" id="%s" name="%s" value="%s">',
            $this->id,
            $this->label,
            $this->type,
            $this->id,
            $this->name,
            $this->value
        );
    }
}