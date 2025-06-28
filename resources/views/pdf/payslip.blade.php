<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payslip</title>
    <style>
        @page {
            margin: 20mm;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            color: #1f2937;
            padding: 24px;
            max-width: 960px;
            margin: 0 auto;
        }

        /* Light Mode Styles */
        h1 {
            font-size: 24px;
            font-weight: bold;
            color: #111827;
            text-align: center;
            margin-bottom: 8px;
        }

        h2 {
            font-size: 18px;
            font-weight: 600;
            color: #1e293b;
            text-align: center;
            margin-bottom: 4px;
        }

        p {
            font-size: 14px;
            color: #4b5563;
            text-align: center;
            margin: 0;
        }

        .header-section {
            margin-bottom: 32px;
            text-align: center;
        }

        .employee-details {
            background-color: #f9fafb;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }

        .employee-details h3 {
            font-size: 16px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .employee-details div {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            font-size: 14px;
        }

        .employee-details div span {
            font-weight: 600;
        }

        .earnings-deductions {
            background-color: #ffffff;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            margin-bottom: 24px;
        }

        .earnings-deductions h3 {
            font-size: 16px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .table-custom {
            border-collapse: collapse;
            width: 100%;
            margin-top: 16px;
        }

        .table-custom th,
        .table-custom td {
            border: 1px solid #e5e7eb;
            padding: 8px;
            text-align: right;
        }

        .table-custom th {
            background-color: #f9fafb;
            color: #374151;
            font-weight: 500;
            text-align: left;
        }

        .table-custom td:first-child {
            text-align: left;
        }

        .table-custom tr:last-child td {
            font-weight: 600;
            color: #1f2937;
        }

        .net-pay {
            background-color: #ecfdf5;
            padding: 16px;
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            text-align: right;
        }

        .net-pay h3 {
            font-size: 16px;
            font-weight: 500;
            color: #374151;
            margin-bottom: 8px;
        }

        .net-pay p {
            font-size: 20px;
            font-weight: bold;
            color: #10b981;
            margin: 0;
        }

        .signature {
            margin-top: 40px;
            text-align: center;
            font-style: italic;
            color: #6b7280;
        }

        /* Dark Mode Styles */
        .dark-mode body {
            background-color: #111827;
            color: #d1d5db;
        }

        .dark-mode h1 {
            color: #f9fafb;
        }

        .dark-mode h2 {
            color: #e5e7eb;
        }

        .dark-mode p {
            color: #9ca3af;
        }

        .dark-mode .employee-details {
            background-color: #1f2937;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .dark-mode .employee-details h3 {
            color: #d1d5db;
        }

        .dark-mode .earnings-deductions {
            background-color: #1f2937;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .dark-mode .earnings-deductions h3 {
            color: #d1d5db;
        }

        .dark-mode .table-custom th {
            background-color: #374151;
            color: #d1d5db;
        }

        .dark-mode .table-custom td {
            border-color: #374151;
        }

        .dark-mode .net-pay {
            background-color: #164e3a;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
        }

        .dark-mode .net-pay h3 {
            color: #d1d5db;
        }

        .dark-mode .net-pay p {
            color: #34d399;
        }

        .dark-mode .signature {
            color: #9ca3af;
        }
    </style>
</head>

<body class="{{ $darkMode ?? '' }}">
    <!-- Header -->
    <div class="header-section">
        <h1>Payslip</h1>
        <p>Generated on: {{ $salary->payroll->month_string }}</p>
        <div class="mt-4">
            <h2>Company Name</h2>
            <p>123 Business Street, City, Country</p>
            <p>Email: info@company.com | Phone: +1-234-567-890</p>
        </div>
    </div>

    <!-- Employee Details -->
    <div class="employee-details">
        <h3>Employee Information</h3>
        <div class="mt-2">
            <div><span>Employee Name:</span>{{ $salary->employee->name }}</div>
            <div><span>Employee ID:</span>{{ sprintf('%04d', $salary->employee_id) }}</div>
            <div><span>Department:</span>{{ $salary->employee->department }}</div>
            <div><span>Designation:</span>{{ $salary->employee->designation->name }}</div>
        </div>
    </div>

    <!-- Earnings and Deductions -->
    <div class="earnings-deductions">
        <h3>Earnings & Deductions</h3>
        <table class="table-custom">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Amount (ZAR)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Gross Salary</td>
                    <td><sup>ZAR</sup>{{ number_format($salary->gross_salary)}}</td>
                </tr>
                <tr>
                    <td>Overtime</td>
                    <td>1,500.00</td>
                </tr>
                <tr>
                    <td>Bonus</td>
                    <td>500.00</td>
                </tr>
                <tr>
                    <td>Total Earnings</td>
                    <td>17,000.00</td>
                </tr>
                <tr>
                    <td>NSSF</td>
                    <td>-850.00</td>
                </tr>
                <tr>
                    <td>SHIF</td>
                    <td>-300.00</td>
                </tr>
                <tr>
                    <td>PAYE</td>
                    <td>-1,200.00</td>
                </tr>
                <tr>
                    <td>Total Deductions</td>
                    <td>-2,350.00</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Net Pay -->
    <div class="net-pay">
        <h3>Net Pay</h3>
        <p>ZAR 14,650.00</p>
    </div>

    <!-- Signature -->
    <div class="signature">
        <p>Authorized by: ___________________________</p>
        <p>Date: {{ date('F d, Y') }}</p>
    </div>
</body>

</html>