<?php

namespace App\Livewire;

use App\Models\Product;

class ProductCrud extends BaseCrud
{
    public $name, $description, $price, $quantity;
    public $showForm = false;
    public $editingProductId = null;

    protected $listeners = ['hideForm'];

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

    public function showCreateForm()
    {
        $this->editingProductId = null;
        $this->resetFields();
        $this->showForm = true;
    }

    public function showEditForm($id)
    {
        $this->editingProductId = $id;
        $this->edit($id);
        $this->showForm = true;
    }

    public function hideForm()
    {
        $this->showForm = false;
        $this->editingProductId = null;
        $this->resetFields();
    }

    // Override parent store/update methods to hide form after save
    public function store()
    {
        parent::store();
        $this->hideForm();
    }

    public function update()
    {
        parent::update();
        $this->hideForm();
    }
}
