<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payslip</title>
    <!-- Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .payslip-container {
            width: 210mm;
            height: 297mm;
            margin: 0 auto;
            padding: 15mm;
        }

        .watermark {
            position: absolute;
            opacity: 0.1;
            font-size: 72px;
            color: #3b82f6;
            transform: rotate(-30deg);
            z-index: -1;
            pointer-events: none;
        }

        @page {
            size: A4;
            margin: 0;
        }

        @media print {
            body {
                background: white;
            }

            .payslip-container {
                width: 100%;
                height: 100%;
                margin: 0;
                padding: 0;
            }

            .no-print {
                display: none !important;
            }
        }
    </style>
</head>

<body class="bg-gray-100">
    <div class="flex justify-center no-print my-8">
        <button onclick="window.print()"
            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
            <i class="fas fa-print"></i> Print Payslip
        </button>
    </div>

    <div class="payslip-container bg-white shadow-lg">
        <!-- Watermark -->
        <div class="watermark top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
            CONFIDENTIAL
        </div>

        <!-- Header Section -->
        <div class="flex justify-between items-start border-b-2 border-blue-600 pb-6 mb-6">
            <div>
                <div class="flex items-center gap-4 mb-4">
                    <div class="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-building text-blue-600 text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-800">PAYSLIP</h1>
                        <p class="text-gray-600">Salary Payment Advice</p>
                    </div>
                </div>

                <div class="text-sm text-gray-600">
                    <p><span class="font-medium text-gray-800">Pay Period:</span> June 2023</p>
                    <p><span class="font-medium text-gray-800">Payment Date:</span> 25th June 2023</p>
                    <p><span class="font-medium text-gray-800">Payslip ID:</span> PS-2023-06-001</p>
                </div>
            </div>

            <div class="text-right">
                <div class="w-24 h-24 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-2">
                    <i class="fas fa-user-tie text-blue-600 text-4xl"></i>
                </div>
                <h2 class="text-xl font-bold text-gray-800">John Doe</h2>
                <p class="text-gray-600">Senior Developer</p>
                <p class="text-sm text-gray-500">EMP ID: DEV-007</p>
            </div>
        </div>

        <!-- Company & Employee Details -->
        <div class="grid grid-cols-2 gap-8 mb-8">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2 border-b pb-1">Company Details</h3>
                <p class="font-medium">Tech Solutions Inc.</p>
                <p class="text-sm text-gray-600">123 Business Park, Nairobi</p>
                <p class="text-sm text-gray-600">Kenya</p>
                <p class="text-sm text-gray-600">Tax ID: P0512345678</p>
            </div>

            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2 border-b pb-1">Employee Details</h3>
                <p class="font-medium">John Doe</p>
                <p class="text-sm text-gray-600">123 Employee Street</p>
                <p class="text-sm text-gray-600">Nairobi, Kenya</p>
                <p class="text-sm text-gray-600">NSSF No: 12345678</p>
                <p class="text-sm text-gray-600">NHIF No: 98765432</p>
                <p class="text-sm text-gray-600">KRA PIN: A012345678X</p>
            </div>
        </div>

        <!-- Earnings & Deductions -->
        <div class="grid grid-cols-2 gap-8 mb-8">
            <!-- Earnings -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-1">Earnings</h3>
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-sm text-gray-500 border-b">
                            <th class="pb-2">Description</th>
                            <th class="text-right pb-2">Amount (ZAR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2">Basic Salary</td>
                            <td class="text-right py-2 font-mono">120,000.00</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2">House Allowance</td>
                            <td class="text-right py-2 font-mono">25,000.00</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2">Transport Allowance</td>
                            <td class="text-right py-2 font-mono">15,000.00</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2">Bonus</td>
                            <td class="text-right py-2 font-mono">10,000.00</td>
                        </tr>
                        <tr class="bg-blue-50 font-semibold">
                            <td class="py-2">Total Earnings</td>
                            <td class="text-right py-2 font-mono">170,000.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Deductions -->
            <div>
                <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-1">Deductions</h3>
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-sm text-gray-500 border-b">
                            <th class="pb-2">Description</th>
                            <th class="text-right pb-2">Amount (ZAR)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b border-gray-100">
                            <td class="py-2">PAYE</td>
                            <td class="text-right py-2 font-mono text-red-600">27,500.00</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2">NSSF</td>
                            <td class="text-right py-2 font-mono text-red-600">1,080.00</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2">NHIF</td>
                            <td class="text-right py-2 font-mono text-red-600">1,700.00</td>
                        </tr>
                        <tr class="border-b border-gray-100">
                            <td class="py-2">Pension</td>
                            <td class="text-right py-2 font-mono text-red-600">12,000.00</td>
                        </tr>
                        <tr class="bg-red-50 font-semibold">
                            <td class="py-2">Total Deductions</td>
                            <td class="text-right py-2 font-mono text-red-600">42,280.00</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-1">Summary</h3>
            <div class="grid grid-cols-3 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">Gross Pay</p>
                    <p class="text-xl font-bold text-gray-800 font-mono">170,000.00</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">Total Deductions</p>
                    <p class="text-xl font-bold text-red-600 font-mono">42,280.00</p>
                </div>
                <div class="bg-blue-50 p-4 rounded-lg border-2 border-blue-200">
                    <p class="text-sm text-blue-600">Net Pay</p>
                    <p class="text-2xl font-bold text-blue-700 font-mono">127,720.00</p>
                </div>
            </div>
        </div>

        <!-- Payment Details -->
        <div class="mb-8">
            <h3 class="text-lg font-semibold text-gray-800 mb-3 border-b pb-1">Payment Details</h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">Payment Method</p>
                    <p class="font-medium">Bank Transfer</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">Bank Name</p>
                    <p class="font-medium">Equity Bank</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">Account Number</p>
                    <p class="font-medium">1234567890</p>
                </div>
                <div class="bg-gray-50 p-4 rounded-lg">
                    <p class="text-sm text-gray-600">Payment Date</p>
                    <p class="font-medium">25th June 2023</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <div class="border-t pt-6 text-center text-sm text-gray-500">
            <div class="flex justify-between mb-4">
                <div class="text-left">
                    <p class="font-medium">Employee Signature</p>
                    <div class="h-12 border-b border-gray-300 mt-2"></div>
                </div>
                <div class="text-right">
                    <p class="font-medium">Authorized Signature</p>
                    <div class="h-12 border-b border-gray-300 mt-2"></div>
                </div>
            </div>
            <p>This is a computer generated document. No signature is required.</p>
            <p class="mt-2">For any queries, please contact HR at hr@techsolutions.com or call +254 700 123456</p>
        </div>
    </div>

    <script>
        // You can add dynamic data population here if needed
        document.addEventListener('DOMContentLoaded', function () {
            // Example of setting dynamic data
            // document.querySelector('.employee-name').textContent = employeeData.name;
            // document.querySelector('.employee-id').textContent = employeeData.id;
        });
    </script>
</body>

</html>