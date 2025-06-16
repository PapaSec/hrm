<?php

namespace App\Livewire\Admin\Designations;

use App\Models\Designation;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;

    public function delete($id)
    {
        $department = Designation::find($id);
        session()->flash('success', 'Designation deleted succesfully.');
    }
    public function render()
    {
        return view(
            'livewire.admin.designations.index',
            [
                'departments' => Designation::inCompany()->paginate(10)
            ]
        );
    }
}
