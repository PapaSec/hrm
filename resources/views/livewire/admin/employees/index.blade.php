<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 p-6">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Employees</flux:heading>
        <flux:subheading size="lg" class="mb-6">List of Employees for {{ getCompany()->name }}</flux:subheading>
    </div>

    <div>
        <div class="flex flex-col">
            <div class="overflow-x-auto sm:mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full table">
                            <thead class="bg-nos-200 dark:bg-nos-900">
                                <tr>
                                    <th>#</th>
                                    <th>Employee Name</th>
                                    <th>Designation</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $key => $employee)
                                    <tr
                                        class="text-center bg-nos-100 hover:bg-nos-50 dark:hover:bg-nos-700 dark:bg-nos-800">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-zinc-900 dark:text-white flex flex-col justify-left items-center">
                                            <span class="font-bold text-lg">{{ $employee->name }}</span>
                                            <span>{{ $employee->email }}</span>
                                        </td>
                                        <td>
                                            <div class="text-sm">
                                                {{ $employee->designation->name }}
                                                <p>{{ $employee->designation->department->name }}</p>
                                            </div>
                                        </td>
                                        <td>
                                            <div>
                                                <flux:button variant="filled" icon="pencil"
                                                    :href="route('employees.edit', $employee->id)" />
                                                <flux:button variant="danger" icon="trash"
                                                    :href="route('employees.edit', $employee->id)"
                                                    wire:click="delete({{ $employee->id }})" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-4 bg-nos-200 dark:bg-nos-900">
                            {{ $employees->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>