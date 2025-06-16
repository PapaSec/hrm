<?php

namespace App\Livewire\Admin\Departments;

use App\Models\Department;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination, WithoutUrlPagination;

    public function delete($id)
    {
        $department = Department::find($id);
        session()->flash('success', 'Department deleted succesfully.');
    }
    public function render()
    {
        return view(
            'livewire.admin.departments.index',
            [
                'departments' => Department::inCompany()->paginate(5)
            ]
        );
    }
}
