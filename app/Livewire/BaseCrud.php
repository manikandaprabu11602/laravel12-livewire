<?php

namespace App\Livewire;

use Livewire\Component;

abstract class BaseCrud extends Component
{
    public $records;
    public $record_id;
    public $isEditMode = false;

    // Child classes must define which model and validation rules to use
    abstract protected function model();
    abstract protected function validationRules();

    public function render()
    {
        $this->records = $this->model()::all();
        return view('livewire.base-crud');
    }

    public function resetFields()
    {
        // Fields to skip when resetting
        $excluded = [
            'records',
            'isEditMode',
            'record_id',
            // Skip Livewire internal/reserved properties
            'id', 'listeners', 'queryString', 'computed', 'rules',
            'messages', 'validationAttributes', 'casts',
            'dispatchesEvents', 'redirector', 'redirectTo',
            'middleware', 'originalData', 'attributes'
        ];

        foreach (get_object_vars($this) as $property => $value) {
            // Skip reserved or internal properties
            if (in_array($property, $excluded) || str_starts_with($property, '__')) {
                continue;
            }

            // Reset only public user-defined props
            $this->$property = null;
        }

        $this->isEditMode = false;
        $this->record_id = null;
    }

    public function store()
    {
        $this->validate($this->validationRules());

        $this->model()::create($this->getInputData());

        session()->flash('message', 'Created successfully!');
        $this->resetFields();
    }

    public function edit($id)
    {
        $record = $this->model()::findOrFail($id);

        foreach ($record->toArray() as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }

        $this->record_id = $record->id;
        $this->isEditMode = true;
    }

    public function update()
    {
        $this->validate($this->validationRules());

        $record = $this->model()::findOrFail($this->record_id);
        $record->update($this->getInputData());

        session()->flash('message', 'Updated successfully!');
        $this->resetFields();
    }

    public function delete($id)
    {
        $this->model()::findOrFail($id)->delete();
        session()->flash('message', 'Deleted successfully!');
    }

    protected function getInputData()
    {
        $data = [];

        foreach (get_object_vars($this) as $property => $value) {
            // Skip non-model properties and internal Livewire properties
            if (
                in_array($property, ['records', 'isEditMode', 'record_id']) ||
                str_starts_with($property, '__') ||
                $property === 'attributes'
            ) {
                continue;
            }

            $data[$property] = $value;
        }

        return $data;
    }
}
