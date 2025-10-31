<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductCrud extends Component
{
    public $products, $name, $description, $price, $quantity, $product_id;
    public $isEditMode = false;

    protected $rules = [
        'name' => 'required|min:3',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'description' => 'nullable',
    ];

    public function render()
    {
        $this->products = Product::all();
        return view('livewire.product-crud');
    }

    public function resetFields()
    {
        $this->name = '';
        $this->description = '';
        $this->price = '';
        $this->quantity = '';
        $this->product_id = null;
        $this->isEditMode = false;
    }

    public function store()
    {
        $this->validate();

        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ]);

        session()->flash('message', 'Product created successfully!');
        $this->resetFields();
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $this->product_id = $product->id;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->quantity = $product->quantity;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate();

        $product = Product::findOrFail($this->product_id);
        $product->update([
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'quantity' => $this->quantity,
        ]);

        session()->flash('message', 'Product updated successfully!');
        $this->resetFields();
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
        session()->flash('message', 'Product deleted successfully!');
    }
}
