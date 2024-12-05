<?php
declare(strict_types=1);

namespace NeonWebId\Classes\Forms\Fields;

use NeonWebId\Classes\Common\Interfaces\ElementInterface;
use NeonWebId\Classes\Common\Traits\ColumnTrait;

use function var_dump;

class TextInput implements ElementInterface
{
    use ColumnTrait;

    private string $id;

    private string $name;

    private string $label;

    private string $value = '';

    private string $helpText = '';

    private string $type = 'text';

    private array $dataLists = [];

    private array $availableTypes = [
        'text',
        'email',
        'password',
        'number',
        'tel',
        'url',
        'file',
        'color',
        'date',
        'time',
        'datetime-local',
    ];

    private bool $floating = false;

    private string $placeholder = '';

    private function __construct(string $name)
    {
        $this->name = $name;
        $this->id = $name . '-' . substr(md5(microtime()), 0, 5);
    }

    public static function make(string $name): self
    {
        return new self($name);
    }

    public function helpText(string $helpText): self
    {
        $this->helpText = $helpText;
        return $this;
    }

    public function type(string $type): self
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

    public function placeholder(string $placeholder):self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function floating(): self
    {
        $this->floating = true;
        return $this;
    }

    public function dataList(array $dataLists): self
    {
        $this->dataLists = $dataLists;
        return $this;
    }

    public function render(): string
    {

        $helpText = $this->helpText !== '' ? '<div class="form-text">' . $this->helpText . '</div>' : '';

        if ($this->dataLists !== []) {
            $dataList = '<datalist id="' . $this->id . '-datalist">';
            foreach ($this->dataLists as $dataItem) {
                $dataList .= '<option value="' . $dataItem . '">';
            }
            $dataList .= '</datalist>';

            $input = sprintf(
                '<label for="%s" class="form-label">%s</label><input type="%s" class="form-control" id="%s" name="%s" value="%s" placeholder="%s" list="%s-datalist">%s',
                $this->id,
                $this->label,
                $this->type,
                $this->id,
                $this->name,
                $this->value,
                $this->placeholder,
                $this->id,
                $dataList
            );

            return $input . $helpText;
        }

        if ( $this->floating ) {
            $input = sprintf(
                '<div class="form-floating"><input type="%s" class="form-control" id="%s" name="%s" value="%s" placeholder="%s"><label for="%s">%s</label></div>',
                $this->type,
                $this->id,
                $this->name,
                $this->value,
                $this->placeholder,
                $this->id,
                $this->label
            );
        } else {
            $input = sprintf(
                '<label for="%s" class="form-label">%s</label><input type="%s" class="form-control" id="%s" name="%s" value="%s" placeholder="%s">',
                $this->id,
                $this->label,
                $this->type,
                $this->id,
                $this->name,
                $this->value,
                $this->placeholder
            );
        }

        return $input . $helpText;
    }
}