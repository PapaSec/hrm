<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 p-6">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Employees</flux:heading>
        <flux:subheading size="lg" class="mb-6">Create new employee</flux:subheading>
        <flux:separator />
    </div>

    <form wire:submit="save" class="my-6 w-full space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <flux:input label="Employee Name" wire:model="employee.name" :invalid="$errors->has('employee.name')"
                type="text" />
            <flux:input label="Employee Email" wire:model="employee.email" :invalid="$errors->has('employee.email')"
                type="text" />
            <flux:select label="Department" wire:model="department_id" :invalid="$errors->has('department_id')">
                <option selected>Select Department</option>
                @foreach ($departments as $department)
                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
            </flux:select>

            <flux:select label="Designation" wire:model="employee.designation_id"
                :invalid="$errors->has('employee.designation_id')">
                <option selected>Select Designation</option>
                @foreach ($designations as $designation)
                    <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                @endforeach
            </flux:select>
        </div>
        <flux:input label="Employee Phone" wire:model="employee.phone" :invalid="$errors->has('employee.phone')"
            type="text" />
        <flux:input label="Employee Address" wire:model="employee.address" :invalid="$errors->has('employee.address')"
            type="text" />
        <flux:button variant="primary" type="submit">Save</flux:button>
    </form>
</div>