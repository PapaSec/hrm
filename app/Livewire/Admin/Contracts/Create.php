<?php

namespace App\Livewire\Admin\Contracts;

use App\Models\Contract;
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
            'required.employee_id' => 'required',
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
    public function render()
    {
        return view('livewire.admin.contracts.create');
    }
}
