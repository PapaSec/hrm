<div
    class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 p-6 rounded-lg shadow-md">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Contracts</flux:heading>
        <flux:subheading size="lg" class="mb-6">List of Contracts for {{ getCompany()->name }}</flux:subheading>
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
                                    <th>Employee Details</th>
                                    <th>Contract Details</th>
                                    <th>Rate</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($contracts as $key => $contract)
                                    <tr
                                        class="text-center bg-nos-100 hover:bg-nos-50 dark:hover:bg-nos-700 dark:bg-nos-800">
                                        <td>{{ $key + 1 }}</td>
                                        <td class="text-zinc-900 dark:text-white flex flex-col justify-left items-center">
                                            <span class="font-semibold">{{ $contract->employee->name }}</span>
                                            <span>{{ $contract->employee->email }}</span>
                                            <span>{{ $contract->employee->phone }}</span>
                                            <span class="font-bold">{{ $contract->employee->designation->name }}</span>
                                        </td>
                                        <td>
                                            <h5> Start: {{ $contract->start_date }}</h5>
                                            <p> End: {{ $contract->end_date }}</p>
                                            <p class="font-semibold text-lg"> Duration: {{ $contract->duration }}</p>
                                        </td>
                                        <td>
                                            R {{ number_format($contract->rate) }} {{ $contract->rate_type }}
                                        </td>
                                        <td>
                                            <div>
                                                <flux:button variant="filled" icon="pencil"
                                                    :href="route('contracts.edit', $contract->id)" />
                                                <flux:button variant="danger" icon="trash"
                                                    :href="route('contracts.edit', $contract->id)"
                                                    wire:click="delete({{ $contract->id }})" />
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="px-6 py-4 bg-nos-200 dark:bg-nos-900">
                            {{ $contracts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>