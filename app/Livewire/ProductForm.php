<?php

namespace App\Livewire;

use App\Models\Product;

class ProductForm extends BaseCrud
{
    public $name, $description, $price, $quantity;
    public $productId;

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

    public function mount($productId = null)
    {
        $this->productId = $productId;

        if ($this->productId) {
            $this->edit($this->productId);
        }
    }

    public function render()
    {
        return view('livewire.product-form');
    }

    public function store()
    {
        parent::store();
        // redirect back to list after creating
        return redirect()->route('products.index');
    }

    public function update()
    {
        parent::update();
        // redirect back to list after updating
        return redirect()->route('products.index');
    }
}
