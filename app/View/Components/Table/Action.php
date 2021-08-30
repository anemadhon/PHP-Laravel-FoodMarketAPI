<?php

namespace App\View\Components\Table;

use Illuminate\View\Component;

class Action extends Component
{
    public array $datas;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $datas)
    {
        $this->datas = $datas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table.action');
    }
}
