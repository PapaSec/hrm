<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 p-6">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Departments</flux:heading>
        <flux:subheading size="lg" class="mb-6">List of Departments for {{ getCompany()->name }}
        </flux:subheading>
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
                                    <th>Department Name</th>
                                    <th>Number of Employees</th>
                                    <th>Number of Designations</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($departments as $key => $department)
                                    <tr
                                        class="text-center bg-nos-100 hover:bg-nos-50 dark:hover:bg-nos-700 dark:bg-nos-800">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-zinc-900 dark:text-white flex justify-left items-center">
                                            <span>{{ $department->name }}</span>
                                        </td>
                                        <td>
                                            {{ $department->designations->flatMap->employees->count() }}
                                        </td>
                                        <td>
                                            {{ $department->designations->count() }}
                                        </td>
                                        <td>
                                            <div>
                                                <flux:button variant="filled" icon="pencil"
                                                    :href="route('departments.edit', $department->id)" />
                                                <flux:button variant="danger" icon="trash"
                                                    :href="route('departments.edit', $department->id)"
                                                    wire:click="delete({{ $department->id}})" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-4 bg-nos-200 dark:bg-nos-900">
                            {{ $departments->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>