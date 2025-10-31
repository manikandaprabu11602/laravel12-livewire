<?php

namespace App\Livewire;

use App\Models\Student;

class StudentCrud extends BaseCrud
{
    public $name, $email, $course, $age;

    protected function model()
    {
        return Student::class;
    }

    protected function validationRules()
    {
        return [
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:students,email,' . $this->record_id,
            'course' => 'required|string|max:255',
            'age'    => 'nullable|integer|min:1|max:100',
        ];
    }

    public function render()
    {
        $this->records = Student::all();
        return view('livewire.student-crud');
    }
}
