<div
    class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 dark:from-slate-900 dark:to-slate-800 p-6 rounded-lg shadow-md">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Payrolls</flux:heading>
        <flux:subheading size="lg" class="mb-6">Payroll Breakdown For {{ getCompany()->name }} during
            {{ $payroll->month_string}}
        </flux:subheading>
    </div>

    <div class="flex flex-col">
        <div class="overflow-x-auto sm:mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full table">
                        <thead class="bg-nos-200 dark:bg-nos-900">
                            <tr>
                                <th>#</th>
                                <th>Employees Details</th>
                                <th>Gross Salary</th>
                                <th>NSSF</th>
                                <th>SHIF</th>
                                <th>AHL</th>
                                <th>PAYE</th>
                                <th>Net Pay</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payroll->salaries as $key => $salary)
                                <tr class="text-center bg-nos-100 hover:bg-nos-50 dark:hover:bg-nos-700 dark:bg-nos-800">
                                    <td>{{ $key + 1 }}</td>
                                    <td class="text-zinc-900 dark:text-white flex flex-col justify-left items-center">
                                        <h3 class="text-sm text-zinc-900 dark:text-zinc-200">{{ $salary->employee->name }}
                                        </h3>
                                        <h5 class="text-sm text-zinc-700 dark:text-zinc-300">
                                            {{ $salary->employee->designation->name }}
                                        </h5>
                                    </td>
                                    <td>
                                        <span>
                                            <sub>ZAR</sub>{{ number_format($salary->gross_salary, 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <sub>ZAR</sub>{{ number_format($salary->breakdown->getNssfDeduction(), 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <sub>ZAR</sub>{{ number_format($salary->breakdown->getShifDeduction(), 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <sub>ZAR</sub>{{ number_format($salary->breakdown->getAhlDeduction(), 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <sub>ZAR</sub>{{ number_format($salary->breakdown->getPaye(), 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span>
                                            <sub>ZAR</sub>{{ number_format($salary->breakdown->getNetPay(), 2) }}
                                        </span>
                                    </td>
                                    <td>
                                        <div>
                                            <flux:tooltip content="Downlod Payslip">
                                                <flux:button variant="primary" icon="printer"
                                                    wire:click="generatePayslip({{ $salary->id }})">
                                                </flux:button>
                                            </flux:tooltip>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>