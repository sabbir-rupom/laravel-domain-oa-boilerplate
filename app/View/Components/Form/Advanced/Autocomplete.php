<?php

namespace App\View\Components\Form\Advanced;

use Illuminate\View\Component;

class Autocomplete extends Component
{
    public $name;
    public $id;
    public $class;
    public $value;
    public $dataArray;
    public $placeholder;
    public $dataUrl;
    public $required;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $name = '',
        $id = '',
        $class = '',
        $value = '',
        $dataArray = null,
        $placeholder = 'Start typing...',
        $dataUrl = '',
        $required = false
    ) {
        $this->name = $name;
        $this->id = $id;
        $this->class = $class;
        $this->value = $value;
        $this->dataArray = $dataArray;
        $this->required = $required;
        $this->placeholder = $placeholder;
        $this->dataUrl = $dataUrl;

        if (is_string($this->dataArray)) {
            $this->dataArray = json_decode($this->dataArray);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.advanced.autocomplete');
    }
}
