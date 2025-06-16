<?php

namespace App\Livewire\Admin\Employees;

use Livewire\Component;

class Create extends Component
{
    public $employee;

    public $departmet_id;

    public function rules()
    {
        return [
            'employee.name' => 'required|string|max:255',
            'employee.email' => 'required|email|max:255',
            'emplyee.phone' => 'required|string|max:255',
            'employee.address' => 'required|string|max:255',
            'employee.department_id' => 'required|integer',
        ];
    }
    public function render()
    {
        return view('livewire.admin.employees.create');
    }
}
