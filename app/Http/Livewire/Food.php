<?php

namespace App\Http\Livewire;

use App\Models\Food as ModelsFood;
use Livewire\Component;

class Food extends Component
{
    public $name;
    public $description;
    public $ingredient;
    public $price;
    public $type;
    public $rate;

    protected $rules = [
        'name' => ['required', 'string', 'min:3', 'max:100'],
        'description' => ['required', 'string', 'max:255'],
        'ingredient' => ['required', 'string', 'max:255'],
        'price' => ['required', 'integer'],
        'rate' => ['required', 'integer'],
        'type' => ['required', 'string'],
    ];

    public function render()
    {
        return view('livewire.food');
    }

    public function submit()
    {
        $this->validate();

        ModelsFood::create([
            'name' => $this->name,
            'description' => $this->description,
            'ingredient' => $this->ingredient,
            'price' => $this->price,
            'rate' => $this->rate,
            'type' => $this->type
        ]);

        $this->name = '';
        $this->description = '';
        $this->ingredient = '';
        $this->price = '';
        $this->rate = '';
        $this->type = '';

        // return redirect()->route('foods.index');
    }
}
