<?php

namespace App\Livewire\Admin\Contracts;

use App\Models\Contract;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Create extends Component
{
    public $contract;
    public $search = '';
    public $department_id;

    public function rules()
    {
        return [
            'contract.designation_id' => 'required',
            'contract.employee_id' => 'required',
            'contract.department_id' => 'required',
            'contract.start_date' => 'required|date',
            'contract.end_date' => 'required|date|after:contract.start_date',
            'contract.rate_type' => 'required',
            'contract.rate' => 'required|numeric',
        ];
    }

    public function mount()
    {
        $this->contract = new Contract();
    }

    public function selectEmployee($id)
    {
        $this->contract->employee_id = $id;
        $this->search = $this->contract->employee->name;
    }

    public function save()
    {
        $this->validate();
        $activeContract = $this->contract->employee->getActiveContract($this->contract->start_date, $this->contract->end_date);
        if ($activeContract && $activeContract->id != $this->contract->id) {
            throw ValidationException::withMessages(['contract.start_date' => 'This employee already has an active contract during this period.']);
        }
        $this->contract->save();
        session()->flash('success', 'Contract created successfully.');
        return $this->redirectIntended(route('contracts.index'), true);
    }
    public function render()
    {
        $employees = Employee::inCompany()->searchByName($this->search)->get();
        $departments = Department::inCompany()->get();

        $designations = $this->contract->department_id
            ? Department::find($this->contract->department_id)?->designations ?? collect()
            : collect();

        return view('livewire.admin.contracts.create', [
            'employees' => $employees,
            'departments' => $departments,
            'designations' => $designations,
        ]);
    }
}
