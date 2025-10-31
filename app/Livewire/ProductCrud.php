<?php

namespace App\Livewire;

use App\Models\Product;

class ProductCrud extends BaseCrud
{
    public $name, $description, $price, $quantity;

    protected function model()
    {
        return Product::class;
    }

    protected function validationRules()
    {
        return [
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'description' => 'nullable',
        ];
    }

    public function render()
    {
        $this->records = Product::all();
        return view('livewire.product-crud');
    }
}
