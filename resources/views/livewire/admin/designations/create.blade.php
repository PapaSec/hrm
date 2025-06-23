<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 p-6">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Designations</flux:heading>
        <flux:subheading size="lg" class="mb-6">Create new designation</flux:subheading>
        <flux:separator />
        <div>
            <form wire:submit="save" class="my-6 w-full space-y-6">
                <flux:select label="Department" wire:model="designation.department_id"
                    :invalid="$errors->has('designation.department_id')">
                    <option selected>Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </flux:select>
                <flux:input label="Designation Name" wire:model="designation.name"
                    :invalid="$errors->has('designation.name')" type="text" />
                <flux:button variant="primary" type="submit">Save</flux:button>
            </form>
        </div>