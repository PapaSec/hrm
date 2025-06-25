<div
    class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 p-6 rounded-lg shadow-md">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Contracts</flux:heading>
        <flux:subheading size="lg" class="mb-6">Edit this contract</flux:subheading>
        <flux:separator />
    </div>
    <form wire:submit="save" class="my-6 w-full space-y-6">
        <flux:input type="search" name="search" wire:model.live="search" placeholder="Search for employee"
            :invalid="$errors->has('contract.employee_id')" />
        @if ($search != '' && $employees->count() > 0)
            <div
                class="bg-white dark:bg-zinc-900 w-full border border-zinc-200 dark:border-zinc-800 rounded-md shadow-md -mt-4">
                <ul class="w-full">
                    @foreach ($employees as $employee)
                        <li wire:click="selectEmployee({{ $employee->id }})"
                            class="cursor-pointer hover:bg-zinc-200 dark:hover:bg-zinc-700 p-2">
                            {{ $employee->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:select name="department" label="Department" wire:model="deapartment_id">
                    <option value="">Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </flux:select>
            </div>
            <div>
                <flux:select name="designation" label="Designation" wire:model="contract.designation_id"
                    :invalid="$errors->has('contract.designation_id')">
                    <option value="">Select Designation</option>
                    @foreach ($designations as $designation)
                        <option value="{{ $designation->id }}">{{ $designation->name }}</option>
                    @endforeach
                </flux:select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:input label="Contract Start Date" wire:model="contract.start_date" type="date"
                    :invalid="$errors->has('contract.start_date')" />
            </div>
            <div>
                <flux:input label="Contract End Date" wire:model="contract.end_date" type="date"
                    :invalid="$errors->has('contract.end_date')" />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <flux:input label="Rate" wire:model="contract.rate" type="number" placeholder="e.g. 5000"
                    :invalid="$errors->has('contract.rate')" />
            </div>
            <div>
                <flux:select name="rate_type" label="Rate Type" wire:model="contract.rate_type"
                    :invalid="$errors->has('contract.rate_type')">
                    <option value="">Select Rate Type</option>
                    <option value="daily">Daily</option>
                    <option value="monthly">Monthly</option>
                </flux:select>
            </div>
        </div>
        <div class="flex justify-start">
            <flux:button variant="primary" type="submit">Save Contract</flux:button>
        </div>
    </form>
</div>