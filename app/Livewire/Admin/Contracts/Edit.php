<?php

namespace App\Livewire\Admin\Contracts;

use App\Models\Contract;
use App\Models\Department;
use App\Models\Employee;
use Livewire\Component;

class Edit extends Component
{
    public $contract;
    public $search = '';
    public $department_id;

    public function rules()
    {
        return [
            'contract.designation_id' => 'required',
            'required.employee_id' => 'required',
            'contract.start_date' => 'required|date',
            'contract.end_date' => 'required|date|after:contract.start_date',
            'contract.rate_type' => 'required',
            'contract.rate' => 'required|numeric',
        ];
    }

    public function mount($id)
    {
        $this->contract = Contract::find($id);
        $this->search = $this->contract->employee->name;
        $this->department_id = $this->contract->employee->designation->department_id;
    }

    public function selectEmployee($id)
    {
        $this->contract->employee_id = $id;
        $this->search = $this->contract->employee->name;
    }

    public function save()
    {
        $this->validate();
        $this->contract->save();
        session()->flash('success', 'Contract editedr-f3e08=-
        .9 successfully.');
        return $this->redirectIntended(route('contracts.index'));
    }
    public function render()
    {
        $employees = Employee::inCompany()->searchByName($this->search)->get();
        $departments = Department::inCompany()->get();
        $designations = $this->department_id ? Department::find($this->department_id)->designations : collect();
        return view('livewire.admin.contracts.edit', [
            'employees' => $employees,
            'departments' => $departments,
            'designations' => $designations,
        ]);
    }
}
