<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 p-6">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Employees</flux:heading>
        <flux:subheading size="lg" class="mb-6">Create new employee</flux:subheading>
        <flux:separator />
        <div>
            <form wire:submit="save" class="my-6 w-full space-y-6">
                <!-- Department Select -->
                <flux:select label="Department" wire:model="department_id"
                             :invalid="$errors->has('department_id')">
                    <option value="">Select Department</option> <!-- Empty value option -->
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                </flux:select>

                <!-- Designation Select -->
                <flux:select label="Designation" wire:model="employee.designation_id" :invalid="$errors->has('employee.designation_id')">
                    <option value="">Select Designation</option> <!-- Empty value option -->
                    @foreach ($designations as $designation)
                        <option value=" {{ $designation->id }}">{{ $designation->name }}</option>
                    @endforeach
                    </flux:select>

                    <!-- Other fields -->
                    <flux:input label="Employee Name" wire:model="employee.name"
                        :invalid="$errors->has('employee.name')" type="text" />
                    <flux:input label="Email" wire:model="employee.email" :invalid="$errors->has('employee.email')"
                        type="email" />
                    <flux:input label="Phone" wire:model="employee.phone" :invalid="$errors->has('employee.phone')"
                        type="text" />
                    <flux:input label="Address" wire:model="employee.address"
                        :invalid="$errors->has('employee.address')" type="text" />

                    <flux:button variant="primary" type="submit">Save</flux:button>
            </form>
        </div>
    </div>
</div>