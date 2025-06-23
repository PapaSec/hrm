<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 p-6">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Designations</flux:heading>
        <flux:subheading size="lg" class="mb-6">List of Designations for {{ getCompany()->name }}
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
                                    <th>Designation Name</th>
                                    <th>Department</th>
                                    <th>Number of Designations</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($designations as $key => $designation)
                                    <tr
                                        class="text-center bg-nos-100 hover:bg-nos-50 dark:hover:bg-nos-700 dark:bg-nos-800">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-zinc-900 dark:text-white flex justify-left items-center">
                                            <span>{{ $designation->name }}</span>
                                        </td>
                                        <td>
                                            {{ $designation->employees->count() }}
                                        </td>
                                        <td>
                                            {{ $designation->department->name }}
                                        </td>
                                        <td>
                                            <div>
                                                <flux:button variant="filled" icon="pencil"
                                                    :href="route('designations.edit', $designation->id)" />
                                                <flux:button variant="danger" icon="trash"
                                                    :href="route('designations.edit', $designation->id)"
                                                    wire:click="delete({{ $designation->id}})" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-4 bg-nos-200 dark:bg-nos-900">
                            {{ $designations->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>