<div
    class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 p-6 rounded-lg shadow-md">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Payrolls</flux:heading>
        <flux:subheading size="lg" class="mb-6">Payrolls For {{ getCompany()->name }}</flux:subheading>
    </div>

    <div class="flex justify-between items-center">
        <div class="w-full pr-4">
            <flux:input type="month" name="month" wire:model="monthYear" placeholder="Choose the month"
                :invalid="$errors->has('monthYear')" />
        </div>
        <div>
            <flux:button variant="primary" wire:click="genetatePayroll">Generate Payroll</flux:button>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-4 mt-4">
        @foreach ($payrolls as $payroll)
            <div class="p-6 bg-nos-100 dark:bg-nos-900 text-nos-900 dark:text-white rounded-lg shadow-md hover:bg-nos-200  dark:hover:bg-nos-500 transition duration-300 ease-in-out border border-nos-200 dark:border-nos-700"
                wire:click="viewPayroll({{ $payroll->id }})">
                <div class="mb4">
                    <h2 class="text-lg font-semibold">
                        {{ $payroll->month_string }}
                    </h2>
                    <p class="text-sm text-zinc-500 dark:text-zinc-400">
                        {{ getCompany()->name }}
                    </p>
                </div>
                <div class="text-right flex flex-col justify-end text-green-700 ">
                    <sub>ZAR</sub><span class="font-bold text-xl">
                        {{ number_format($payroll->salaries?->sum('gross_salary')) }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>